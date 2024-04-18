"use strict"

const WVPL_MAX_FAILED_ATTEMPTS = 5

let microStart = 0

class WVPLEngine {

    constructor(win) {
        this.setVars(win)
        this.setupObservers()
        this.active = true
        this.switched = true
        this.instances = []
        this.currentId
        this.currentInstance = null
        this.failedAttempts = 0
        this.peakLength = 1920
        this.setupAudioEngine()
        this.node = document.querySelector('#vwwvpl-sticky-player')
        this.queue = []
        this.start()
    }

    setupAudioEngine( audioType ) {
		this.setAudioType( audioType )
        this.webAudio = new Audio()
		this.webAudio.preload = 'metadata'
		this.webAudio.crossOrigin = "anonymous";
        this.mediaElement = new Audio()
        this.mediaElement.preload = 'metadata'
		this.volume = 1
        this.muted = false
		delete this.audioCtx
		delete this.gain
		delete this.analyserGain
		if ( this.isWebAudio() ) {
			this.audioCtx = new (window.AudioContext || window.webkitAudioContext)()
			this.gain = this.audioCtx.createGain()
			this.analyserGain = this.audioCtx.createGain()
	        this.createSource()
	        this.setSmoothingTimeConstant( parseFloat( this.getOption('wave_animation') || 1) )
		}
		this.addEvents()
    }

    setAudioType( audioType ) {
		audioType = audioType || 'WebAudio'

        switch ( true ) {
            // always use Media Element
            case this.getOption('force_media_element'):

            // use Media Element in any version of iOS
            case this.getiOSVersion() && this.getOption('force_ios_media_element'):

            // use Media Element in a specific version of iOS
            case this.getiOSVersion() && this.getOption(`force_ios_${ this.getiOSVersion() }_media_element`):

            // use Media Element in any version of Safari
            case this.getSafariVersion() && this.getOption('force_safari_media_element'):

            // use Media Element in a specific version of iOS
            case this.getSafariVersion() && this.getOption(`force_safari_${ this.getSafariVersion() }_media_element`):
                audioType = 'MediaElement'
                break
        }

        this.audioType = audioType
    }

    getAudioType() {
        return this.audioType
    }

	isWebAudio() {
		return this.getAudioType() === 'WebAudio'
	}

	isMediaElement() {
		return this.getAudioType() === 'MediaElement'
	}

	audio() {
		return ( this.isWebAudio() ? this.webAudio : this.mediaElement )
	}

	cancelAnimationFrame() {
		const caf = window.cancelAnimationFrame    ||
                    window.mozCancelAnimationFrame

		caf.call( window, this.afRequest )
	}

    setupObservers() {
        this.setupInstanceObserver()
        this.setupVariationFormObserver()
    }

    setupInstanceObserver() {
        const config = { attributes: false, childList: true, subtree: true }
        this.instanceObserver = new MutationObserver( (mutationList, observer) => {
            mutationList.forEach( (mutation) => {
                if ( mutation.target.querySelector('.vwwaveplayer:not(.active)') ) {
                    this.loadInstances()
                    observer.disconnect()
                    requestAnimationFrame( () => {
                        observer.observe(document.body, config)
                    } )    
                }
            })
        })
        requestAnimationFrame( () => {
            this.instanceObserver.observe(document.body, config)
        } )
    }

    setupVariationFormObserver() {
        if ( !this.vars.wc_version )
            return

        if ( !document.querySelector('#vwwvpl-variation-popup') ) {
            let palette = this.vars.palettes.filter( p => p.colors === this.getOption('default_palette') )
            palette = palette.length > 0 && palette[0].id
            this.variationPopup = document.createElement('div')
            this.variationPopup.id = 'vwwvpl-variation-popup'
            this.variationPopup.classList.add('woocommerce', 'single-product', `vwwvpl-style-${this.getOption('style')}`, `vwwvpl-palette-${palette}` )
            document.body.appendChild(this.variationPopup)
        }
        this.variationPopup.innerHTML = ''
        if ( !this.variationPopupObserver ) {
            const config = { attributes: true, childList: true, subtree: true }
            this.variationPopupObserver = new MutationObserver( this.variationFormCallback.bind(this) )
            requestAnimationFrame( () => {
                this.variationPopupObserver.observe(this.variationPopup, config)
            } )                                    
        }
        const variationForm = document.createElement('div')
        variationForm.classList.add('product', 'vwwvpl-variation-form')
        jQuery(variationForm).on('wc_variation_form', (event) => {
            document.body.classList.add('vwwvpl-variation-popup')
        })
        this.variationPopup.append(variationForm)
    }

    setVars(win) {
        this.vars = win.vwwvplVars
        this.__ = win.wp.i18n.__
        this._n = win.wp.i18n._n
        this.template = win.lodash.template
    }

    getSafariVersion() {
        if ( this.safariVersion === undefined ) {
            this.safariVersion = false

            const ua = navigator.userAgent.toLowerCase()
            const matches = ua.match(/version\/(\d+)/)

            if ( matches ) {
                this.safariVersion = matches[1]
            }
        }

        return this.safariVersion
    }

    getiOSVersion() {
        if ( this.iOSVersion === undefined ) {
            this.iOSVersion = false

            const matches = navigator?.userAgent?.match(/(iPad|iPhone).+OS (\d+)_/)

            if ( matches ) {
                this.iOSVersion = parseInt( matches[2] )
            }
        }

        return this.iOSVersion
    }

    isSafari() {
        return this.getSafariVersion()
	}

    isiOS() {
        return this.getiOSVersion()
    }

    isDocumentHidden() {
        if ( document.hidden !== undefined ) {
            return document.hidden
		}

        if ( document.msHidden !== undefined ) {
            return document.msHidden
		}

        if ( document.webkitHidden !== undefined ) {
            return document.webkitHidden
		}

        return false
    }

    getInstanceById( id ) {
        id = id || this.getCurrentId()
        return this.instances.find( i => i.id === id )
    }

    nextInstance() {
        const instancesInDOM = this.getVisibleInstancesInDOM()
        let index = this.getCurrentIndex()
        if ( index < 0 )
            return instancesInDOM[0];
        index++
        if ( index >= this.instances.length )
            return false

        return instancesInDOM[index]
    }

    prevInstance() {
        const instancesInDOM = this.getVisibleInstancesInDOM()
        let index = this.getCurrentIndex()
        if ( index < 0 )
            return false;
        index--
        if ( index < 0 )
            return false

        return instancesInDOM[index]
    }

    processQueue() {
        if ( this.queue.length > 0 ) {
            const nextInstanceInQueue = this.queue.shift()
            this.addInstance( nextInstanceInQueue )
            requestAnimationFrame( () => this.processQueue() )
        } else {
            const e = new CustomEvent( 'resize' )
		    window.dispatchEvent( e )
            if ( document.querySelector( 'ul#instance_track_data' ) ) {
                document.querySelector( 'ul#instance_track_data' ).innerHTML = '';
            }
        }
    }

    addInstance( { player, tracks, nonce } ) {
        const foundInstance = this.instances.find( i => i.id === player.dataset.instance_id )

        if ( ! foundInstance ) {
            for ( const track of tracks ) {
				if ( track?.peaks && ! Array.isArray( track.peaks ) ) {
                	track.peaks = this.readPeaks( track.peaks )
				}
            }
            const instance = new WVPLInstance( player, tracks, nonce, this )
            this.instances.push(instance)
            if ( this.instances.length === 1 ) {
                this.currentId = instance.id
            }
        } else {
			foundInstance.init( player, tracks, nonce, this )
        }
    }

    removeInstance( id ) {
        const instance = this.getInstanceById( id )
        if ( instance ) {
            const index = this.getCurrentIndex( id )
            this.instances.splice( index, 1 )
        }
    }

    getElement( id ) {
        id = id || this.getCurrentId()
        return document.getElementById( id )
    }

    getOption( name ) {
        return this.vars.options[name]
    }

	setOption( name, value ) {
		this.vars.options[name] = value
		this.redrawAllInstances()
	}

    getVar( name ) {
        return this.vars?.[name]
    }

    setVar( name, value ) {
        this.vars[name] = value
    }

    getInstancesInDOM() {
        if ( this.instances )
            return this.instances.filter( i => document.querySelector(`.vwwaveplayer[data-instance_id="${i.id}"]`) )
    }

	getVisibleInstancesInDOM() {
		const instances = this.getInstancesInDOM()
		return instances.filter( i => i.node.offsetParent )
	}

	getFirstInstanceInDOM() {
		const instances = this.getVisibleInstancesInDOM()
		if ( ! instances ) {
			return null
		}
		return instances[0]
	}

    getCurrentId() {
        const instance = this.getFirstInstanceInDOM()
        return this.currentId || instance.id
    }

    isInstanceInDOM( id ) {
        id = id || this.currentId
        return this.getInstancesInDOM().find( i => i.id === id )
    }

    getCurrentInstance() {
        if ( this.currentId === undefined ) {
            return this.getFirstInstanceInDOM()
        }

        return this.instances.find( i => i.id === this.currentId )
    }

    setCurrentInstance( instance ) {
        instance = instance || this.getFirstInstanceInDOM()
        if ( !instance ) {
            return
        }
        if ( ! this.currentId || this.currentId !== instance.id ) {
            const currentInstance = this.getCurrentInstance()
            if ( currentInstance ) {
                currentInstance.updateStatistics()
				currentInstance.stop()
			}
            this.currentId = instance.id
            this.switched = true
        }
		if ( this.node ) {
			this.node.dataset.instance_id = instance.id
		}
    }

    start() {
		const e = new CustomEvent( 'vwwaveplayer.engine.starting', { detail: { engine: this } } )
	    document.dispatchEvent( e )

        this.stickyPlayerInit()
        this.navigatorInit()
        this.loadInstances()
        this.setCurrentInstance()

        let instance = this.getVisibleInstancesInDOM().find( i => i.autoplay )
        if ( ! ! Number( this.getOption( 'autoplay' ) ) ) {
			instance = this.getFirstInstanceInDOM()
		}

        if ( instance ) {
			if ( instance.node.classList.contains('vwwvpl-rendered') ) {
				instance.play()
			} else {
				instance.playerInit( true )
			}
		}
    }

    getCurrentIndex( id ) {
        id = id || this.currentId
        return this.getVisibleInstancesInDOM().findIndex( (i) => { return i.id === id } )
    }

	getTrack( index ) {
		return this.getCurrentInstance().getTrack(index)
    }

    getCurrentTrack() {
        return this.getTrack();
    }

    getCurrentTrackIndex() {
        return this.getCurrentInstance().getCurrentTrackIndex();
    }

    getColorStyleFromPalette( colorCodes ) {
        const props = [ 'fc', 'fc-s', 'bc', 'bc-s', 'hc', 'hc-s', 'wc', 'wc-s', 'pc', 'pc-s', 'cc', 'cc-s']
        let colorStyle = {}
        for( const index in props ) {
            const rgb = [
                parseInt( `0x${colorCodes[index].slice(0,2)}` ),
                parseInt( `0x${colorCodes[index].slice(2,4)}` ),
                parseInt( `0x${colorCodes[index].slice(4,6)}` )
            ].join(', ')
            colorStyle[`--${props[index]}`] = rgb
        }
        return colorStyle
    }

	findTrack( value, key = 'id' ) {
		const track = this.instances.map( i => i.tracks ).flat().filter( t => String( t[key] ) === String( value ) )
		if ( track.length )
			return track[0]

		return false
	}

    skip( forward = true ) {
		if ( this.hasEnded ) {
			this.hasEnded = false
		} else {
			this.trigger( 'skip' )
		}

        const instance = this.getCurrentInstance(),
              prevInstance = this.prevInstance(),
              nextInstance = this.nextInstance(),
              isInstanceInDOM = this.isInstanceInDOM(),
              noInstancesInDOM = this.getInstancesInDOM().length === 0

        let newTrackIndex = Number.isInteger( forward ) ? forward : ( instance.getCurrentTrackIndex() + ( forward ? 1 : -1 ) ),
            newInstance = instance,
            skipped = true

        if ( isInstanceInDOM || noInstancesInDOM ) {
            switch(true) {
                case ( newTrackIndex >= 0 && newTrackIndex < instance.getTrackCount() ):
                    break
				case ( forward && ( newTrackIndex >= instance.getTrackCount() ) && this.getOption('jump') && !!nextInstance ):
                    newTrackIndex = 0
                    newInstance = nextInstance
                    break
                case ( forward && ( newTrackIndex >= instance.getTrackCount() && !!instance.repeat ) ):
					newTrackIndex = 0
                    break
                case ( !forward && ( newTrackIndex < 0 ) && this.getOption('jump') && !!prevInstance ):
                    newInstance = prevInstance
                    newTrackIndex = prevInstance.getTrackCount() - 1
                    break
                default:
                    skipped = false
                    break
            }
        } else {
            newInstance = nextInstance
            newTrackIndex = 0
        }

        this.switched = ( instance.id !== newInstance.id )
        if ( skipped ) {
            newInstance.mousePosition = -1
            if (newInstance.currentTrack >= 0 && newInstance.currentTrack < newInstance.getTrackCount()) {
                instance.updateStatistics()
            }
            newInstance.currentTrack = newTrackIndex

            newInstance.loading()
            this.node?.classList.add('loading')

			this.pause()
			.then( () => {
                this.setSkipState()
	            if ( this.switched ) {
					instance.stop()
					instance.reset()
                    if ( this.getOption('auto_scroll_page') ) {
    	                newInstance.node.scrollIntoView({behavior: 'smooth', block: 'center'})
                    }
	                newInstance.waveRedraw()
	                this.setCurrentInstance( newInstance )
					newInstance.preloadTrack(true)
	            } else {
                    if ( newInstance.getData('auto_scroll_playlist') ) {
                        newInstance.scrollTo( newTrackIndex, forward )
                    }
          
	                newInstance.preloadTrack(true)
	            }
			})
        } else {
            newInstance.stop()
            newInstance.reset()
        }
    }

    applyTemplate( tmplString, track ) {
        const placeholders = document.querySelector('#tmpl-placeholders'),
              _this = this
        if ( !placeholders )
            return ''

        const {template} = this
        const currentUser = this.getVar('currentUser')

        tmplString = tmplString.replace(/(\{[^\}]*\})/g, function(match, $1){
            var att = JSON.parse($1)
            for ( let i in att ) {
                let e = att[i]
				if ( typeof(att[i]) == 'string' ) {
					att[i] = e.replace(/%([^%]+)%/g, function(match, $11){
						return (track[ $11 ] ? track[ $11 ] : '')
					})
				}
            }
            return JSON.stringify(att)
        })
        tmplString = tmplString.replace(/%([^ %\{]*)(\{[^\}]*\})*%/g, function(match, $1, $2){
            var key = $1,
                attributes = jQuery.extend({
                    class:'',
                    showValue: 1,
                    text: '',
                    raw: 0,
                    url: '',
                    target: '_blank',
                    icon: '',
                    event: '',
                    guests: true
                }, $2 ? JSON.parse($2) : '')
            try {
                const tmpl = template( placeholders.innerHTML )
                return tmpl( { key, attributes, track, loggedUser: (currentUser.ID > 0), __: _this.__, _n: _this._n, likes: currentUser.likes } )
            } catch(e) {
                _this.log(e)
                return ''
            }
        })
        return tmplString
    }

    toggleStickyPlayer( show = false ) {
        if ( ! this.node ) {
            return
        }

        this.setSkipState()

        const html = document.querySelector('html')
		if ( show && html.classList.contains('has-sticky-player') ) {
			return
        }

        const position = this.getOption( 'sticky_player_position' )
        html.classList.toggle('has-sticky-player')
        html.classList.toggle(`has-sticky-player-${position}`)
    }

    hasStickyPlayer() {
        return document.querySelector('html').classList.contains('has-sticky-player')
    }

    updateStickyPlayerInfo() {
        this.switched = false

        const instance = this.getCurrentInstance()
        if ( ! instance ) {
            return
        }

        const player = this.node,
              placeholders = this.getOption('sticky_template') || "%thumbnail% %title% %artist% %share%",
              track = instance.getTrack()

        if ( track ) {
            if ( player ) {
                player.classList.add('loading')

                setTimeout( () => {
                    player.querySelector('.vwwvpl-duration').textContent = track.length_formatted
                    player.querySelector('.vwwvpl-position').textContent = this.secondsToTime()
                    if ( track.length_formatted ) {
                        player.querySelector('.vwwvpl-duration').style.width = ( `${track.length_formatted.length+1}ch` )
                        player.querySelector('.vwwvpl-position').style.width = ( `${track.length_formatted.length+1}ch` )
                    }

                    const infobar = player.querySelector('.vwwvpl-trackinfo')
                    infobar && ( infobar.innerHTML = this.applyTemplate(placeholders, track) )
                    player.classList.remove('loading')
                }, WVPL_ANIMATION_TIME )
            }
        }
    }

    updateMediaSession( track ) {
        if ('mediaSession' in navigator && track ) {
            const metadata = {
                title: track.title,
                artist: track.artist,
                album: track.album,
            }
            if ( track.poster ) {
                metadata.artwork = [
                    { src: track.poster },
                ]
            }
            navigator.mediaSession.metadata = new MediaMetadata( metadata )
        }
    }

    updateVariationForm( track ) {
        const variationForm = this.variationPopup.querySelector( '.vwwvpl-variation-form' )

        this.variationPopupObserver.track = track
        variationForm.innerHTML = track.product_variations_form
		const closeButton = document.createElement('div')
        closeButton.classList.add('close-button')
		variationForm.prepend(closeButton)
		const $title = jQuery(`<h4>${track.product_title}</h4>`).get(0)
  		variationForm.prepend($title)
        closeButton.addEventListener('click', (event) => {
            document.body.classList.remove('vwwvpl-variation-popup')
			this.trigger('variationForm:close', {track})
        })
		this.trigger('variationForm:open', {track})
    }

    variationFormCallback( mutationsList, observer ) {
        for(let mutation of mutationsList) {
            if ( mutation.type === 'childList' && mutation.target.classList.contains('vwwvpl-variation-form') ) {
                const form = mutation.target.querySelector('.variations_form')
                if ( form ) {
                    jQuery(form).wc_variation_form()
                    const $table = jQuery(form).find('table'),
                          $clear = jQuery(form).find('a.reset_variations')
                    $clear.insertAfter($table)
                    observer.disconnect()
                    requestAnimationFrame( () => {
                        const config = { attributes: true, childList: true, subtree: true }
                        observer.observe(this.variationPopup, config)
                    } )                                    
                }
            }
        }
    }

    updateTrackCartStatus( productId, action = 'add' ) {
        const affectedInstances = this.instances.filter( i => i.tracks.find( t => t.product_id == productId ) )
        for( const instance of affectedInstances ) {
            const linkedTrack = instance.tracks.find( t => t.product_id == productId )
            if ( linkedTrack ) {
                linkedTrack.in_cart = action === 'add'
            }
        }
    }

    setSkipState() {
        const prevBtn = this.node?.querySelector('.vwwvpl-prev'),
              nextBtn = this.node?.querySelector('.vwwvpl-next'),
              instance = this.getCurrentInstance(),
              isPrevEnabled = this.prevInstance() || instance?.getCurrentTrackIndex() > 0,
              isNextEnabled = this.nextInstance() || instance?.getCurrentTrackIndex() < instance?.getTrackCount() - 1 || instance?.repeat

        prevBtn?.classList.toggle( 'vwwvpl-disabled', !isPrevEnabled )
        nextBtn?.classList.toggle( 'vwwvpl-disabled', !isNextEnabled )
        instance?.setSkipState()
    }

    createAnalyser() {
        if ( this.isMediaElement() )
            return
        this.analyser = this.audioCtx.createAnalyser()
        this.analyser.smoothingTimeConstant = parseFloat(this.getOption('wave_animation') || 1)
        this.analyser.maxDecibels = -30
        this.analyser.minDecibels = -90
        try {
            this.analyser.fftSize = 8192
        } catch(e) {
            this.analyser.fftSize = 2048
        }
        this.analyserGain.connect(this.analyser)
    }

    destroyAnalyser() {
        if ( this.isMediaElement() )
            return
        this.analyserGain.disconnect(this.analyser)
        this.analyser = null
        this.frequencyData = null
    }

    createSource() {
        if ( this.isMediaElement() )
            return
        this.source = this.audioCtx.createMediaElementSource(this.webAudio)
        this.source.connect(this.gain)
        this.source.connect(this.analyserGain)
        this.gain.connect(this.audioCtx.destination)

		this.createAnalyser()
    }

    getCurrentTrack() {
        return this.getCurrentInstance().getCurrentTrack()
    }

    audioProcess() {
        if ( this.isPaused() || this.isDocumentHidden() ) {
            return
        }

        this.afRequest = requestAnimationFrame( this.audioProcess.bind(this) )

        if ( this.isWebAudio() ) {
            if ( this.analyser && parseFloat( this.getOption('wave_animation') ) < 1 ) {
                this.frequencyData = new Uint8Array(this.analyser.frequencyBinCount)
                this.analyser.getByteFrequencyData(this.frequencyData)
            }
        }

        const instance = this.getCurrentInstance()
        instance?.timeUpdate()
    }

	async ajaxCall( action, postData = {} ) {
        const url = this.vars.wvpl_ajax_url.replace( '%%endpoint%%', action )
        const params = Object.keys(postData).map(
            key => encodeURIComponent(key) + '=' + encodeURIComponent(postData[key])
        ).join('&')

		try {
			const response = await fetch( url, {
				method: 'POST',
				headers: {
			        'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'
			    },
			    body: params,
			})
			try {
				const data = await response.json()
				return data
			} catch( error ) {
				this.log( error )
			}
		} catch ( error ) {
			this.log(error)
		}
    }

	async getAudioData( url, trackId, progressCallback ) {
		try {
			const response = await fetch(url)
			const filesize = response.headers.get('Content-Length')
			if ( ! filesize ) {
				const buffer = await response.arrayBuffer()
				return buffer
			} else {
				const array = new Uint8Array(filesize)
				let at = 0
				const reader = response.body.getReader()
				for (;;) {
					try {
						const {done, value} = await reader.read()
						if (done) {
							break
						}
						array.set(value, at)
						at += value.length
						progressCallback( at, filesize )
					} catch ( error ) {
						this.log( error )
						return false
					}
				}
				return array.buffer
			}
		} catch( error ) {
			this.log( error )
			return false
		}
    }

    decodeAudioData( data, callback ) {
        this.audioCtx.decodeAudioData( data, callback.bind(this) )
    }

    extractPeaks( buffer ) {
        const channels = buffer.numberOfChannels,
              sampleSize = buffer.length / this.peakLength,
              sampleStep = ~~( sampleSize / 10) || 1

        const peaks = []

        for (var c = 0; c < channels; c++) {
            const stepPeaks = []
            const chan = buffer.getChannelData(c)

            for (var i = 0; i < this.peakLength; i++) {
                var start = ~~(i * sampleSize)
                var end = ~~(start + sampleSize)
                var min = chan[0]
                var max = chan[0]

                for (var j = start; j < end; j += sampleStep) {
                    var value = chan[j]
                    if (value > max)
                        max = value
                    if (value < min)
                        min = value
                }
                stepPeaks[2 * i] = max
                stepPeaks[2 * i + 1] = min

                if (c == 0 || max > peaks[2 * i])
                    peaks[2 * i] = Math.abs( max.toFixed(2) )

                if (c == 0 || min < peaks[2 * i + 1])
                    peaks[2 * i + 1] = Math.abs( min.toFixed(2) )
            }
        }
        return peaks
    }

	readPeaks( peakData ) {
		return peakData.split( '' ).map( c => ( c.charCodeAt() - 48 ) / 100 )
	}

    loadInstances( container ) {
        container = container ? document.querySelector(container) : document
        let players = container.querySelectorAll('.vwwaveplayer:not(.active)')
        if ( players.length ) {
            let tracks,
				nonce
            for( let player of players) {
                const instanceDataId = player.dataset.instance_id.split('-')[0];
                const instanceTrackData = document.querySelector(`li[id^="data-${instanceDataId}"]`)
                if ( instanceTrackData ) {
					if ( instanceTrackData.dataset.tracks ) {
						tracks = JSON.parse( window.atob(instanceTrackData.dataset.tracks) )
						nonce = instanceTrackData.dataset.nonce
					}
                } else if ( player.dataset.tracks ) {
					tracks = JSON.parse( window.atob(player.dataset.tracks) )
					nonce = player.dataset.nonce
					player.removeAttribute('data-tracks')
                }
				if ( tracks?.length > 0 ) {
                    this.queue.push( { player, tracks, nonce } )
                }
            }
            requestAnimationFrame( () => this.processQueue() )
        }
    }

    stickyPlayerInit() {
        if ( !this.node ) {
            return
        }

        const waveform = this.node.querySelector('#vwwvpl-sticky-player .vwwvpl-waveform')

        if ( !waveform ) {
            return
        }

        const canvas = document.createElement('canvas')

        waveform.innerHTML = ''
        waveform.appendChild(canvas)
    }

    navigatorInit() {
        if ('mediaSession' in navigator) {
            navigator.mediaSession.setActionHandler('play', () => {
                this.play()
            })
            navigator.mediaSession.setActionHandler('pause', () => {
                this.pause()
            })
            navigator.mediaSession.setActionHandler('previoustrack', () => {
                this.skip(false)
            })
            navigator.mediaSession.setActionHandler('nexttrack', () => {
                this.skip()
            })
            navigator.mediaSession.setActionHandler('seekto', ( { seekTime } ) => {
                this.setCurrentTime( seekTime )
            })
        }
    }

    isPaused() {
        return this.audio().paused
    }

    play( time ) {

		const track = this.getCurrentTrack()

	    this.audioPaused = false

        this.updateMediaSession( track )

		if ( ! this.switched && encodeURI( this.audio().src ) === encodeURI( track.file ) ) {
			this.audio().play()
			.then( () => {
				this.thenPlay( time )
			})
			return
		}

		this.persistentTrack = track
		this.status = 0
        this.switched = false
        this.updateStickyPlayerInfo()

		if ( this.isWebAudio() ) {
			if ( this.fadeTimeout ) {
	            clearTimeout( this.fadeTimeout )
	            this.gain.gain.cancelScheduledValues(this.audioCtx.currentTime)
	        }
			if ( this.analyserFadeTimeout ) {
	            clearTimeout( this.analyserFadeTimeout )
	            this.analyserGain.gain.cancelScheduledValues(this.audioCtx.currentTime)
	        }
		}

        this.audio().src = track.file
        this.audio().play()
        .then( () => {
            this.thenPlay( time )
        })
        .catch( (error) => {
            this.setAudioType( 'MediaElement' )
            this.audio().src = track.file
            this.audio().play()
            .then( () => {
                this.thenPlay( time )
            })
            .catch( () => {
                if ( this.failedAttempts < WVPL_MAX_FAILED_ATTEMPTS ) {
                    this.failedAttempts++
                    this.tryReloadingTrack()
                }
            })
        })
    }

	thenPlay( time ) {
		this.playing()
		this.failedAttempts = 0
		if ( time >= 0 ) {
			this.setCurrentTime( time )
		}
		this.toggleStickyPlayer( true )
		if ( this.isWebAudio() ) {
			this.trackLastStart = this.getCurrentTime()
			this.fadeIn( .1 )
			this.analyserFadeIn( .3 )
		}
	}

    pause() {
		return new Promise( (resolve, reject) => {
			this.audioPaused = true
			this.lastTime = this.audio().currentTime
	        this.node?.classList.remove('playing')

			if ( this.status > 0 ) {
				this.status = 2
				if ( this.isWebAudio() ) {
					this.fadeOut( .1 )
					this.analyserFadeOut( .3, () => {
			            this.webAudio.pause()
						this.setCurrentTime( this.lastTime )
						if ( ! this.hasEnded ) {
							this.trigger( 'pause' )
						}
						resolve()
			        })
				} else {
					this.mediaElement.pause()
					resolve()
				}
			} else {
				resolve()
			}
		})
    }

    stop() {
        this.pause()
		.then( () => {
			this.status = 0
			this.setCurrentTime( 0 )
		})
    }

    toggle() {
        const instance = this.getCurrentInstance()

        if ( this.isPaused() ) {
            instance.play()
        } else {
            instance.pause()
        }
    }

    resume() {
        if (this.audioCtx) {
            this.audioCtx.resume()
        }
    }

    tryReloadingTrack() {
        const instance = this.getInstanceById(),
              track = instance.tracks[instance.currentTrack]

        if ( track?.type !== 'soundcloud' ) {
            return
        }

        track.file = ''
        instance.preloadTrack( true )
    }

    getCurrentTime() {
		if ( this.audioPaused )
			return this.lastTime

        return this.audio().currentTime
    }

    setCurrentTime(time, forcePlay = false) {
		this.trackLastStart = time
        if (time >=0 && time <= this.getDuration() ) {
			this.audio().currentTime = time
		}

        if ( this.isPaused() && forcePlay )
            this.play()
    }

    getDuration() {
        return this.audio().duration
    }

    getProgress() {
        return this.getCurrentTime() / this.getDuration()
    }

    getVolume() {
        return this.volume
    }

    setVolume( volume ) {
        const outputs = []

        if ( this.isInstanceInDOM() )
            outputs.push( this.getCurrentInstance().node )

        if ( this.hasStickyPlayer() ) {
            outputs.push( this.node )
        }

        for( const output of outputs ) {
            const sliderValue = output.querySelector('.vwwvpl-volume-slider .value'),
                  sliderHandle = output.querySelector('.vwwvpl-volume-slider .handle')

            sliderValue && ( sliderValue.style.width = `${(volume * 100)}%` )
            sliderHandle && ( sliderHandle.style.left = `${(volume * 100)}%` )
        }

        this.volume = volume
		if ( this.isWebAudio() ) {
			this.gain.gain.setValueAtTime(volume, this.audioCtx.currentTime)
		}
        this.muted = !(volume > 0)
    }

    mute() {
		if ( this.isWebAudio() ) {
        	this.gain.gain.setValueAtTime(0, this.audioCtx.currentTime)
		}
        this.muted = true
    }

    unmute() {
		if ( this.isWebAudio() ) {
        	this.gain.gain.setValueAtTime(this.volume, this.audioCtx.currentTime)
		}
        this.muted = false
    }

    toggleMute() {
        this.muted ? this.unmute() : this.mute()
    }

    isMuted() {
        return this.muted
    }

	fadeOut( time, fn ) {
		if ( this.isMediaElement() ) {
			fn && fn()
			return
		}
        this.gain.gain.setValueAtTime(this.volume, this.audioCtx.currentTime )
        this.gain.gain.linearRampToValueAtTime(0, this.audioCtx.currentTime + time )
        if ( fn ) {
            this.fadeTimeout = setTimeout( fn, 1000 * time )
        }
    }

    fadeIn( time, fn ) {
		if ( this.isMediaElement() ) {
			fn && fn()
			return
		}
		this.gain.gain.setValueAtTime(0, this.audioCtx.currentTime )
        this.gain.gain.linearRampToValueAtTime(this.volume, this.audioCtx.currentTime + time )
        if ( fn ) {
            this.fadeTimeout = setTimeout( fn, 1000 * time )
        }
    }

	analyserFadeOut( time, fn ) {
		if ( this.isMediaElement() ) {
			fn && fn()
			return
		}
        this.analyserGain.gain.linearRampToValueAtTime(0, this.audioCtx.currentTime )
        if ( fn ) {
            this.analyserFadeTimeout = setTimeout( fn, 1000 * time )
        }
    }

    analyserFadeIn( time, fn ) {
		if ( this.isMediaElement() ) {
			fn && fn()
			return
		}
        this.analyserGain.gain.linearRampToValueAtTime(this.volume, this.audioCtx.currentTime )
        if ( fn ) {
            this.analyserFadeTimeout = setTimeout( fn, 1000 * time )
        }
    }

    isLooped() {
        return this.audio().loop
    }

    loop( looped ) {
        this.audio().loop = looped
    }

    getSampleRate() {
        return this.audioCtx.sampleRate
    }

    setSmoothingTimeConstant( stc ) {
        if ( this.isMediaElement() )
            return
        if ( !this.analyser )
            this.createAnalyser()
        this.analyser.smoothingTimeConstant = stc
    }

    redrawAllInstances() {
        for ( const instance of this.getInstancesInDOM() ) {
            instance.refresh()
        }
        this.setSkipState()
    }

	playing() {
		this.audioProcess()
		const instance = this.getCurrentInstance()
		if ( instance ) {
			instance.playing()
			instance.node.classList.remove('seeking')
		}
		if ( this.node ) {
			this.node.classList.remove('seeking')
			this.node.classList.add('playing')
		}
		this.trigger( 'play' )
		this.status = 1
	}

	seeking() {
        setTimeout( () => {
            if (this.audio().seeking ) {
                const instance = this.getCurrentInstance()
                instance?.node.classList.add('seeking')
                this.node?.classList.add('seeking')
                this.trigger( 'seeking' )
            }
        }, 100 )
	}

	seeked() {
		const instance = this.getCurrentInstance()
		instance?.node.classList.remove('seeking')
		this.node?.classList.remove('seeking')
		this.trigger( 'seeked' )
	}

    addEvents() {
        this.onDocumentVisibilityChange()
        this.onSeeking()
        this.onSeeked()
        this.onEnded()
        this.onTimeUpdateFallback()
    }

    onDocumentVisibilityChange() {
        document.addEventListener( 'visibilitychange', () => {
            if ( this.isPaused() ) {
                return
            }

            this.resume()
        } )
    }

    onSeeking() {
        this.webAudio.addEventListener('seeking', e => {
			this.seeking()
        })
        this.mediaElement.addEventListener('seeking', e => {
			this.seeking()
        })
    }

    onSeeked() {
        this.webAudio.addEventListener('seeked', e => {
			this.seeked()
        })
        this.mediaElement.addEventListener('seeked', e => {
			this.seeked()
        })
    }

    onEnded() {
        this.webAudio.addEventListener('ended', e => {
			this.hasEnded = true
            this.trigger( 'ended' )
        })
        this.mediaElement.addEventListener('ended', e => {
			this.hasEnded = true
            this.trigger( 'ended' )
        })
    }

    onTimeUpdateFallback() {
        this.mediaElement.addEventListener( 'timeupdate', (event) => {
            const instance = this.getCurrentInstance()
            instance?.timeUpdate()
        })
    }

	gtmPushTimeData( action ) {
		window.dataLayer = window.dataLayer || []

		const track = this.getCurrentInstance().getTrack(),
			  time  = this.round( this.getCurrentTime(), 2 )

		if ( ! track )
			return

		const data = {
			'event': 'track',
			'action': action,
			'type': 'time',
			'trackId': track.id || 0,
			'trackTitle': track.title || '',
			'time': time || 0,
		}
		window.dataLayer.push(data);
	}

	gtmPushSegmentData( action ) {
		window.dataLayer = window.dataLayer || []

		const track = this.getCurrentTrack(),
			  time  = this.round( this.getCurrentTime(), 2 )

		if ( ! track )
			return

		const data = {
			'event': 'track',
			'action': action,
			'type': 'segment',
			'trackId': track.id || 0,
			'trackTitle': track.title || '',
			'time': time || 0,
			'from': this.round( this.trackLastStart, 2 ),
			'duration': this.round( time - this.trackLastStart ),
		}
		window.dataLayer.push(data);
	}

	round( num, decimals ) {
		decimals = decimals || 0
		const divider = Math.pow( 10, decimals )
		const epsilon = Number.EPSILON || Math.pow( 2, -52 )
		return Math.round( num * divider + epsilon ) / divider
	}

	trigger( type, detail ) {
		const instance = this.getCurrentInstance()
		if ( instance ) {
			this.getCurrentInstance().trigger( type, detail )
		}
	}

	secondsToTime(pos) {
        if (pos == null) return '0:00'
        pos = Math.round(pos)

        var seconds = pos % 60,
            minutes = Math.floor(pos / 60) % 60,
            hours = Math.floor(pos / 3600)

        return (hours > 0 ? hours + ":" : "") + (hours > 0 && minutes < 10 ? "0" : "") + minutes + ":" + (seconds < 10 ? "0" : "") + seconds
    }

	timeToSeconds( time ) {
		const matches = time.match(/((1*[0-2]|0*[0-9]):)?([0-5]*[0-9]):([0-5][0-9])/)
		if ( matches ) {
			let seconds = Number( matches[4] )
			if ( matches[3] ) {
				seconds += 60 * Number( matches[3] )
			}
			if ( matches[2] ) {
				seconds += 60 * 60 * Number( matches[2] )
			}
			return seconds
		}
		return false
	}

    shortenNumber( num ) {
        num = Number(num)

        if ( num < 1000 ) {
            return num.toFixed(0)
        }

        const units = [ '', 'k', 'M', 'G', 'T', 'P', 'E' ]
        let index = 0

        while ( num >= 1000 ) {
            num = num / 1000
            index++
        }

        return num.toFixed(1) + units[index]
    }

	isDebugMode() {
		return this.vars.is_script_debug
	}

    log( ...args ) {
        if ( this.isDebugMode() ) {
            console.debug( ...args )
        }
    }
}

const WVPL_STATUS_STOP = 0,
      WVPL_STATUS_PLAY = 1,
      WVPL_STATUS_PAUSE = 2,
      WVPL_ANIMATION_TIME = 300

class WVPLInstance {

    constructor( node, tracks, nonce, engine ) {
		this.init( node, tracks, nonce, engine )
	}

    init( node, tracks, nonce, engine ) {
        this.id = node.dataset.instance_id
        this.node = node
        this.engine = engine
        this.tracks = tracks
		this.currentTrack = 0
		this.nonce = nonce
        this.waveformOptions = null
        this.resetRuntime()
        this.info = this.getData('info')
        this.lastStart = 0
        this.scrolling = false
        this.timerOverlay
        this.startOffset
        this.startVol
        this.mousePosition = -1
        this.status = WVPL_STATUS_STOP
		this.createObservers()
        this.instanceInit()
    }

    getOption( name ) {
        const value = this.engine.getOption( name ) || ''
        return value
    }

    getData( name ) {
        let data = this.node.dataset[name]

        if ( data === undefined || data.toString().length === 0 ) {
            data = this.getOption(name)
        }

        return data
    }

    support( feature ) {
        const skin = this.getData('skin')
        const skins = this.engine.vars.skins

        return skins[skin]?.support?.indexOf(feature) > -1
    }

    getStickyPlayerData( name ) {
        if ( ! this.engine.node )
            return
        let value = undefined
        value = getComputedStyle(this.engine.node).getPropertyValue(`--${name}`).trim()
        return value
    }

    updateLength() {
        if ( !this.getFirst('.vwwvpl-duration') )
            return

        this.getFirst('.vwwvpl-duration').textContent = this.getTrackData('length_formatted')
        this.getFirst('.vwwvpl-position').textContent = this.engine.secondsToTime()
		if ( this.getTrackData('length_formatted') ) {
			this.getFirst('.vwwvpl-duration').style.width = ( `${this.getTrackData('length_formatted').length+1}ch` )
			this.getFirst('.vwwvpl-position').style.width = ( `${this.getTrackData('length_formatted').length+1}ch` )
		}
    }

    getRealWaveformSize( player ) {
        player = player || this.node
        const waveform = player.querySelector('.vwwvpl-waveform')
        if ( !waveform ) {
            return false;
        }

        var computedStyle = getComputedStyle(waveform)

        let height = waveform.clientHeight // height with padding
        let width = waveform.clientWidth // width with padding

        if ( (width * height) > 0 )
            return {width: width, height: height}

        let node = waveform,
            parent = node
        while ( parent = parent.parentNode ) {
            if ( parent.offsetWidth * parent.offsetHeight > 0 ) break
            node = parent
        }
        if ( parent ) {
            let cloneNode = node.cloneNode(true)
            cloneNode.style.display = 'block'
            parent.append(cloneNode)

            let cloneWave = cloneNode.querySelector('.vwwvpl-waveform')
            if ( cloneWave ) {
                width = cloneWave.offsetWidth
                height = cloneWave.offsetHeight
            }
            cloneNode.remove()
        }
        return {width: width, height: height}
    }

    getWaveformOptions( player ) {
        player = player || this.node
        const waveform = player.querySelector('.vwwvpl-waveform')
        if ( !waveform ) {
            return false;
        }
        const isSticky = (player === this.engine.node )
        const getData = isSticky ? this.getOption.bind(this) : this.getData.bind(this)

        return {
            waveColor:          parseInt(getData('override_wave_colors')) ? 'rgb(' + getComputedStyle(player).getPropertyValue(`--wave`).trim() + ')' : getData('wave_color'),
            waveColor2:         parseInt(getData('override_wave_colors')) ? 'rgb(' + getComputedStyle(player).getPropertyValue(`--wave-shade`).trim() + ')' : getData('wave_color_2'),
            progressColor:      parseInt(getData('override_wave_colors')) ? 'rgb(' + getComputedStyle(player).getPropertyValue(`--progress`).trim() + ')' : getData('progress_color'),
            progressColor2:     parseInt(getData('override_wave_colors')) ? 'rgb(' + getComputedStyle(player).getPropertyValue(`--progress-shade`).trim() + ')' : getData('progress_color_2'),
            cursorColor:        parseInt(getData('override_wave_colors')) ? 'rgb(' + getComputedStyle(player).getPropertyValue(`--cursor`).trim() + ')' : getData('cursor_color'),
            cursorColor2:       parseInt(getData('override_wave_colors')) ? 'rgb(' + getComputedStyle(player).getPropertyValue(`--cursor-shade`).trim() + ')' : getData('cursor_color_2'),
            cursorWidth:        parseInt(getData('cursor_width')),
            hoverOpacity:       parseInt(getData('hover_opacity')) / 100,
            barWidth:           parseInt(getData('wave_mode')),
            gapWidth:           parseInt(getData('gap_width')),
            compression:        parseInt(getData('wave_compression')),
            asymmetry:          parseInt(getData('wave_asymmetry')),
            normalization:      parseInt(getData('wave_normalization')),
            waveAnimation:      parseFloat(this.getData('wave_animation')),
            ampFreqRatio:       parseFloat(this.getData('amp_freq_ratio')),
            height:             waveform.offsetHeight,
            bandwidth:          20000,
			bandwidthStart:     100,
        }
    }

    updateSize( force ) {
        const outputs = []

        if ( force || this.engine.isInstanceInDOM(this.id) ) {
            const canvas = Array.from( this.getChildren('canvas') ).filter( c => c.offsetHeight > 0 )
            if ( canvas.length > 0 ) {
                outputs.push( { player: this.node, instance: this } )
            }
        }

        if ( force || this.engine.hasStickyPlayer() ) {
            outputs.push( { player: this.engine.node, instance: this.engine.getCurrentInstance() } )
        }

        for( const output of outputs ) {
            const player = output.player

            if ( !player || !player.querySelector('.vwwvpl-waveform') )
                continue

            player.waveformOptions = this.getWaveformOptions(player)
            this.engine.setSmoothingTimeConstant( parseFloat(this.getData('wave_animation') || 1) )
            let canvas = player.querySelector('.vwwvpl-waveform canvas'),
                cCtx = canvas.getContext("2d"),
                size = this.getRealWaveformSize(player)

            try {
                cCtx.canvas.width = Math.round( size.width * window.devicePixelRatio )
                cCtx.canvas.height = Math.round( size.height * window.devicePixelRatio )
                canvas.style.width = (`${Math.round(size.width)}px`)
                canvas.style.height = (`${Math.round(size.height)}px`)
            } catch(e) {
                this.log( 'updateSize', e )
            }
            this.prepareCanvas(player)
			if ( this.getTrackData( 'peaks') ) {
				this.calculateWaveParams(player)
			}
        }
    }

    prepareCanvas( player ) {
        player = player || this.node

        const canvas = player.querySelector('.vwwvpl-waveform canvas'),
              cCtx = canvas.getContext("2d")
        canvas.grdW = this.createGradient( cCtx, cCtx.canvas.height, player.waveformOptions.waveColor, player.waveformOptions.waveColor2, player.waveformOptions.asymmetry )
        canvas.grdP = this.createGradient( cCtx, cCtx.canvas.height, player.waveformOptions.progressColor, player.waveformOptions.progressColor2, player.waveformOptions.asymmetry )
        canvas.grdC = cCtx.createLinearGradient( 0, 0, 0, cCtx.canvas.height )
        try {
            canvas.grdC.addColorStop( 0, player.waveformOptions.cursorColor )
            canvas.grdC.addColorStop( 1, player.waveformOptions.cursorColor2 )
        } catch(e) {
            this.log( 'prepareCanvas', e )
        }
    }

    createGradient( ctx, height, color1, color2, asymmetry ) {
        let grd = ctx.createLinearGradient(0, 0, 0, height)
        try{
            grd.addColorStop(0, color1)
            grd.addColorStop( asymmetry / ( 1 + asymmetry ) - 0.000000001, color2)
            grd.addColorStop( asymmetry / ( 1 + asymmetry ), color1)
            grd.addColorStop( 1, color2 )
        } catch(e) {
            this.log( 'createGradient', e )
        }
        return grd
    }

    clearWave( player ) {
        player = player || this.node
        let canvas = player.querySelector('.vwwvpl-waveform canvas'),
            ctx = canvas.getContext("2d")
        ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height)
    }

    waveformInit() {
        let waveform = this.getFirst('.vwwvpl-waveform'),
            canvas = document.createElement('canvas')
        if ( waveform ) {
            waveform.innerHTML = ''
            waveform.appendChild(canvas)
        }
    }

	processBuffer( buffer, trackId ) {
		if ( ! buffer || buffer.constructor !== ArrayBuffer ) {
			return false
		}
		this.engine.decodeAudioData( buffer, b => {
			const peaks = this.engine.extractPeaks( b )
			if ( !this.getTrackData('length') ) {
				this.setTrackData( 'length', b.duration )
				this.setTrackData( 'length_formatted', this.engine.secondsToTime(b.duration) )
			}
			this.setTrackData( 'peaks', peaks )
			this.updateInfo()
			this.trigger( 'peaksloaded', { peaks: peaks, id: trackId } )
		})
	}

	progressCallback( at, length ) {
		const p = Math.floor(100*at/length)
		this.updateOverlay( p, 'analyzing' )
	}

    waveReset(){
        this.clearWave()
        this.engine.node && this.clearWave(this.engine.node)
    }

    calculateWaveParams(player) {
        player = player || this.node
        const wp = {},
              dpr = window.devicePixelRatio

        wp.canvas = player.querySelector('.vwwvpl-waveform canvas')
        wp.cCtx = wp.canvas.getContext("2d")
        wp.width = wp.canvas.width
        wp.height = wp.canvas.height
        wp.barWidth = player.waveformOptions.barWidth == 0 ? 1 * dpr : player.waveformOptions.barWidth * dpr
        wp.gapWidth = player.waveformOptions.gapWidth == 0 ? 0 : player.waveformOptions.gapWidth * dpr
        wp.cursorWidth = player.waveformOptions.cursorWidth * dpr
        wp.compRatio = 1 / player.waveformOptions.compression
        wp.a = player.waveformOptions.asymmetry
        wp.stepSize = wp.barWidth + wp.gapWidth

		const peaks = this.getTrackData( 'peaks' )
		wp.scale = wp.width / peaks.length
		wp.max = 1
        if ( peaks && player.waveformOptions.normalization ) {
            wp.max = Math.max(...peaks)
        }
        player.waveParams = wp
    }

    drawWave() {
        const outputs = []

        const canvas = Array.from( this.getChildren('canvas') ).filter( c => c.offsetHeight > 0 )
        if ( canvas.length > 0 ) {
            outputs.push( { player: this.node, instance: this } )
        }

        if ( this.engine.hasStickyPlayer() ) {
            outputs.push( { player: this.engine.node, instance: this.engine.getCurrentInstance() } )
        }

        for( const output of outputs ) {

            const player = output.player,
                  instance = output.instance

            if ( ! player || ! instance || ! player.querySelector('.vwwvpl-waveform') )
                continue

            const peaks = instance.getTrackData( 'peaks' ),
                  currentTime = this.status !== WVPL_STATUS_STOP ? this.engine.getCurrentTime() : 0,
                  currentProgress = this.status !== WVPL_STATUS_STOP ? this.engine.getProgress() : 0

            let fData = this.status !== WVPL_STATUS_STOP ? this.engine.frequencyData : null

            if ( !peaks )
                return

            const position = player.querySelector('.vwwvpl-position')
            position && ( position.textContent = this.engine.secondsToTime( currentTime ) )

            const wp = player.waveParams,
                  wo = player.waveformOptions,
                  mp = player === this.node ? this.mousePosition : -1,
                  { scale, max } = wp,
                  progressWidth = currentProgress * wp.width

            let afRatio = wo.ampFreqRatio
            if ( wo.waveAnimation == 1 )
                afRatio = Infinity

			const rho = wo.bandwidthStart * wp.width / wo.bandwidth,
				  gamma = ( wp.width - rho ) / wp.width

            wp.cCtx.clearRect( 0, 0, wp.width, wp.height )

            const dpr = devicePixelRatio,
                  fF = 1 / ( afRatio + 1 ),
                  aF = 1 - fF
			let index = 0
            for ( var i = 0; i < wp.width - wp.stepSize; i += wp.stepSize ) {
				const fIndex = fData ? Math.round( Math.max( index, Math.pow( fData.length, i / wp.width ) ) ) : 0,
                      fAdd = fData ? max * fData[fIndex]/255 : 0,
                      peak = Math.pow( Math.abs(peaks[Math.floor(i / scale)]), wp.compRatio ),
                      h = Math.max( dpr, Math.abs( Math.ceil( wp.height * (aF*peak + fF*fAdd) / max ) ) )

                wp.cCtx.fillStyle = wp.canvas.grdW
                var peakY = Math.ceil( wp.a * ( wp.height - h ) / (1+wp.a) )
                wp.cCtx.globalAlpha = 1
                wp.cCtx.fillRect( i, peakY, wp.barWidth, h )
                if ( i < Math.max(mp, progressWidth) && this.status !== WVPL_STATUS_STOP ) {
                    wp.cCtx.fillStyle = wp.canvas.grdP
                    wp.cCtx.globalAlpha = 1
                    if ( mp >= 0 && i > Math.min(mp, progressWidth) && player === this.node )
                        wp.cCtx.globalAlpha = wo.hoverOpacity
                    wp.cCtx.fillRect( i, peakY, wp.barWidth, h )
                }
				index++
            }
            if ( this.status !== WVPL_STATUS_STOP ) {
                wp.cCtx.fillStyle = wp.canvas.grdC
                wp.cCtx.fillRect( progressWidth, 0, wp.cursorWidth, wp.height )
            }
        }
    }

    waveRedraw(){
        this.updateSize( true )
        this.drawWave( true )
    }

    timeUpdate() {
        this.drawWave()
        this.trigger( 'timeupdate' )
    }

    createObservers() {
        const config = { attributes: true, childList: false, subtree: false, attributeOldValue: true }
        this.mutationObserver = new MutationObserver( (mutationsList, observer) => {
            for(let mutation of mutationsList) {
                if ( mutation.type === 'attributes' ) {
                    if ( mutation.oldValue !== this.node.getAttribute( mutation.attributeName ) ) {
                        this.refresh()
                        break
                    }
                }
            }
            observer.disconnect()
            requestAnimationFrame( () => {
                observer.observe(this.node, config)
            } )
        })
        requestAnimationFrame( () => {
            this.mutationObserver.observe(this.node, config)
        } )

        if ( window.ResizeObserver ) {
            this.resizeObserver = new ResizeObserver( entries => {
                const thisEntry = entries.find( entry => entry.target.dataset.instance_id === this.id )
                if (  this.currentWidth !== thisEntry?.target.offsetWidth ) {
					this.currentWidth = thisEntry?.target.offsetWidth
                    requestAnimationFrame( () => {
                        this.resizeObserver.observe(this.node)
                    } )
                }
                this.resizeObserver.disconnect()
            })
            requestAnimationFrame( () => {
                this.resizeObserver.observe(this.node)
            } )
        }

		if ( window.IntersectionObserver ) {
			this.intersectionObserver = new IntersectionObserver( (entries) => {
				if(entries[0].isIntersecting === true && ! entries[0].target.classList.contains('vwwvpl-rendered')) {
                    this.intersectionObserver.disconnect()
                    delete this.intersectionObserver
					this.playerInit()
                }
        }, { threshold: [0] } )
            setTimeout( () => this.intersectionObserver.observe(this.node), 0 )
        }
    }

	instanceInit() {
		const playlistWrapper = this.getFirst('.vwwvpl-playlist-wrapper'),
              playlist = this.getFirst('.vwwvpl-playlist'),
              playBtn = this.getFirst('.vwwvpl-play'),
              position = this.getFirst('.vwwvpl-position'),
              duration = this.getFirst('.vwwvpl-duration')

        if ( playlistWrapper )
            playlistWrapper.innerHTML = ''

        let asymmetry = parseInt(this.getData('wave_asymmetry'))
        asymmetry = asymmetry * 100 / ( 1 + asymmetry )

        if ( position ) {
            position.style.top = asymmetry+'%'
            duration.style.top = asymmetry+'%'
        }

        let players = document.querySelectorAll('.vwwaveplayer'),
            index = 0,
            node = this.parentElement

        for (index=0; index<players.length; index++) {
            if ( players[index] == this.node )
                break
        }

        this.waveformInit()

        this.autoplay = !!Number(this.getData('autoplay'))
        this.repeat = !!Number(this.getData('repeat'))
        this.shuffle = !!Number(this.getData('shuffle'))

		this.activated()
		if ( ! window.IntersectionObserver ) {
			this.playerInit()
		}
	}

    playerInit( forcePlay ) {
		if ( this.node.classList.contains('vwwvpl-rendered') )
			return

        this.refresh()

        if (this.getTrackCount() > 0) {
			const track = this.getTrack(),
				  trackId = track.id,
				  filesize = track.filesize,
				  tempFile = track.temp_file
			this.node.classList.add( 'vwwvpl-rendered' )
            this.currentTrack = 0
            if ( tempFile ) {
                this.analyzing()
                this.engine.getAudioData( tempFile, trackId, this.progressCallback.bind(this) )
				.then( buffer => {
					this.processBuffer( buffer, trackId )
				})
            } else {
                this.setInfoState()
                this.displayPlaylist()
                this.preloadTrack( forcePlay )
            }
            this.initEvents()
        } else {
            if ( playBtn )
                playBtn.classList.add( 'vwwvpl-disabled' )
            this.node.classList.add('vwwvpl-hidden')
        }
    }

    getCurrentTime() {
        return this.engine.getCurrentTime()
    }

    setCurrentTime(pos) {
        if ( pos < 0 || pos > this.engine.getDuration() ) return false
        this.engine.setCurrentTime(pos)
    }

    maybeSwitch() {
		return new Promise( (resolve, reject) => {
			if ( this.id !== this.engine.getCurrentId() ) {
				this.trigger( 'skip' )
				this.engine.pause()
				.then( () => {
					this.engine.setCurrentInstance( this )
			        this.preloadTrack()
					resolve()
				})
			} else {
                reject()
			}
		})
    }

    play() {
        this.node?.classList.add('seeking')
        this.engine?.node?.classList.add('seeking')
        this.maybeSwitch()
            .then( () => {
                this.lastStart = (new Date()).getTime()
                return this.engine.play()
            }, () => {
                this.lastStart = (new Date()).getTime()
                return this.engine.play()
            })
            .catch( () => {
                this.lastStart = (new Date()).getTime()
                return this.engine.play()
            })
    }

    pause() {
        this.engine.pause()
        this.paused()
        this.waveRedraw()
    }

    stop() {
        if (this.status == WVPL_STATUS_STOP) return false
        this.engine.stop()
        this.paused()
        this.getFirst('.vwwvpl-position') && ( this.getFirst('.vwwvpl-position').textContent = this.engine.secondsToTime(0) )
        this.status = WVPL_STATUS_STOP
        this.waveRedraw()
    }

    skip( forward = true ) {
        this.clicked = true
        const eop = this.endOfPlaylist( forward )
        this.stop()
        if ( this.endOfPlaylist( forward ) ) {
        	this.currentTrack = 0
        }
        // } else {
        //     this.setCurrentTime( 0 )
        //     this.pause()
        // }

        if ( this.engine.currentId !== this.id ) {
            this.engine.setCurrentInstance( this )
        }
        this.engine.skip( forward )
    }

    skipTo(index) {
        if (index == null || index < 0 || index > this.getTrackCount()) return false
        if ( index == this.currentTrack ) {
            if ( this.status !== WVPL_STATUS_PLAY ) {
                this.play()
            }
            return true
        }
		const currentInstance = this.engine.getCurrentInstance()
		if ( ! currentInstance || currentInstance.node.id !== this.node.id ) {
			this.pause()
			this.engine.setCurrentInstance( this )
		}
        this.skip( index )
    }

    endOfPlaylist( forward = true ) {
        const eop = ( forward === true && this.currentTrack === this.tracks.length )
               || ( forward === false && this.currentTrack === 1 )
               || this.tracks.length === 1
        return eop && !this.repeat
    }

    scrollTo(index, next) {
        let list = this.getFirst('.vwwvpl-playlist-wrapper>ul')

        if ( ! list ) {
            return false
        }

        let rows = list.children,
            el = rows.length && rows[index]
        if ( ! el ) {
            return false
        }

        if ( next ) {
            if ( el.offsetTop + el.offsetHeight > list.scrollTop + list.offsetHeight ) {
                list.scrollTo({top: el.offsetTop + el.offsetHeight - list.offsetHeight, behavior:'smooth'})
            }
        } else {
            if ( el.offsetTop < list.scrollTop ) {
                list.scrollTo({top: el.offsetTop, behavior:'smooth'})
            }
        }
    }

    analyzing() {
        this.node.classList.remove( 'loading' )
        this.node.classList.add( 'analyzing' )
        this.trigger( 'analyzing' )
    }

    analyzed() {
        this.node.classList.remove( 'analyzing' )

		this.updateOverlay( 0, '' )
        this.trigger( 'analyzed', { track: this.getTrack(), peaks: this.getTrackData( 'peaks' ) } )
    }

    loading() {
        if ( this.engine.switched ) {
            return true;
        }
        this.node.classList.add( 'loading' )
        this.trigger( 'loading' )
    }

    loaded() {
        setTimeout( () => {
            this.node.classList.remove( 'loading' )
            this.waveRedraw()
            this.trigger( 'loaded' )
        }, WVPL_ANIMATION_TIME)
    }

    playing() {
        this.status = WVPL_STATUS_PLAY
		this.removeClassFrom('.vwwvpl-playlist li', 'playing' )
        let playlistRow = this.getChild('.vwwvpl-playlist-wrapper>ul>li', this.currentTrack)
        if ( playlistRow ) {
            playlistRow.classList.add('playing')
        }
        this.node.classList.add( 'playing' )
    }

    paused() {
        this.status = WVPL_STATUS_PAUSE
        this.updateRuntime(false)
        this.node.classList.remove( 'playing', 'seeking' )
        this.engine.node?.classList.remove( 'playing', 'seeking' )
        this.removeClassFrom( '.vwwvpl-playlist li', 'playing' )
    }

    ready() {
        this.loaded()
        this.trigger( 'ready', { instance: this, track: this.getTrack() } )
    }

    activated( addClass = '' ) {
        this.node.classList.add( 'active' )
        if ( addClass ) {
            this.node.classList.add( addClass )
        }
        this.trigger( 'activated', { id: this.id } )
    }

    resize() {
        const width = this.node.offsetWidth,
              widthClasses = [ {width: 400, class: 'sqxxs'}, {width: 600, class: 'sqxs'}, {width: 800, class: 'sqsm'}, {width: 1000, class: 'sqmd'}, {width: 1200, class: 'sqlg'}, {width: Infinity, class: 'sqxl'} ]

        let widthClass = '';
		const maxWidth = Number(getComputedStyle(this.node).getPropertyValue('--max-width').replace(/(px|em)/,'')) || 1200;

        for( const wC of widthClasses ) {
            widthClass = wC.class
            if ( ( width * 1200 / maxWidth ) < wC.width )
                break;
        }

        this.node.classList.remove( ...widthClasses.map( wc => `vwwvpl-${wc.class}`) );
        this.node.classList.add(`vwwvpl-${widthClass}`)
    }

    refresh() {
        this.setSkipState()
        this.waveRedraw()
    }

    preloadTrack( forcePlay = false ) {
        if (this.currentTrack < 0) this.currentTrack = 0

        this.engine.loop( this.getTrackCount() == 1 && this.repeat )

        if ( this.getTrackData( 'type' ) === 'soundcloud' && !this.getTrackData( 'file' ) ) {
			fetch( `${this.engine.vars.sc_api_url}tracks/${this.getTrackData( 'id' )}/streams`, { headers: { 'Authorization': `OAuth ${this.engine.vars.sc_access_token}` } } )
			.then( response => response.json(), error => this.log( error ) )
			.then( data => {
				if ( undefined !== data?.http_mp3_128_url ) {
                    this.setTrackData( 'file', data?.http_mp3_128_url )
                    this.preloadFile( forcePlay )
                } else {
					this.log( `${data?.code}: ${data?.message}` )
                    this.removeTrack( this.currentTrack )
                    this.preloadTrack( forcePlay )
                }
			}, error => this.log( error ) )
        } else {
			const peakFile = this.getTrackData('peak_file')
			if ( ! this.getTrackData( 'peaks' ) && peakFile ) {
				fetch( peakFile )
					.then( response => response.text() )
					.then( text => {
						let peaks = []
						if ( 'external' === this.getTrackData('type') ) {
							peaks = JSON.parse(text).peaks
						} else {
							peaks = text
						}
						if ( peaks ) {
							peaks = this.engine.readPeaks( peaks )
							this.setTrackData( 'peaks', peaks )
							this.preloadFile( forcePlay )
						}
					})
			} else {
				this.preloadFile( forcePlay )
			}
        }
    }

	updateOverlay( percentage, message ) {
        switch ( message ) {
            case 'creatingLocalCopy':
                message = this.engine.__( 'creating a local copy of the file&hellip;', 'vwwaveplayer' )
                break;
            case 'savingPeaks':
                message = this.engine.__( 'saving the peak file&hellip;', 'vwwaveplayer' )
                break;
            case 'analyzing':
                message = this.engine.__( 'audio analysis in progress&hellip;', 'vwwaveplayer' )
                break;
        }
		const overlay = this.overlay || this.getFirst('.vwwvpl-overlay')

		if ( overlay ) {
			overlay.querySelector('.percentage').innerHTML = percentage ? `${percentage}%` : '&nbsp;'
			overlay.querySelector('.vwwvpl-loading>div').style.width = `${percentage}%`
			overlay.querySelector('.message').innerHTML = message
		}
		this.overlay = overlay
	}

    preloadFile( forcePlay ) {
        this.updateInfo()
        if ( this.getTrackData( 'peaks' ) ) {
            if ( forcePlay || this.status === WVPL_STATUS_PLAY ) {
                this.play()
            }
        } else {
			this.pause()
			this.analyzing()
			const track = this.getTrack(),
				  trackId = track.id,
			      file = track.file,
				  filesize = track.filesize,
				  tempFile = track.temp_file
			if ( this.getTrackData( 'type' ) !== 'external'  ) {
				this.engine.getAudioData( file, trackId, this.progressCallback.bind(this) )
				.then( buffer => {
					this.processBuffer( buffer, trackId )
				})
			} else {
				this.updateOverlay( 0, 'creatingLocalCopy' )
				const postData = {
	                nonce: this.engine.vars.ajax_nonce,
	                url: file
	            }
	            this.engine.ajaxCall( 'create_local_copy', postData )
				.then( result => {
					if ( result?.success ) {
						this.tracks[ this.currentTrack ] = result?.data?.track
			            this.engine.getAudioData( result?.data?.track?.temp_file, trackId, this.progressCallback.bind(this) )
						.then( buffer => {
							this.processBuffer( buffer, trackId )
						})
	                } else {
						this.updateOverlay( 0, result?.data?.message )
					}
				})
			}
        }
    }

    reload() {
        this.reset()
    }

    reset() {
        this.currentTrack = 0
		this.paused()
        this.setSkipState()
        this.preloadTrack()
    }

    toggle() {
        switch (this.status) {
            case WVPL_STATUS_PLAY:
                this.pause()
                break
            case WVPL_STATUS_STOP:
            case WVPL_STATUS_PAUSE:
                this.play()
                break
        }
    }

    setInfoState() {
        const infoBtn = this.getFirst('.vwwvpl-info'),
              infoBar = this.getFirst('.vwwvpl-infobar'),
              playlist = this.getFirst('.vwwvpl-playlist')

        const states = [ 'none', 'info' ]
        if ( this.getTrackCount() > 1 ) states.push('playlist')
        const nextInfo = states[(states.indexOf(this.info)+1) % states.length]
        infoBtn?.classList.remove( 'vwwvpl-info-none', 'vwwvpl-info-info', 'vwwvpl-info-playlist' )
        infoBtn?.classList.add( `vwwvpl-info-${nextInfo}` )
        infoBar?.classList.add( 'vwwvpl-hidden' )
        playlist?.classList.add( 'vwwvpl-hidden' )
        this?.node?.classList.add( 'vwwvpl-has-no-playlist' )

        switch( this.info ) {
            case 'none':
                break
            case 'info':
                infoBar?.classList.remove( 'vwwvpl-hidden' )
                break
            case 'playlist':
                infoBar?.classList.remove( 'vwwvpl-hidden' )
                if ( this.getTrackCount() > 1 ) {
                    playlist?.classList.remove( 'vwwvpl-hidden' )
                    this?.node?.classList.remove( 'vwwvpl-has-no-playlist' )
                }
                break
        }
    }

    toggleInfoState() {
        const states = [ 'none', 'info' ]
        if ( this.getTrackCount() > 1 ) states.push('playlist')
        if (this.info == 'playlist' && this.getTrackCount() == 1 ) this.info = 'info'

        this.info = states[(states.indexOf(this.info)+1) % states.length]

        this.setInfoState()
    }

    setSkipState() {
        let prevBtn = this.getFirst('.vwwvpl-prev'),
            nextBtn = this.getFirst('.vwwvpl-next')

        prevBtn?.classList.remove( 'vwwvpl-disabled' )
        nextBtn?.classList.remove( 'vwwvpl-disabled' )
        switch ( true ) {
            case this.getTrackCount() === 1:
                prevBtn?.classList.add( 'vwwvpl-disabled' )
                nextBtn?.classList.add( 'vwwvpl-disabled' )
                break
            case this.currentTrack === 0:
                prevBtn?.classList.add( 'vwwvpl-disabled' )
                break
            case this.currentTrack === this.getTrackCount() - 1:
                nextBtn?.classList.add( 'vwwvpl-disabled' )
                break
        }
    }

    updateInfo() {
        if ( this.getCurrentTrackIndex >= this.getTrackCount() - 1 ) {
            return false
        }
        this.loading()
        const track = JSON.parse( JSON.stringify( this.getTrack() ) )
        if ( track.stats ) {
            track.stats.downloads = this.engine.shortenNumber( track.stats.downloads )
            track.stats.play_count = this.engine.shortenNumber( track.stats.play_count )
            track.stats.likes = this.engine.shortenNumber( track.stats.likes )
        }
        const thumbnailURL = track.poster_thumbnail || this.getData('default_thumbnail')
        this.node.style.setProperty('--poster-image', `url(${thumbnailURL})`)

        const posterContainer = this.node.querySelector('.vwwvpl-poster')
        const posterWidth = posterContainer ? posterContainer.offsetWidth : this.node.offsetWidth
        const posterHeight = posterContainer ? posterContainer.offsetHeight : this.node.offsetHeight
        const posterSrcset = track.poster_srcset || ''
        const posterFigure = document.createElement('figure')
        const posterImg = document.createElement('img')
        posterFigure.append(posterImg)
        posterImg.width = posterWidth
        posterImg.height = posterHeight
        posterImg.src = thumbnailURL
        posterImg.srcset = posterSrcset
        posterImg.sizes = `${posterWidth}px`

        setTimeout( () => {
            if ( posterContainer ) {
                posterContainer.innerHTML = ''
                posterContainer.append(posterFigure)
            }
        }, WVPL_ANIMATION_TIME )

        this.updateLength()

        // if ( ! this.support('infobar') ) {
        //     this.loaded()
        //     return
        // }

        let message = this.getData('template')

        message += track.type === 'soundcloud' ? ' %soundcloud%' : ''

        setTimeout( () => {
            if ( message == null ) {
                message = track.title
            } else {
                message = this.engine.applyTemplate(message, track)
            }
    
            const infoBlock = this.getFirst('.vwwvpl-playing-info .vwwvpl-infoblock')
            if ( infoBlock ) {
                infoBlock.innerHTML = message
                if ( ! message )
                    infoBlock.classList.add('vwwvpl-hidden')
            }
            this.loaded()
        }, WVPL_ANIMATION_TIME )
    }

    displayPlaylist() {
        if ( ! this.support('playlist') ) {
            return
        }
        
        let list = document.createElement('ul')
        let charLength = 0

        for ( const t of this.tracks ) {
            let item = document.createElement('li')

            const track = JSON.parse( JSON.stringify(t) )

            if ( track.stats ) {
                track.stats.downloads = this.engine.shortenNumber( track.stats.downloads )
                track.stats.play_count = this.engine.shortenNumber( track.stats.play_count )
                track.stats.likes = this.engine.shortenNumber( track.stats.likes )
                charLength = Math.max( charLength, track.stats.downloads.length, track.stats.play_count.length, track.stats.likes.length )
            }

            item.innerHTML = this.engine.applyTemplate( this.getData('playlist_template'), track )
            list.append(item)
        }

        this.getFirst('.vwwvpl-playlist-wrapper')?.append(list)
        this.getFirst('.vwwvpl-playlist')?.style.setProperty('--stats-char-length', `${charLength}ch`)
    }

    updatePlaylistStats( index, stats ) {
        if ( ! this.support('playlist') ) {
            return
        }
        
        const playlistItem = this.getChild( `.vwwvpl-playlist li`, index )

        for ( const key of [ 'play_count', 'downloads', 'runtime', 'likes' ] ) {
            const stat = playlistItem.querySelector( `.vwwvpl-${key} .vwwvpl-value` )

            if ( stat ) {
                if ( key === 'runtime' ) {
                    stat.innerHTML = this.engine.secondsToTime( stats[key] )
                } else {
                    stat.innerHTML = this.engine.shortenNumber( stats[key] )
                }
            }
        }
    }

    updateStatistics() {
        const nLocal = this.currentTrack,
              postData = {
                  nonce: this.engine.vars.ajax_nonce,
                  id: this.getTrackData( 'id', nLocal ),
                  length: this.getTrackData( 'length', nLocal ),
                  runtime: this.updateRuntime()
              }

        if ( postData.runtime < 1 ) {
            return
        }

        this.resetRuntime()

        this.engine.ajaxCall( 'update_statistics', postData )
		.then( result => {
			if ( result?.success ) {
                result?.data?.stats && this.setTrackData( 'stats', result.data.stats, nLocal )
                this.updatePlaylistStats( nLocal, result.data.stats )
            } else {
				this.log( result?.data?.message )
			}
		})
    }

    getRuntime() {
        return this.runtime
    }

    updateRuntime( restart = true ) {
        if ( this.lastStart > 0 ) {
            const timeNow = Date.now()
            this.runtime += ( timeNow - this.lastStart )
            this.lastStart = restart ? timeNow : 0
        }

        return this.getRuntime()
    }

    resetRuntime() {
        this.runtime = 0
    }

    updateLikes(node) {
        if ( this.engine.vars.currentUser.ID == 0 ) return false
        const nodes = document.querySelectorAll('.vwwvpl-likes[data-id="'+node.dataset.id+'"]')
        for( const n of nodes ) {
            n.classList.add('vwwvpl-spin')
        }
        const postData = {
            nonce: this.engine.vars.ajax_nonce,
            id: node.dataset.id,
        }
        this.engine.ajaxCall( 'update_likes', postData )
		.then( result => {
			if ( result?.success ) {
                result?.data?.liked && this.setTrackData( 'liked', result.data.liked, node.dataset.index )
                result?.data?.stats && this.setTrackData( 'stats', result.data.stats, node.dataset.index )

                for( const n of nodes ) {
                    n.dataset.event = result?.data?.liked ? 'unlike':'like'
                    n.classList.toggle('liked', result?.data?.liked)
                    n.classList.remove('vwwvpl-spin')
                    const valueSpan = n.querySelector('.vwwvpl-value')
                    if ( valueSpan ) {
                        valueSpan.textContent = this.engine.shortenNumber( this.getTrackData( 'stats', node.dataset.index ).likes )
                    }
                }
			} else {
				this.log( result?.data?.message )
			}
		})
    }

    addToCart(node, event) {
        const target = event.target
        const productId = node.dataset.product_id
        const track = this.tracks.find( t => t.product_id == productId )
        let cartBtns = document.querySelectorAll('.vwwvpl-cart[data-product_id="'+productId+'"]')
        if ( ! cartBtns )
            return

        if ( track?.product_variations ) {
            this.engine.updateVariationForm( track )
        } else {
            const postData = {
                      nonce: this.engine.vars.ajax_nonce,
                      product_id: productId
                  }

            for( const cartBtn of cartBtns ) {
                cartBtn.classList.add('vwwvpl-spin')
            }

            this.engine.ajaxCall( 'add_to_cart', postData )
			.then( result => {
				if ( result?.data?.fragments ) {
                    track.in_cart = 1
                    for( const cartBtn of cartBtns ) {
                        cartBtn.title = this.engine.__( 'Already in cart: go to cart', 'vwwaveplayer' )
                        cartBtn.classList.remove('vwwvpl-spin','vwwvpl-add_to_cart')
                        cartBtn.classList.add('vwwvpl-in_cart')
                        cartBtn.dataset.event = 'goToCart'
                        cartBtn.dataset.callback = 'goToCart'
                    }
                    for ( const key in result.fragments ) {
                        let fragment = document.querySelector(key)
                        if ( fragment )
                            fragment.outerHTML = result.data.fragments[key]
                    }
                    jQuery( document.body ).trigger( 'wc_fragment_refresh' );
    				jQuery( document.body ).trigger( 'added_to_cart', [ result.data.fragments, result.data.cart_hash, target ] );
                    this.engine.vars.ajax_nonce = result.data.ajax_nonce
                } else {
                    for( const cartBtn of cartBtns ) {
                        cartBtn.classList.remove('vwwvpl-spin')
                    }
                    this.log( 'addToCart', result )
                }
			})
        }
    }

    addVariationToCart(variationID, productID) {
        const popupFormButton = this.engine.variationPopup.querySelector('.variations_button button.button')
        const cartBtns = document.querySelectorAll('.vwwvpl-cart[data-product_id="'+productID+'"]')
        const postData = {
            nonce: this.engine.vars.ajax_nonce,
            product_id: variationID
        }
        const track = this.tracks.find( t => t.product_id == productID )
        for( const cartBtn of cartBtns ) {
            cartBtn.classList.add('vwwvpl-spin')
        }

        popupFormButton.disabled = true

        this.engine.ajaxCall( 'add_to_cart', postData )
		.then( result => {
			if ( result.data.fragments ) {
                track && (track.in_cart = 1)
                for( const cartBtn of cartBtns ) {
                    cartBtn.title = this.engine.__( 'Already in cart: go to cart', 'vwwaveplayer' )
                    cartBtn.classList.remove('vwwvpl-spin','vwwvpl-add_to_cart')
                    cartBtn.classList.add('vwwvpl-in_cart')
                    cartBtn.dataset.event = 'goToCart'
                    cartBtn.dataset.callback = 'goToCart'
                }
                for ( const key in result.data.fragments ) {
                    let fragment = document.querySelector(key)
                    if ( fragment )
                        fragment.outerHTML = result.data.fragments[key]
                }
                jQuery( document.body ).trigger( 'wc_fragment_refresh' );
                jQuery( document.body ).trigger( 'added_to_cart', [ result.data.fragments, result.data.cart_hash ] );
                this.engine.vars.ajax_nonce = result.data.ajax_nonce
            } else {
                for( const cartBtn of cartBtns ) {
                    cartBtn.classList.remove('vwwvpl-spin')
                }
                this.log( 'addVariationToCart', result )
            }
            popupFormButton.disabled = false
            document.body.classList.remove('vwwvpl-variation-popup')
		})
    }

    goToCart() {
        window.location = this.getData('cartURL')
    }

    updateDownloads(node, event) {
        const nodes = document.querySelectorAll('.vwwvpl-downloads[data-id="'+node.dataset.id+'"]')
        for( const n of nodes ) {
            n.classList.add('vwwvpl-spin')
        }
		const a = node.querySelector('a.vwwvpl-link'),
			  href = a.href,
			  track = this.engine.findTrack( node.dataset.id ),
			  file = track ? `${track.artist} - ${track.title}.${track.fileformat}` : href
		fetch( href )
			.then(response => response.blob())
			.then(blob => URL.createObjectURL(blob))
			.then(url => {
				const a = document.createElement('a')
				a.href = url
				a.download = file
				a.click()
			});

        const postData = {
            nonce: this.engine.vars.ajax_nonce,
            id: node.dataset.id
        }
        this.engine.ajaxCall( 'update_downloads', postData )
		.then( result => {
            if ( result?.success ) {
                this.setTrackData( 'stats', result.data.stats, node.dataset.index )
                node.querySelector('.vwwvpl-value') && ( node.querySelector('.vwwvpl-value').textContent = this.engine.shortenNumber( result.data.stats.downloads ) )
                for( const n of nodes ) {
                    const valueSpan = n.querySelector('.vwwvpl-value')
                    if ( valueSpan )
                        valueSpan.textContent = this.engine.shortenNumber( this.getTrackData( 'stats', node.dataset.index ).downloads )
                }
            } else {
				this.log( result?.data?.message )
			}
			for( const n of nodes ) {
				n.classList.remove('vwwvpl-spin')
			}
		})
    }

    socialShare(el, social) {
        var sharer,
            url = encodeURIComponent(el.dataset.url),
            title = encodeURIComponent(el.dataset.title),
            site = encodeURIComponent(this.getData('site'))

        switch(social){
            case 'fb':
                sharer = 'https://www.facebook.com/sharer/sharer.php?display=popup&u=' + url
                break
            case 'tw':
                sharer = 'https://twitter.com/intent/tweet?url=' + url
                break
            case 'ln':
                sharer = 'https://www.linkedin.com/shareArticle?mini=true&url=' + url + '&title=' + title + '&source=' + site
                break
        }
        window.open( sharer, '' )
    }

    getChildren( selectors ) {
        const children = this.node.querySelectorAll( selectors )

        return children.length > 0 ? children : []
    }

    getChild( selectors, index ) {
        const children = this.getChildren( selectors )

        return children[index]
    }

    getFirst( selector ) {
        return this.node.querySelector( selector )
    }

    getCurrentTrackIndex() {
        return this.currentTrack
    }

    getCurrentTrack() {
        if ( ! this.tracks )
            return false

        return this.tracks[this.currentTrack]
    }

    getTrack( index ) {
        if ( index == undefined )
            index = this.currentTrack
        if ( this.tracks?.[index] ) {
            return this.tracks[index]
        }

		return false
    }

    setTrack( track, index ) {
        if ( index == undefined ) index = this.currentTrack
        if ( this.tracks )
            this.tracks[index] = track
    }

    removeTrack( index ) {
        if ( index === undefined ) index = this.currentTrack
        this.tracks.splice(index,1)
        const playlistRow = this.getChild('.vwwvpl-playlist-wrapper>ul>li', index)
        playlistRow?.remove()
    }

    getTrackData( key, index ) {
        if ( index == undefined ) index = this.currentTrack

        if ( key === 'peaks' ) {
            const peaks = this.tracks[index]?.[key];

            if ( typeof peaks === 'string' ) {
                return peaks.split( '' ).map( c => ( c.charCodeAt() - 48 ) / 100 )
            }

            if ( Array.isArray( peaks ) ) {
				return peaks;
			}

            return null
        }

        return this?.tracks?.[index]?.[key]
    }

    setTrackData( key, value, index ) {
        if ( index == undefined ) index = this.currentTrack
        if ( this.tracks?.[index] ) {
            this.tracks[index][key] = value
        }
    }

    getTrackCount() {
        if ( Array.isArray( this.tracks ) ) {
            return this.tracks.length
        }
    }

    addClassTo( selectors, ...classes ) {
        let elements = this.getChildren( selectors )
        for ( let e of elements ) {
            for ( let c of classes ) {
                e.classList.add(c)
            }
        }
    }

    removeClassFrom( selectors, ...classes ) {
        let elements = this.getChildren( selectors )
        for ( let e of elements ) {
            for ( let c of classes ) {
                e.classList.remove(c)
            }
        }
    }

    addEventListener( type, fn ) {
        this.node.addEventListener( type, fn )
    }

    addEventListenerTo( selectors, type, fn ) {
        for ( let e of this.getChildren( selectors ) ) {
            e.addEventListener( type, fn )
        }
    }

    trigger( type, data ) {
		data = data || { track: this.getTrack(), time: this.getCurrentTime() }
        let e = new CustomEvent( type, {detail: data, bubbles: true } )
        this.node.dispatchEvent( e )

		const types = [ 'play', 'pause' ],
			  durationTypes = [ 'jump', 'skip', 'ended' ]

		if ( types.includes(type) )
			this.engine.gtmPushTimeData( type )

		if ( durationTypes.includes(type) )
			this.engine.gtmPushSegmentData( type )
    }

    initEvents() {

        var _this = this

        this.addEventListenerTo( '.vwwvpl-playing-info', 'mouseenter', event => {
            // if ( _this.status != WVPL_STATUS_PLAY ) return false
            // var el = _this.getFirst('.vwwvpl-infoblock'),
            //     scrollable = el.scrollWidth >= _this.getFirst('.vwwvpl-infoBar').offsetWidth
            // if (scrollable && !_this.scrolling) {
            //     _this.scrolling = true
            //     var elClone = el.cloneNode(true)
            //     elClone.style.marginLeft = '1em'
            //     this.appendChild(elClone)
            //     var dV = elClone.offsetWidth,
            //         dT = 50 * dV
            //     // el.animate({left: -dV}, dT, 'linear', function() {
            //     //         $(this).css({left: 0})
            //     //         elClone.remove()
            //     //         _this.trigger('titleScrollEnd', {track: _this.getTrack() })
            //     //         _this.scrolling = false
            //     // })
            //     _this.trigger('titleScrollStart', [ _this.getTrack() ] )
            //     // elClone.animate({left: -dV}, dT, 'linear')
            // }
        })

        this.addEventListener( 'ended', event => {
            this.skip()
        })

        this.addEventListener( 'peaksloaded', event => {

            const peaks = event.detail.peaks.join(',').replace(/0\./gi,'.')

			this.updateOverlay( 0, 'savingPeaks' )

            const postData = {
                nonce: _this.engine.vars.ajax_nonce,
                peaks: peaks,
				temp_file: _this.getTrackData( 'temp_file' ),
                id: _this.getTrackData( 'id' ),
                type: _this.getTrackData( 'type' ) || '',
            }
            _this.engine.ajaxCall( 'write_peaks', postData )
			.then( result => {
				_this.analyzed()
                if ( result?.success ) {
                    _this.preloadTrack(_this.clicked)
                    if ( _this.getTrackData( 'temp_file' ) ) {
                        result?.data?.id && _this.setTrackData( 'id', result.data.id )
                        _this.setTrackData( 'temp_file', null )
                    }
                } else {
					this.log( result?.data?.message )
				}
			})
        })

        this.addEventListenerTo( 'canvas', 'mouseout', event => {
            if ( _this.status !== WVPL_STATUS_PLAY )
                return
            _this.mousePosition = -1
        })

        this.addEventListenerTo( 'canvas', 'mousemove', event => {
            if ( _this.status !== WVPL_STATUS_PLAY )
                return

            _this.mousePosition = window.devicePixelRatio * event.offsetX
        })

        this.addEventListenerTo( '.vwwvpl-volume', 'mousedown', event => {
            event.preventDefault()
            _this.startOffset = event.clientX
            _this.node.querySelector('.vwwvpl-volume-overlay').innerHTML = (Math.round(_this.engine.getVolume() * 100))

            // The overlay displaying the level appears after the user holds the mouse for more than 150ms
            let volumeBtn = event.target
            _this.timerVolumeOverlay = setTimeout(function() {
                _this.volumeDragging = true
                // Disables the default behavior of the click and drag gesture
                _this.addClassTo('.vwwvpl-volume-overlay', 'dragging' )
                _this.addClassTo('.vwwvpl-controls', 'vwwvpl-inactive' )

                _this.mouseMoveListener = function(e) {
                    e.preventDefault()
                    volumeBtn.classList.add( 'dragging' )
                    var newVol = Math.round( 100 * ( _this.engine.getVolume() + ( e.clientX - _this.startOffset ) / ( _this.getFirst('.vwwvpl-interface').offsetWidth * window.devicePixelRatio / 2 ) ) ) / 100
                    if ( newVol >= 0 && newVol <= 1 ) {
                        _this.engine.setVolume( newVol )
                        _this.getFirst( '.vwwvpl-volume-overlay' ).innerHTML = Math.round(newVol*100)
                        volumeBtn.classList.toggle( 'vwwvpl-volume_off', newVol == 0 )
                    }
                }

                _this.mouseUpListener = function(e) {
                    event.preventDefault()
                    document.removeEventListener('mousemove', _this.mouseMoveListener)
                    document.removeEventListener('mouseup', _this.mouseUpListener)
                    _this.node.querySelector('.dragging').classList.remove('dragging')
                    _this.node.querySelector('.vwwvpl-controls').classList.remove('vwwvpl-inactive')
                    _this.volumeDragging = false
                }

                document.addEventListener( 'mousemove', _this.mouseMoveListener )
                document.addEventListener( 'mouseup', _this.mouseUpListener )
            }, 150)
        })

        this.addEventListenerTo( '.vwwvpl-volume', 'mouseup', event => {
            clearTimeout(_this.timerVolumeOverlay)
            if ( !_this.volumeDragging ) {
                this.engine.toggleMute()
                event.currentTarget.classList.toggle('vwwvpl-volume_off', this.engine.isMuted())
            }
        })

    }

    log( ...args ) {
		if ( this.engine.isDebugMode() ) {
        	console.debug( ...args )
        }
    }
}

document.addEventListener('readystatechange', function(event){
	const readyState = window.vwwvplVars?.is_gutenberg ? 'interactive' : 'complete'
	// const readyState = 'interactive'
    if ( document.readyState !== readyState )
        return false;

    const $ = jQuery

    let win = window
    while( !win.wp ) {
        win = win.parent
    }
    if ( win.vwwvplVars === undefined ) {
        return false
    }

    setTimeout( () => new WVPLEngine(win), 0 )

    $.fn.vwwaveplayer = function(command, ...args) {
        return this.each(function(i,e) {
            command = command || 'init'
            var element = $(e),
                instance = null,
                id = element.attr('data-instance_id')

            if ( instance = VwWavePlayer.getInstanceById( id ) ) {
                if ( 'object' !== typeof(args) ) args = [args]
                instance[command].apply(instance, args)
                return
            }
        })
    }
})

document.addEventListener( 'vwwaveplayer.engine.starting', (event) => {
    window.VwWavePlayer = event.detail.engine
    const $ = jQuery

    const e = new CustomEvent( 'vwwaveplayer.engine.ready', { detail: { engine: event.detail.engine } } )
    document.dispatchEvent( e )

    document.addEventListener( 'click', event => {

		if ( ! document.querySelector( '.vwwaveplayer' ) ) {
			return false
		}

        VwWavePlayer.resume()
        let target = event.target

        const productVariation = event.target.closest('li.vwwvpl-product-variation')
        if ( productVariation ) {
            const instanceID = productVariation.closest('#vwwvpl-variation-popup').dataset.instance
            const thisInstance = VwWavePlayer.getInstanceById( instanceID )
            thisInstance.addVariationToCart( productVariation.dataset.variation, productVariation.dataset.product )
            return
        }

        const player = target.closest('.vwwaveplayer') || VwWavePlayer.node
        if ( ! player ) {
            return
        }


        const _this = VwWavePlayer.getInstanceById( player.dataset.instance_id )

		if ( target.matches('.vwwvpl-share-popup li') ) {
            const shareTarget = target.closest('.vwwvpl-share'),
                  triggeredEvent = 'share',
                  social = target.dataset.social
            _this.trigger( triggeredEvent )
            _this['socialShare'].apply( _this, [ shareTarget, social ] )
        }

        if ( target.matches('.vwwvpl-button') ) {
            // handle the click on the download button
            if ( ! target.matches('.vwwvpl-downloads') && target.querySelector('a.vwwvpl-link')  ) {
				target.click()
			}

            // handle the click on the product button
            if ( target.matches('.vwwvpl-product') ) {
                const link = target.querySelector('a.vwwvpl-link')
                link?.click()
				return
            }    

            const triggeredEvent = target.dataset.event
            if ( triggeredEvent ) {
                _this.trigger( triggeredEvent )
            }

            const callback = target.dataset.callback
            if ( ! callback ) {
                return
            }

            _this[callback].apply( _this, [ target ] )
            return
        }

        if ( target.matches('.vwwvpl-link') && target.attributes.download ) {
            return
        }

        if ( target.matches('.vwwvpl-info') ) {
            event.preventDefault()
            _this.toggleInfoState()
            return
        }

        if ( target.matches('.vwwvpl-play') ) {
            event.preventDefault()
            _this.toggle()
            return
        }

        if ( target.matches('.vwwvpl-prev:not(.vwwvpl-disabled), .vwwvpl-next:not(.vwwvpl-disabled)') ) {
			event.preventDefault()
            const forward = target.classList.contains('vwwvpl-next')
            _this.skip( forward )
            return
        }

        if ( target.matches('canvas') ) {
            event.preventDefault()
            if ( _this.status == WVPL_STATUS_PLAY) {
                _this.updateRuntime()
				_this.trigger( 'jump' )
                VwWavePlayer.setCurrentTime( VwWavePlayer.getDuration() * event.offsetX / target.offsetWidth )
            } else {
                _this.play()
            }
            return
        }

        if ( target.matches('.vwwvpl-playlist li') || target.matches('.vwwvpl-playlist li>*:not(.vwwvpl-icon)') ) {
            if ( target.tagName !== 'LI' )
                target = target.closest('li')
            event.preventDefault()

            let i = 0
            let node = target
            for (i=0; (node=node.previousSibling); i++) {

            }
            _this.skipTo(i)
			return
        }

        if ( target.matches('button.vwwvpl-sticky-player-toggle') ) {
            VwWavePlayer.toggleStickyPlayer()
            return
        }

        if ( target.matches('#vwwvpl-sticky-player canvas') ) {
            event.preventDefault()

            _this.maybeSwitch()
			.then( () => {
				_this.play()
			})
			.catch( () => {
				if ( _this.status == WVPL_STATUS_PLAY) {
	                const canvas = event.currentTarget
	                _this.updateRuntime()
	                VwWavePlayer.setCurrentTime( VwWavePlayer.getDuration() * event.offsetX / canvas.offsetWidth )
	            } else {
	                _this.play()
	            }
			})
            return
        }

        if ( target.matches( '#vwwvpl-sticky-player .vwwvpl-play' ) ) {
            _this.toggle()
            return
        }

        if ( target.matches( '.remove_from_cart_button' ) ) {
            const productID = target.dataset.product_id

            const cartBtns = document.querySelectorAll('.vwwvpl-cart[data-product_id="'+productID+'"]')
            for( const cartBtn of cartBtns ) {
                cartBtn.classList.add('vwwvpl-spin')
            }
            return
        }

        if ( target.matches( '#vwwvpl-variation-popup .woocommerce-variation-add-to-cart button' ) ) {
            event.preventDefault();
            const addToCart = target.closest('.woocommerce-variation-add-to-cart'),
                  productId = addToCart.querySelector('input[name="product_id"]').value,
                  variationId = addToCart.querySelector('input.variation_id').value
            if ( variationId > 0 ) {
                _this.addVariationToCart( variationId, productId )
            }
            return
        }

		if ( target.matches( '#vwwvpl-variation-popup' ) ) {
            document.body.classList.remove('vwwvpl-variation-popup')
            return
        }
	})

	document.addEventListener( 'click', event => {
		const target = event.target

		if ( target.matches( '[data-marker]' ) ) {
			event.preventDefault()
			const time = VwWavePlayer.timeToSeconds( event.target.dataset.marker )
			if ( time ) {
				VwWavePlayer.play( time )
			}
			return
        }
    })

    window.addEventListener('resize', (event) => {
        if (window.frameElement)
            return

        setTimeout(function() {
            VwWavePlayer.redrawAllInstances()
        }, 50)
    })

    document.addEventListener('visibilitychange', (event) => {
        if (document.visibilityState === "hidden") {
            let instance = VwWavePlayer.getCurrentInstance()
            if ( instance ) {
                instance.updateStatistics()
            }
        }
    })

    let spVolumeDragging = false
    document.addEventListener( 'mousedown', (event) => {
        if ( event.target.matches('.vwwvpl-volume-slider .touchable') ) {
            spVolumeDragging = true
            VwWavePlayer.setVolume( event.offsetX / event.target.offsetWidth )
        }
    })

    document.addEventListener( 'mousemove', (event) => {
        if ( event.target.matches('.vwwvpl-volume-slider .touchable') ) {
            if ( spVolumeDragging && event.target.className === 'touchable' ) {
                  VwWavePlayer.setVolume(event.offsetX / event.target.offsetWidth)
            }
        }
    })

    document.addEventListener( 'mouseup', (event) => {
        spVolumeDragging = false
    })

	let lastTime = ''
	document.addEventListener( 'timeupdate', (event) => {
		if ( event.target.matches('.vwwaveplayer') ) {
			const markers = document.querySelectorAll( '[data-marker]' ),
			 	  time = VwWavePlayer.secondsToTime( event.detail.time )
			if ( markers.length && time !== lastTime ) {
				let marker = markers[0]
				for( let i = 1; i < markers.length; i++ ) {
					if ( VwWavePlayer.timeToSeconds( markers[i].dataset.marker ) > VwWavePlayer.timeToSeconds( time ) ) {
						break
					}
					marker = markers[i]
				}
				for ( let m of markers ) {
					m.classList.remove('current-time-marker')
				}
				marker.classList.add('current-time-marker')
				if ( VwWavePlayer.getOption( 'scroll_to_marker' ) ) {
					const behavior = marker.dataset.behavior ? marker.dataset.behavior : 'smooth',
						  block = marker.dataset.block ? marker.dataset.block : 'center'
					marker.scrollIntoView({
						behavior,
						block
					})
				}
				lastTime = time
			}
		}
	})

    $(document.body).on( 'added_to_cart', (event, fragments, cartHash, $button) => {
        if (!$button) return
        const productId = $button.data('product_id')

        VwWavePlayer.updateTrackCartStatus( productId, 'add' )

        $(`.vwwvpl-cart[data-product_id=${productId}]`)
            .attr('title', VwWavePlayer.__( 'Already in cart: go to cart', 'vwwaveplayer' ) )
            .attr('data-event', 'goToCart')
            .attr('data-callback', 'goToCart')
            .addClass('vwwvpl-in_cart')
            .removeClass('vwwvpl-add_to_cart')
            .removeClass('vwwvpl-spin')
    } )

    $(document.body).on( 'removed_from_cart', (event, fragments, cartHash, $button) => {
        if (!$button) return
        const productId = $button.data('product_id')

        VwWavePlayer.updateTrackCartStatus( productId, 'remove' )

        $(`.vwwvpl-cart[data-product_id=${productId}]`)
            .attr('title', VwWavePlayer.__( 'Add to cart', 'vwwaveplayer' ) )
            .attr('data-event', 'addToCart')
            .attr('data-callback', 'addToCart')
            .addClass('vwwvpl-add_to_cart')
            .removeClass('vwwvpl-in_cart')
            .removeClass('vwwvpl-spin')
    } )

})
