<?php
/**
 * AJAX class
 *
 * @package VwWavePlayer/Renderer
 */

namespace PerfectPeach\VwWavePlayer;

use \WP_Query as WP_Query;
use \WP_User_Query as WP_User_Query;

defined( 'ABSPATH' ) || exit;

/**
 * AJAX class
 *
 * This class contains all the functions dealing with the AJAX calls
 *
 * @since 3.0.0
 * @package VwWavePlayer/AJAX
 */
class AJAX {

	/**
	 * Store the external posters.
	 *
	 * @var array
	 */
	private static $external_data = array();

	/**
	 * Initiate the class
	 *
	 * @since 3.0.0
	 */
	public static function load() {
		add_action( 'plugins_loaded', array( __CLASS__, 'define_ajax' ), 0 );
		add_action( 'template_redirect', array( __CLASS__, 'do_wvpl_ajax' ), 0 );
		self::register_ajax_actions();
	}

	/**
	 * Define the AJAX environment variables
	 *
	 * @since 3.0.0
	 */
	public static function define_ajax() {
		// phpcs:disable
		if ( ! empty( $_GET['vwwvpl-ajax'] ) ) {
			if ( ! defined( 'DOING_AJAX' ) ) {
				define( 'DOING_AJAX', true );
			}

			if ( ! defined( 'WVPL_DOING_AJAX' ) ) {
				define( 'WVPL_DOING_AJAX', true );
			}

			if ( ! WP_DEBUG || ( WP_DEBUG && ! WP_DEBUG_DISPLAY ) ) {
				define( 'WP_DEBUG_DISPLAY', true );
			}

			$GLOBALS['wpdb']->hide_errors();
		}
		// phpcs:enable
	}

	/**
	 * Register all the AJAX actions and their callback functions
	 *
	 * @since 3.0.0
	 */
	private static function register_ajax_actions() {
		$ajax_callback_functions = array(
			'load_playlist',
			'delete_peaks',
			'read_peaks',
			'create_local_copy',
			'write_peaks',
			'clear_cache',
			'update_statistics',
			'update_likes',
			'update_downloads',
			'get_audio_attachments',
			'music_inputs',
			'get_soundcloud_track_stream',
			'refresh_interface',
			'add_to_cart',
			'parse_shortcode',
			'parse_single_shortcode',
			'save_palette',
			'dismiss_registration_notice',
		);

		if ( defined( 'WC_VERSION' ) ) {
			$ajax_callback_functions[] = 'create_product';
		}

		foreach ( $ajax_callback_functions as $function ) {
			add_action( "vwwaveplayer_ajax_$function", array( __CLASS__, $function ) );
		}
	}

	/**
	 * Set the headers for AJAX requests
	 *
	 * @since 3.0.0
	 */
	private static function wvpl_ajax_headers() {
		if ( ! headers_sent() ) {
			send_origin_headers();
			send_nosniff_header();
			if ( defined( 'WC_VERSION' ) ) {
				wc_nocache_headers();
			}
			header( 'Content-Type: text/html; charset=' . get_option( 'blog_charset' ) );
			header( 'X-Robots-Tag: noindex' );
			status_header( 200 );
		} elseif ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			headers_sent( $file, $line );
		}
	}

	/**
	 * Run the action requested via AJAX
	 *
	 * @since 3.0.0
	 */
	public static function do_wvpl_ajax() {
		global $wp_query;

		if ( ! empty( $_GET['vwwvpl-ajax'] ) ) { //phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$wp_query->set( 'vwwvpl-ajax', sanitize_text_field( wp_unslash( $_GET['vwwvpl-ajax'] ) ) ); //phpcs:ignore WordPress.Security.NonceVerification.Recommended
		}
		$action = $wp_query->get( 'vwwvpl-ajax' );
		if ( $action ) {
			self::wvpl_ajax_headers();
			$action = sanitize_text_field( $action );
			do_action( 'vwwaveplayer_ajax_' . $action );
		}
	}

	/**
	 * Add an external poster to the external_posters array
	 *
	 * @since 3.0.10
	 * @param string $url  The hash of the external URL.
	 * @param array  $data The additional data for the external URL.
	 */
	public static function add_external_data( $url, $data ) {
		$id                         = md5( $url );
		self::$external_data[ $id ] = $data;
	}

	/**
	 * Create an array of track metadata from a list of attachment IDs
	 *
	 * @since  3.0.0
	 * @param  string $ids     a comma-separated list of attachment IDs.
	 * @param  int    $post_id the post containing the playlist.
	 * @return array
	 */
	public static function create_playlist( $ids, $post_id ) {
		$current_user = wp_get_current_user();
		$user_id      = $current_user->ID;

		$ids_array = array_map( 'trim', explode( ',', $ids ) );

		$tracks_array = array();
		$i            = 0;
		foreach ( $ids_array as $track_id ) {
			$track = self::get_track_data( $track_id, $post_id, $user_id );
			if ( $track ) {
				$track['index'] = $i;
				$tracks_array[] = $track;
				$i++;
			}
		}

		/**
		 * Fires before returning the tracks playlist to the instance
		 *
		 * @since  2.3.3
		 * @param  array  $tracks  An array containing all the tracks in the playlist.
		 * @param  string $post_id The ID of the post/page containing the player instance.
		 * @return array           The array of tracks included in the playlist.
		 */
		return apply_filters( 'vwwaveplayer_tracks_playlist', $tracks_array, $post_id );
	}

	/**
	 * Retrieve the information of a track
	 *
	 * @since  3.0.0
	 * @param  int $track_id The ID of the audio attachment.
	 * @param  int $post_id  The ID of the post containing the player.
	 * @param  int $user_id  The ID of the user currently logged in.
	 * @return array         An array representing the data of the track.
	 */
	public static function get_track_data( $track_id, $post_id, $user_id ) {
		global $wp_filesystem;

		$track = wp_get_attachment_metadata( $track_id );

		if ( ! $track ) {
			return false;
		}

		$options   = vwwaveplayer()->get_options();
		$post_meta = get_post_meta( $track_id );

		$vwwaveplayer_custom_fields = array_map(
			function( $k ) {
				return strpos( $k, 'vwwaveplayer_' ) === 0;
			},
			array_keys( $post_meta )
		);

		$array_keys = array_map(
			function( $k ) {
				return preg_replace( '/^vwwaveplayer_/', '', $k );
			},
			array_keys( $post_meta )
		);
		$track_meta = array_combine(
			$array_keys,
			array_map(
				function( $item ) {
					return maybe_unserialize( current( $item ) );
				},
				$post_meta
			)
		);

		/**
		 * Filters the array of keys being excluded from the attachment metadata.
		 *
		 * @since 3.0.2
		 *
		 * @param string  $excluded_keys  The array of meta_keys that are going to excluded
		 *                                from the track metadata
		 * @param string  $track_id       The ID of the audio attachment
		 * @param string  $post_id        The ID of the post containing the player
		 */
		$skip_meta_keys = apply_filters(
			'vwwaveplayer_exclude_track_meta',
			array( 'wvpl_stats', 'wvpl_likes', 'wvpl_downloads', 'wvpl_play_count', 'wvpl_runtime', 'wvpl_likes_start', '_wp_attached_file', '_wp_attachment_metadata', '_edit_last', '_edit_lock', '_wp_old_slug', '_thumbnail_id' ),
			$track_id,
			$post_id
		);

		$included_meta_keys = get_transient( 'vwwaveplayer_internal_track_properties' ) ?: $vwwaveplayer_custom_fields;
		$included_meta_keys = array_merge(
			$included_meta_keys,
			array_keys( get_post_meta( $track_id, '_wp_attachment_metadata', true ) ?: array() )
		);

		$track_meta   = array_intersect_key( $track_meta, array_fill_keys( $included_meta_keys, '' ) );
		$track_meta   = array_diff_key( $track_meta, array_fill_keys( $skip_meta_keys, '' ) );
		$track        = array_merge( $track, $track_meta );
		$stats        = self::get_track_stats( $track_id );
		$liked        = false;
		$liked_tracks = array();
		$liked_tracks = get_user_meta( $user_id, 'wvpl_likes' );

		if ( $liked_tracks ) {
			$liked = in_array( $track_id, $liked_tracks, true );
		}

		$att = get_post( $track_id );
		if ( $att->post_title ) {
			$track['title'] = $att->post_title;
		}
		if ( $att->post_content ) {
			$track['description'] = $att->post_content;
		}
		if ( $att->post_excerpt ) {
			$track['caption'] = $att->post_excerpt;
		}
		$track['post_url'] = get_permalink( $track_id );

		$track['id']   = (int) $track_id;
		$track['file'] = wp_get_attachment_url( $track_id );

		$default_poster_size = isset( $options['default_thumbnail_size'] ) && $options['default_thumbnail_size'] ? $options['default_thumbnail_size'] : 'thumbnail';
		/**
		 * Filters the default size of the track featured image to be used for the poster image.
		 *
		 * @since 3.0.2
		 *
		 * @param string  $size         The track ID (the ID of the attachment post)
		 *                              It can be a valid size name registered with WordPress
		 *                              or an array of widht and height values, such as `array( 128, 128 )`
		 * @param string  $track_id     The ID of the audio attachment
		 */
		$poster_size = apply_filters( 'vwwaveplayer_thumbnail_size', $default_poster_size, $track_id );

		$post_featured_image_id = get_post_thumbnail_id( $track_id );
		if ( ! $post_featured_image_id && $post_id ) {
			$post_featured_image_id = get_post_thumbnail_id( $post_id );
		}
		if ( $post_featured_image_id ) {
			$poster_src                = current( wp_get_attachment_image_src( $post_featured_image_id, $poster_size ) );
			$track['poster']           = $poster_src ? $poster_src : '';
			$thumbnail_src             = current( wp_get_attachment_image_src( $post_featured_image_id, 'vwwaveplayer-playlist-thumb' ) );
			$track['poster_thumbnail'] = $thumbnail_src ? $thumbnail_src : '';
			$srcset                    = wp_get_attachment_image_srcset( $post_featured_image_id, array( 48, 48 ) );
			$track['poster_srcset']    = $srcset ? $srcset : '';
		} else {
			$track['poster']           = $options['default_thumbnail'];
			$track['poster_thumbnail'] = $options['default_thumbnail'];
			$track['poster_srcset']    = '';
		}
		$track['type'] = 'internal';
		if ( file_exists( VWWAVEPLAYER_PEAK_FOLDER . "$track_id.peaks" ) ) {
			$track['peak_file'] = VWWAVEPLAYER_PEAK_PATH . "$track_id.peaks";
			$peak_data          = $wp_filesystem->get_contents( VWWAVEPLAYER_PEAK_FOLDER . "$track_id.peaks" );
			if ( $peak_data ) {
				$track['peaks'] = $peak_data;
			}
		}

		$track['genres'] = get_the_term_list( $track_id, 'music_genre' );
		$taxonomies      = get_object_taxonomies( 'attachment:audio', 'objects' );
		foreach ( $taxonomies as $tax_name => $tax ) {
			$track['taxonomies'][ $tax_name ] = get_the_term_list( $track_id, $tax_name );
		}

		$track['stats'] = $stats;
		$track['liked'] = $liked;

		/**
		 * Fires before a track is added to the playlist.
		 *
		 * @since 2.3.0
		 *
		 * @param array   $track       An array containing all the track information, including its metadata
		 * @param string  $track_id    The track ID (the ID of the attachment post)
		 * @param string  $post_id     The ID of the post/page containing the player instance
		 */
		$track = apply_filters( 'vwwaveplayer_add_track_info', $track, $track_id, $post_id );

		if ( empty( get_transient( 'vwwaveplayer_internal_track_properties' ) ) ) {
			$track_properties = apply_filters( 'vwwaveplayer_internal_track_properties', array_keys( $track ) );

			set_transient( 'vwwaveplayer_internal_track_properties', $track_properties );
		}

		return $track;
	}

	/**
	 * Return the runtime expressed in seconds formatted as h:mm:ss
	 *
	 * @since  3.0.0
	 * @param  int $seconds The runtime in seconds.
	 * @return string       The formatted runtime.
	 */
	private static function runtime_formatted( $seconds ) {
		if ( ! $seconds ) {
			$seconds = 0;
		}
		$seconds = intval( $seconds );
		$s       = $seconds % 60;
		$m       = floor( $seconds / 60 ) % 60;
		$h       = floor( $seconds / 3600 );
		$info    = $h > 0 ? sprintf( '%d:%02d:%02d', $h, $m, $s ) : sprintf( '%d:%02d', $m, $s );
		return $info;
	}

	/**
	 * Retrieve the statistics of a track
	 *
	 * @since  3.0.0
	 * @param  int $track_id The ID of the audio attachment.
	 * @return array         An array of the track statistics.
	 */
	public static function get_track_stats( $track_id ) {
		$keys  = array( 'play_count', 'runtime', 'downloads' );
		$stats = array();
		foreach ( $keys as $key ) {
			$value         = get_post_meta( $track_id, "wvpl_$key", true );
			$stats[ $key ] = intval( $value ) ?: 0;
		}
		$stats['likes'] = self::get_track_likes( $track_id );

		/**
		 * Filters the stats of a track.
		 *
		 * @since 3.0.0
		 *
		 * @param array   $stats       An array of integers defined as array( 'play_count', 'runtime', 'downloads', 'likes' )
		 * @param string  $track_id    The ID of the audio attachment
		 */
		return apply_filters( 'vwwaveplayer_track_stats', $stats, $track_id );
	}

	/**
	 * Retrieve the track likes
	 *
	 * @since  3.0.0
	 * @param  int $track_id The ID of the audio attachment.
	 * @return array         The number of likes.
	 */
	private static function get_track_likes( $track_id ) {
		$likes_start = (int) get_post_meta( $track_id, 'wvpl_likes_start', true );

		$args       = array(
			'meta_key'     => 'wvpl_likes', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			'meta_value'   => $track_id, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
			'meta_compare' => '=',
		);
		$user_query = new WP_User_Query( $args );
		$user_likes = $user_query->get_total();
		return $user_likes + $likes_start;
	}

	/**
	 * Store the track stats to the database
	 *
	 * @since  3.0.0
	 * @param  int   $track_id The ID of the audio attachment.
	 * @param  array $stats    The data to be stored.
	 */
	private static function update_track_stats( $track_id, $stats ) {
		$keys = array( 'play_count', 'runtime', 'downloads' );
		foreach ( $keys as $key ) {
			update_post_meta( $track_id, "wvpl_$key", $stats[ $key ] );
		}
	}

	/**
	 * Converts the old statistics from version 2
	 *
	 * @since  3.0.0
	 */
	public static function convert_old_stats() {
		$args   = array(
			'posts_per_page' => -1,
			'post_type'      => 'attachment',
			'post_mime_type' => 'audio',
			'post_status'    => 'any',
		);
		$tracks = new WP_Query( $args );
		if ( $tracks->have_posts() ) {
			foreach ( $tracks->posts as $track ) {
				$stats = get_post_meta( $track->ID, 'wvpl_stats', true );
				if ( $stats ) {
					$stats = json_decode( wp_json_encode( unserialize( str_replace( 'O:9:"WVPLStats"', 'O:20:"VwWavePlayer\WVPLStats"', serialize( $stats ) ) ) ), true ); //phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.serialize_serialize, WordPress.PHP.DiscouragedPHPFunctions.serialize_unserialize
					self::update_track_stats( $track->ID, $stats );
					if ( is_array( $stats['likes'] ) ) {
						$likes_start = 0;
						foreach ( $stats['likes'] as $user_id ) {
							if ( get_userdata( $user_id ) ) {
								update_user_meta( $user_id, 'wvpl_likes', $track->ID, $track->ID );
							} else {
								$likes_start++;
							}
						}
						update_post_meta( $track->ID, 'wvpl_likes_start', $likes_start );
					}
					// phpcs:ignore Squiz.PHP.CommentedOutCode.Found
					// delete_post_meta( $track_id, 'wvpl_stats' ); //phpcs:ignore Squiz.PHP.CommentedOutCode.Found.
				}
			}
			wp_reset_postdata();
		}
	}

	/**
	 * Delete peak files
	 *
	 * @since 3.0.0
	 */
	public static function delete_peaks() {

		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'vwwaveplayer-admin-tools' ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
			wp_send_json_error( array( 'message' => esc_html__( 'The request is not valid', 'vwwaveplayer' ) ) );
		}

		global $wp_filesystem;

		$mode  = isset( $_POST['mode'] ) ? $_POST['mode'] : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
		$num   = 0;
		$files = $wp_filesystem->dirlist( VWWAVEPLAYER_PEAK_FOLDER );

		if ( 'orphan' === $mode ) {
			$files = array_filter(
				$files,
				function( $f ) {
					if ( 'peaks' === pathinfo( $f['name'], PATHINFO_EXTENSION ) && is_numeric( pathinfo( $f['name'], PATHINFO_FILENAME ) ) ) {
						$id = (int) pathinfo( $f['name'], PATHINFO_FILENAME );
						return ! wp_attachment_is( 'audio', $id );
					}
					return true;
				}
			);
		} elseif ( 'all' === $mode ) {
			$external   = array_map(
				function( $f ) {
					$f['name'] = 'external/' . $f['name'];
					return $f;
				},
				$wp_filesystem->dirlist( VWWAVEPLAYER_PEAK_FOLDER . 'external' )
			);
			$soundcloud = array_map(
				function( $f ) {
					$f['name'] = 'soundcloud/' . $f['name'];
					return $f;
				},
				$wp_filesystem->dirlist( VWWAVEPLAYER_PEAK_FOLDER . 'soundcloud' )
			);
			$files      = array_merge( $files, $external, $soundcloud );
		}

		$files = array_filter(
			$files,
			function( $f ) {
				return 'f' === $f['type'];
			}
		);

		foreach ( $files as $file ) {
			if ( $wp_filesystem->delete( VWWAVEPLAYER_PEAK_FOLDER . $file['name'] ) ) {
				$num++;
			}
		}

		if ( $num > 0 ) {
			wp_send_json_success(
				array(
					// translators: %s is the number of files that were deleted.
					'message' => esc_html( sprintf( _n( '%s file was successfully deleted.', '%s files were successfully deleted.', $num, 'vwwaveplayer' ), $num ) ),
					'files'   => $files,
				)
			);
		} else {
			wp_send_json_error( array( 'message' => esc_html__( 'No files needed to be deleted.', 'vwwaveplayer' ) ) );
		}
	}


	/**
	 * Reads the peak file of an audio track
	 *
	 * @since  3.0.0
	 * @param  int $id The ID of the audio attachment.
	 * @return string  The content of the peak file or false
	 */
	private static function _read_peaks( $id ) { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
		global $wp_filesystem;

		$current_user = wp_get_current_user();

		$peak_file = trailingslashit( VWWAVEPLAYER_PEAK_FOLDER ) . $id . '.peaks';

		if ( file_exists( $peak_file ) ) {
			return $wp_filesystem->get_contents( $peak_file );
		}
		return false;
	}


	/**
	 * Sends a JSON array of the audio peaks through an AJAX call
	 *
	 * @since 3.0.0
	 */
	public static function read_peaks() {

		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'vwwaveplayer-ajax-call' ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
			wp_send_json_error( array( 'message' => esc_html__( 'The request is not valid', 'vwwaveplayer' ) ) );
		}

		$data = self::_read_peaks( $_POST['id'] ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash

		wp_send_json_success( $data );

	}


	/**
	 * Clear the cache where VwWavePlayer stores the data of the instances
	 * for a faster generation of the shortcodes and shorter server response times
	 *
	 * @since 3.0.6
	 */
	public static function _clear_cache() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
		global $wp_filesystem, $wpdb;

		if ( $wp_filesystem && method_exists( $wp_filesystem, 'delete' ) ) {
			$delete = $wp_filesystem->delete( VWWAVEPLAYER_CACHE_FOLDER, true, 'd' );

			if ( is_wp_error( $delete ) ) {
				return $delete;
			}
		}

		if ( $wp_filesystem && method_exists( $wp_filesystem, 'mkdir' ) ) {
			$mkdir = $wp_filesystem->mkdir( VWWAVEPLAYER_CACHE_FOLDER );

			if ( is_wp_error( $mkdir ) ) {
				return $mkdir;
			}
		}

		$deleted = $wpdb->query( "DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_%vwwaveplayer_%'" ); // phpcs:ignore WordPress.DB
		$wpdb->query( "DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_timeout_%vwwaveplayer_%'" ); // phpcs:ignore WordPress.DB

		return $deleted;
	}

	/**
	 * Clear the cache where VwWavePlayer stores the data of the instances
	 * for a faster generation of the shortcodes and shorter server response times
	 *
	 * @since 3.0.6
	 */
	public static function clear_cache() {
		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'vwwaveplayer-admin-tools' ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
			wp_send_json_error( array( 'message' => esc_html__( 'The request is not valid', 'vwwaveplayer' ) ) );
		}

		$is_cache_cleared = self::_clear_cache();

		if ( is_wp_error( $is_cache_cleared ) ) {
			wp_send_json_error( array( 'message' => $is_cache_cleared->get_error_message() ) );
		}

		// translators: %d is the number of transients that were deleted.
		wp_send_json_success(
			array(
				'message' => sprintf(
					esc_html__( 'The cache was cleared successfully: %d transients were deleted.', 'vwwaveplayer' ),
					$is_cache_cleared
				)
			)
		);
	}

	/**
	 * Write the peak file of an audio track only if not already present in the peak subfolder
	 * and sends a message to vwwaveplayer.js through the AJAX call
	 *
	 * @since 3.0.0
	 */
	public static function write_peaks() {
		global $wp_filesystem;

		if ( ( ! isset( $_POST['nonce'] ) && ! isset( $_POST['instance_id'] ) ) || ( ! wp_verify_nonce( $_POST['nonce'], 'vwwaveplayer-admin-tools' ) && ! wp_verify_nonce( $_POST['nonce'], 'vwwaveplayer-ajax-call' ) ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
			wp_send_json_error( array( 'message' => esc_html__( 'The request is not valid', 'vwwaveplayer' ) ) );
		}

		$url       = filter_input( INPUT_POST, 'file' ) ?? '';
		$id        = filter_input( INPUT_POST, 'id' ) ?? 0;
		$peaks     = array_map( 'floatval', explode( ',', filter_input( INPUT_POST, 'peaks' ) ?? '' ) );
		$temp_file = filter_input( INPUT_POST, 'temp_file' ) ?? '';
		$type      = filter_input( INPUT_POST, 'type' ) ?? '';
		$overwrite = filter_input( INPUT_POST, 'overwrite', FILTER_VALIDATE_BOOL ) ?? false;

		if ( 'internal' === $type ) {
			$type = '';
		}

		$peaks = implode(
			'',
			array_map(
				function( $value ) {
					return chr( round( $value * 100 ) + 48 );
				},
				$peaks
			)
		);

		$peak_file = wp_normalize_path( VWWAVEPLAYER_PEAK_FOLDER . "$type/$id.peaks" );
		$info_file = wp_normalize_path( VWWAVEPLAYER_PEAK_FOLDER . "$type/$id.info" );

		if ( 'external' === $type ) {
			$data = json_decode( $wp_filesystem->get_contents( $info_file ), true );
			$wp_filesystem->delete( $info_file );
			$data['peaks'] = $peaks;
			unset( $data['temp_file'] );
			$wp_filesystem->put_contents( $info_file, wp_json_encode( $data ) );
			if ( $url !== $temp_file ) {
				$wp_filesystem->delete( wp_normalize_path( VWWAVEPLAYER_PEAK_FOLDER . "$type/" . basename( $temp_file ) ) );
			}
		} else {
			if ( ! file_exists( $peak_file ) || $overwrite ) {
				$wp_filesystem->delete( $peak_file );
				$wp_filesystem->put_contents( $peak_file, $peaks );

				if ( ! is_numeric( $id ) && $temp_file ) {
					$abspath   = str_replace( 'wp-content', '', WP_CONTENT_DIR );
					$temp_file = str_replace( get_bloginfo( 'url' ), $abspath, $temp_file );
					$wp_filesystem->delete( $temp_file );
				}
			} else {
				$peaks = self::_read_peaks( $id );
			}
		}
		wp_send_json_success(
			array(
				'peaks' => $peaks,
				'id'    => $id,
			)
		);
	}


	/**
	 * Reads the track information stored in a local .info file
	 *
	 * @since 3.0.0
	 * @param string $url_arg A comma-separated list of URLs.
	 * @param int    $post_id The ID of the post containing the current player.
	 */
	public static function create_external_playlist( $url_arg, $post_id ) { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
		global $wp_filesystem;

		$options = vwwaveplayer()->get_options();
		$tracks  = array();
		$urls    = explode( ',', $url_arg );
		foreach ( $urls as $url ) {
			$id = vwwaveplayer()->attachment_url_to_postid( $url );
			if ( $id ) {
				$current_user = wp_get_current_user();
				$user_id      = $current_user->ID;
				$data         = self::get_track_data( $id, $post_id, $user_id );
				if ( $data ) {
					$tracks[] = $data;
				}
			} elseif ( false !== strpos( $url, 'soundcloud.com' ) && false === strpos( $url, 'feeds.soundcloud.com' ) ) {
				$type      = 'soundcloud';
				$sc_tracks = Soundcloud::get_tracks( $url );
				$sc_data   = array();
				foreach ( $sc_tracks as $sc_track ) {
					$data                     = json_decode( wp_json_encode( $sc_track ), true );
					$data['type']             = $type;
					$data['soundcloud_url']   = $data['permalink_url'];
					$data['artist']           = $data['user']['username'];
					$data['length']           = round( $data['duration'] / 1000 );
					$data['length_formatted'] = self::runtime_formatted( $data['length'] );
					$data['poster']           = $data['artwork_url'] ? str_replace( '-large', '-crop', $data['artwork_url'] ) : $data['user']['avatar_url'];
					$data['poster_thumbnail'] = $data['artwork_url'] ? $data['artwork_url'] : $data['user']['avatar_url'];
					$data['poster_srcset']    = '';
					if ( file_exists( VWWAVEPLAYER_PEAK_FOLDER . "$type/{$data['id']}.peaks" ) ) {
						$data['peak_file'] = VWWAVEPLAYER_PEAK_PATH . "$type/{$data['id']}.peaks";
					}
					$data['file'] = SoundCloud::get_track_stream( $data['id'] );
					unset( $data['user'] );
					$sc_data[] = $data;
				}
				$tracks = array_merge( $tracks, $sc_data );
			} else {
				if ( trim( $url ) ) {
					$type          = 'external';
					$id_v3         = md5( $url );
					$info_v3       = wp_normalize_path( VWWAVEPLAYER_PEAK_FOLDER . "$type/$id_v3.info" );
					$parsed_url    = wp_parse_url( $url );
					$parsed_domain = wp_parse_url( get_bloginfo( 'url' ) );

					$local_url  = isset( $parsed_url['scheme'] ) ? $parsed_url['scheme'] . '://' : '';
					$local_url .= isset( $parsed_url['host'] ) ? $parsed_url['host'] : '';
					$local_url .= isset( $parsed_url['path'] ) ? $parsed_url['path'] : '';

					$id_v2         = pathinfo( preg_replace( '/[\/\:]/', '_', $local_url ), PATHINFO_FILENAME );
					$local_file_v2 = wp_normalize_path( VWWAVEPLAYER_PEAK_FOLDER . "$id_v2." . pathinfo( $parsed_url['path'], PATHINFO_EXTENSION ) );
					$local_file_v3 = wp_normalize_path( VWWAVEPLAYER_PEAK_FOLDER . "$type/$id_v3." . pathinfo( $parsed_url['path'], PATHINFO_EXTENSION ) );

					if ( ! trim( $id_v2 ) && ! trim( $id_v3 ) ) {
						continue;
					}

					$info_v2 = wp_normalize_path( VWWAVEPLAYER_PEAK_FOLDER . "$id_v2.info" );
					$peak_v2 = wp_normalize_path( VWWAVEPLAYER_PEAK_FOLDER . "$id_v2.peaks" );

					if ( file_exists( $peak_v2 ) ) {
						$data = json_decode( $wp_filesystem->get_contents( $info_v2 ), true );
						$wp_filesystem->put_contents( $info_v3, wp_json_encode( $data ) );
						$wp_filesystem->delete( $info_v2 );
						$wp_filesystem->delete( $peak_v2 );
						$data['peak_file'] = VWWAVEPLAYER_PEAK_PATH . "$type/$id_v3.info";
					} elseif ( file_exists( $info_v3 ) ) {
						$data = json_decode( $wp_filesystem->get_contents( $info_v3 ), true );
						if ( ! isset( $data['poster'] ) ) {
							$data['poster'] = $options['default_thumbnail'];
						}
						$data['poster_thumbnail'] = $data['poster'];
						$data['poster_srcset']    = '';
						$data['peak_file']        = VWWAVEPLAYER_PEAK_PATH . "$type/$id_v3.info";
					}
					if ( isset( self::$external_data[ $id_v3 ] ) ) {
						$data['poster']           = self::$external_data[ $id_v3 ]['poster'];
						$data['poster_thumbnail'] = self::$external_data[ $id_v3 ]['poster'];
						$data['post_url']         = self::$external_data[ $id_v3 ]['link'];
					}
					$data['type'] = $type;
					$data['id']   = $id_v3;
					$data['file'] = $url;
					unset( $data['peaks'] );
					$tracks[] = apply_filters( 'vwwaveplayer_add_external_track_info', $data, $id_v3, $post_id, $url );
				}
			}
		}
		return $tracks;
	}

	/**
	 * Read the info file of a given external track
	 *
	 * @since  3.0.10
	 * @param  string $track The array .
	 * @return array         The data of the track
	 */
	public static function read_info( $track ) {
		global $wp_filesystem;

		$type    = 'external';
		$id_v3   = md5( $track['file'] );
		$info_v3 = wp_normalize_path( VWWAVEPLAYER_PEAK_FOLDER . "$type/$id_v3.info" );
		if ( file_exists( $info_v3 ) ) {
			$data = json_decode( $wp_filesystem->get_contents( $info_v3 ), true );
			if ( ! isset( $data['poster'] ) ) {
				$data['poster'] = vwwaveplayer()->get_option( 'default_thumbnail' );
			}
			$data['poster_thumbnail'] = $data['poster'];
			$data['poster_srcset']    = '';
			$data['type']             = 'external';
			$track                    = array_merge( $data, $track );
		}
		$track['id'] = $id_v3;
		unset( $track['peaks'] );
		return $track;
	}

	/**
	 * Create a local copy of a remote file so that the script can analyze it
	 *
	 * @since 3.0.0
	 */
	public static function create_local_copy() {
		global $wp_filesystem;
		global $post;

		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'vwwaveplayer-ajax-call' ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
			wp_send_json_error( array( 'message' => esc_html__( 'The request is not valid', 'vwwaveplayer' ) ) );
		}

		$url           = isset( $_POST['url'] ) ? $_POST['url'] : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
		$id            = md5( $url );
		$type          = 'external';
		$local_file    = wp_normalize_path( VWWAVEPLAYER_PEAK_FOLDER . "$type/$id." . pathinfo( wp_parse_url( $url, PHP_URL_PATH ), PATHINFO_EXTENSION ) );
		$info_file     = wp_normalize_path( VWWAVEPLAYER_PEAK_FOLDER . "$type/$id.info" );
		$parsed_url    = wp_parse_url( $url );
		$parsed_domain = wp_parse_url( site_url() );

		if ( $parsed_url['host'] === $parsed_domain['host'] || ! isset( $parsed_url['host'] ) ) {
			if ( file_exists( $info_file ) ) {
				$data = json_decode( $wp_filesystem->get_contents( $info_file ), true );
				wp_send_json_success( array( 'track' => $data ) );
			} else {
				$relative_url = wp_make_link_relative( $url );
				$abspath      = str_replace( 'wp-content', '', WP_CONTENT_DIR );

				if ( isset( $parsed_domain['path'] ) ) {
					$subfolder = preg_quote( $parsed_domain['path'], '/' );
					$abspath   = preg_replace( "/$subfolder$/", '', $abspath );
				}

				$local_file = wp_normalize_path( $abspath . $relative_url );

				if ( ! file_exists( $local_file ) ) {
					wp_send_json_error( array( 'message' => esc_html__( 'The file could not be found. Please make sure the file exists on this server.', 'vwwaveplayer' ) ) );
				}

				$data = self::extract_audio_metadata( $id, $local_file );

				if ( ! $data ) {
					wp_send_json_error( array( 'message' => esc_html__( 'An error occurred while trying to retrieve the audio metadata of the file', 'vwwaveplayer' ) ) );
				}

				$data['file']      = $url;
				$data['temp_file'] = $url;
				$data['id']        = $id;
				$data['type']      = $type;
				$wp_filesystem->put_contents( $info_file, wp_json_encode( $data ) );
				wp_send_json_success( array( 'track' => apply_filters( 'vwwaveplayer_add_external_track_info', $data, $id, $post->ID, $url ) ) );
			}
		} else {
			$copy_success = false;
			$tmp_file     = download_url( $url );
			if ( is_wp_error( $tmp_file ) ) {
				wp_send_json_error( array( 'message' => $tmp_file->get_error_message() ) );
			} else {
				$copy_success = $wp_filesystem->copy( $tmp_file, $local_file );
				$wp_filesystem->delete( $tmp_file );
			}
			if ( ! is_wp_error( $copy_success ) ) {
				$upload_dir = wp_upload_dir();
				$data       = self::extract_audio_metadata( $id, $local_file );
				$local_url  = trailingslashit( VWWAVEPLAYER_PEAK_PATH . "{$type}/" ) . basename( $local_file );
				if ( $copy_success ) {
					$data['temp_file'] = $local_url;
				}
				$data['type'] = $type;
				$data['id']   = $id;
				$data['file'] = $url;
				$wp_filesystem->put_contents( $info_file, wp_json_encode( $data ) );
				wp_send_json_success( array( 'track' => apply_filters( 'vwwaveplayer_add_external_track_info', $data, $id, $post->ID, $url ) ) );
			}
			wp_send_json_error( array( 'message' => esc_html__( 'An error occurred while trying to copy the file', 'vwwaveplayer' ) ) );
		}
	}

	/**
	 * Extract the audio metadata from a file, including the cover art picture
	 *
	 * @since  3.0.6
	 * @param  string $id   The hash of the file URL used as a unique ID.
	 * @param  string $file The path of the local file.
	 * @return array        The array containing the metadata
	 */
	private static function extract_audio_metadata( $id, $file ) {
		global $wp_filesystem;

		require_once ABSPATH . 'wp-admin/includes/media.php';
		$upload_dir = wp_upload_dir();
		$peak_url   = trailingslashit( $upload_dir['baseurl'] ) . 'peaks/';
		$data       = wp_read_audio_metadata( $file );
		if ( $data ) {
			$data['poster']           = vwwaveplayer()->get_option( 'default_thumbnail' );
			$data['poster_thumbnail'] = vwwaveplayer()->get_option( 'default_thumbnail' );
			$data['poster_srcset']    = '';
			if ( array_key_exists( 'image', $data ) && null !== $data['image'] ) {
				$image_ext  = preg_replace( '/.*\/(.*)/', '$1', $data['image']['mime'] );
				$image_file = VWWAVEPLAYER_PEAK_FOLDER . "external/$id.$image_ext";
				$wp_filesystem->put_contents( $image_file, $data['image']['data'] );
				$data['poster']           = $peak_url . "external/$id.$image_ext";
				$data['poster_thumbnail'] = $data['poster'];
				$data['poster_srcset']    = '';
				unset( $data['image'] );
			}
		}
		return $data;
	}

	/**
	 * Get the URL of a streamable file from Soundcloud
	 *
	 * @since 3.0.0
	 */
	public static function get_soundcloud_track_stream() {

		if ( ( ! isset( $_POST['nonce'] ) && ! isset( $_POST['instance_id'] ) ) || ! wp_verify_nonce( $_POST['nonce'], 'vwwaveplayer-ajax-call' ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
			wp_send_json_error( array( 'message' => esc_html__( 'The request is not valid', 'vwwaveplayer' ) ) );
		}

		if ( ! isset( $_POST['id'] ) ) {
			wp_send_json_error( array( 'message' => esc_html__( 'The post id was not defined', 'vwwaveplayer' ) ) );
		}

		$file = Soundcloud::get_track_stream( $_POST['id'] );

		if ( ! is_wp_error( $file ) ) {
			wp_send_json_success( array( 'file' => $file ) );
		}

		wp_send_json_error( array( 'message' => $file->get_error_message() ) );
	}

	public static function refresh_interface() {
		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'vwwaveplayer-ajax-call' ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
			wp_send_json_error( array( 'message' => esc_html__( 'The request is not valid', 'vwwaveplayer' ) ) );
		}

		$html = Renderer::vwwaveplayer_shortcode(
			array_merge(
				$_POST,
				array(
					'ajax' => true,
				)
			)
		);

		$ajax_nonce = wp_create_nonce( 'vwwaveplayer-ajax-call' );

		wp_send_json_success(
			array(
				'html'       => $html,
				'ajax_nonce' => $ajax_nonce,
			)
		);
	}

	/**
	 * Update the play count and runtime of an audio attachment
	 *
	 * @since 3.0.0
	 */
	public static function update_statistics() {

		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'vwwaveplayer-ajax-call' ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
			wp_send_json_error( array( 'message' => esc_html__( 'The request is not valid', 'vwwaveplayer' ) ) );
		}

		$post_id = isset( $_POST['id'] ) ? (int) $_POST['id'] : 0;

		if ( ! wp_attachment_is( 'audio', $post_id ) ) {
			wp_send_json_error( array( 'message' => esc_html__( 'The attachment ID is not valid', 'vwwaveplayer' ) ) );
		}

		$runtime = isset( $_POST['runtime'] ) ? round( ( (int) $_POST['runtime'] ) / 1000 ) : 0;

		$played            = isset( $_POST['length'] ) ? $runtime >= self::get_played_percentage( $post_id ) * ( (int) $_POST['length'] ) : false;
		$stats             = self::get_track_stats( $post_id );
		$stats['runtime'] += $runtime;

		if ( $played ) {
			$stats['play_count']++;
		}

		update_post_meta( $post_id, 'wvpl_play_count', $stats['play_count'] );
		update_post_meta( $post_id, 'wvpl_runtime', $stats['runtime'] );

		wp_send_json_success(
			array(
				'id'    => $post_id,
				'stats' => $stats,
			)
		);

	}

	public static function get_played_percentage( $track_id = 0 ) {
		/**
		 * Filter the percentage of the track length that must be played to count as a play
		 *
		 * By default, a track must be played for at least 10% of its length to count as a play.
		 * This filter allows you to change this value.
		 * By setting it to zero, for example, a track will be counted as played as soon as it starts playing.
		 *
		 * @since 3.5.3
		 * @param float      $played_percentage The percentage of the track length that must be played to count as a play.
		 * @param int|string $track_id           The audio attachment ID.
		 */
		return apply_filters( 'vwwaveplayer_length_percentage_to_count_plays', 0.1, $track_id );

	}

	/**
	 * Update the likes of an audio attachment
	 *
	 * @since 3.0.0
	 */
	public static function update_likes() {

		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'vwwaveplayer-ajax-call' ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
			wp_send_json_error( array( 'message' => esc_html__( 'The request is not valid', 'vwwaveplayer' ) ) );
		}

		$current_user = wp_get_current_user();
		$user_id      = $current_user->ID;
		$track_id     = filter_input( INPUT_POST, 'id', FILTER_VALIDATE_INT );
		$stats        = self::get_track_stats( $track_id );

		if ( 0 === $user_id ) {
			wp_send_json_error(
				array(
					'message' => esc_html__( 'Visitors cannot like tracks', 'vwwaveplayer' ),
					'id'      => $track_id,
					'stats'   => $stats,
				)
			);
		}

		$liked_tracks = array_map( 'intval', get_user_meta( $user_id, 'wvpl_likes' ) );
		$liked        = false;

		if ( in_array( $track_id, $liked_tracks, true ) ) {
			delete_user_meta( $user_id, 'wvpl_likes', $track_id );
		} else {
			$liked = true;
			add_user_meta( $user_id, 'wvpl_likes', $track_id );
		}

		$stats['likes'] = self::get_track_likes( $track_id );

		// phpcs:ignore Generic.Commenting.Todo.TaskFound
		// TODO: verify if this is necessary.
		// update_post_meta( $post_id, 'wvpl_likes_start', $stats['likes'] ); .

		wp_send_json_success(
			array(
				'id'    => $track_id,
				'stats' => $stats,
				'liked' => $liked,
			)
		);

	}

	/**
	 * Update the downloads of an audio attachment
	 *
	 * @since 3.0.0
	 */
	public static function update_downloads() {

		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'vwwaveplayer-ajax-call' ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
			wp_send_json_error( array( 'message' => esc_html__( 'The request is not valid', 'vwwaveplayer' ) ) );
		}

		$post_id = isset( $_POST['id'] ) ? (int) $_POST['id'] : 0;
		$stats   = self::get_track_stats( $post_id );
		$stats['downloads']++;

		update_post_meta( $post_id, 'wvpl_downloads', $stats['downloads'] );

		wp_send_json_success(
			array(
				'id'    => $post_id,
				'stats' => $stats,
			)
		);
	}

	/**
	 * Get all the audio attachments in the Media Library and send it as a response to the ajax call
	 *
	 * @since  3.0.0
	 */
	public static function get_audio_attachments() {

		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'vwwaveplayer-admin-tools' ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
			wp_send_json_error( array( 'message' => esc_html__( 'The request is not valid', 'vwwaveplayer' ) ) );
		}

		$overwrite = isset( $_POST['overwrite'] ) ? 'false' !== $_POST['overwrite'] : false;

		$args        = array(
			'posts_per_page' => -1,
			'post_type'      => 'attachment',
			'post_mime_type' => 'audio',
			'post_status'    => 'any',
		);
		$attachments = new WP_Query( $args );
		$audio_files = $attachments->posts;

		foreach ( $audio_files as $key => $audio_file ) {
			$audio_files[ $key ]->meta     = wp_get_attachment_metadata( $audio_file->ID );
			$audio_files[ $key ]->file_url = wp_get_attachment_url( $audio_file->ID );
		}

		$audio_files = array_filter(
			$audio_files,
			function( $f ) {
				return false === strpos( 'woocommerce_uploads', $f->file_url );
			}
		);

		if ( ! $overwrite ) {
			$audio_files = array_values(
				array_filter(
					$audio_files,
					function( $f ) {
						return ! file_exists( VWWAVEPLAYER_PEAK_FOLDER . $f->ID . '.peaks' );
					}
				)
			);
		}

		wp_send_json_success( array( 'audioFiles' => $audio_files ) );
	}

	/**
	 * Generate the HTML markup for the audio attachment list with checkboxes and send it as a response to the ajax call
	 *
	 * @since  3.1.0
	 */
	public static function music_inputs() {

		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'vwwaveplayer-admin-tools' ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
			wp_send_json_error( array( 'message' => esc_html__( 'The request is not valid', 'vwwaveplayer' ) ) );
		}

		$per_page = isset( $_POST['per_page'] ) ? $_POST['per_page'] : 10;  // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
		$paged    = isset( $_POST['paged'] ) ? $_POST['paged'] : 1;  // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
		$search   = isset( $_POST['search'] ) ? $_POST['search'] : '';  // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash

		$music_inputs = WooCommerce::music_inputs( $per_page, $paged, $search );
		if ( $music_inputs ) {
			$track_inputs   = $music_inputs['track_inputs'];
			$paginate_links = $music_inputs['paginate_links'];
			wp_send_json_success(
				array(
					'track_inputs'   => $track_inputs,
					'paginate_links' => $paginate_links,
				)
			);
		}
		wp_send_json_error( array( 'message' => esc_html__( 'An error occurred while retrieving the audio attachments.', 'vwwaveplayer' ) ) );
	}

	/**
	 * Update the palettes stored in the database
	 *
	 * @since 3.0.0
	 */
	public static function save_palette() {

		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'vwwaveplayer-admin-tools' ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
			wp_send_json_error( array( 'message' => esc_html__( 'The request is not valid', 'vwwaveplayer' ) ) );
		}

		$value = array(
			'name'   => isset( $_POST['name'] ) ? $_POST['name'] : __( 'New Palette', 'vwwaveplayer' ), // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
			'colors' => isset( $_POST['colors'] ) ? $_POST['colors'] : '', // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
		);

		$palettes = get_option( 'vwwaveplayer_palettes' );
		if ( ! $palettes ) {
			$palettes = Renderer::factory_palettes();
		}

		if ( ! isset( $_POST['index'] ) || ! is_numeric( $_POST['index'] ) ) {
			$index = array_search( $colors, array_column( $palettes, 'colors' ), true );
		}

		if ( false !== $index && $index >= 0 ) {
			$palettes[ $index ] = $value;
		} else {
			$palettes[] = $value;
			$index      = count( $palettes ) - 1;
		}

		$palettes = array_values( $palettes );

		if ( ! add_option( 'vwwaveplayer_palettes', $palettes, '', 'no' ) ) {
			update_option( 'vwwaveplayer_palettes', $palettes );
		}

		wp_send_json_success(
			array(
				'palettes' => $palettes,
				'index'    => $index,
			)
		);

	}

	/**
	 * Create draft products for each audio attachment, assigned as a preview file
	 *
	 * @since 3.0.0
	 */
	public static function create_product() {

		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'vwwaveplayer-admin-tools' ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
			wp_send_json_error( array( 'message' => esc_html__( 'The request is not valid', 'vwwaveplayer' ) ) );
		}

		$type         = isset( $_POST['type'] ) ? $_POST['type'] : '';  // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
		$type         = 'tracks' === $type ? 'single' : 'album';
		$product_type = isset( $_POST['product_type'] ) ? $_POST['product_type'] : 'simple'; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
		$files        = array();
		switch ( $type ) {
			case 'single':
				$id    = isset( $_POST['id'] ) ? (int) $_POST['id'] : 0;
				$price = isset( $_POST['price'] ) ? (float) $_POST['price'] : '0.99';
				$track = wp_get_attachment_metadata( $id );
				$post  = get_post( $id );
				if ( $post->post_title ) {
					$track['title'] = $post->post_title;
				}
				$file_name           = $track['title'];
				$file_name           = wc_clean( $file_name );
				$file_url            = wp_get_attachment_url( $id );
				$file_hash           = md5( $file_url );
				$files[ $file_hash ] = array(
					'name' => $file_name,
					'file' => $file_url,
				);
				$title               = $file_name;
				break;
			case 'album':
				$price = isset( $_POST['price'] ) ? (float) $_POST['price'] : '9.99';
				$ids   = isset( $_POST['tracks'] ) ? $_POST['tracks'] : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
				$ids   = explode( ',', $ids );
				foreach ( $ids as $id ) {
					$track = wp_get_attachment_metadata( $id );
					$post  = get_post( $id );
					if ( $post->post_title ) {
						$track['title'] = $post->post_title;
					}
					$file_name           = $track['title'];
					$file_name           = wc_clean( $file_name );
					$file_url            = wp_get_attachment_url( $id );
					$file_hash           = md5( $file_url );
					$files[ $file_hash ] = array(
						'name' => $file_name,
						'file' => $file_url,
					);
				}
				$title = isset( $_POST['title'] ) ? $_POST['title'] : esc_html_e( 'New Album', 'vwwaveplayer' ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
				break;
			default:
				break;
		}

		$post_id = wp_insert_post(
			array(
				'post_title'  => $title,
				'post_status' => 'draft',
				'post_type'   => 'product',
			)
		);
		wp_set_object_terms( $post_id, $product_type, 'product_type' );
		update_post_meta( $post_id, '_visibility', 'visible' );
		update_post_meta( $post_id, '_stock_status', 'instock' );
		update_post_meta( $post_id, 'total_sales', '0' );
		update_post_meta( $post_id, '_virtual', 'yes' );
		update_post_meta( $post_id, '_downloadable', 'yes' );
		update_post_meta( $post_id, '_regular_price', $price );
		update_post_meta( $post_id, '_featured', 'no' );
		update_post_meta( $post_id, '_price', $price );
		update_post_meta( $post_id, '_sold_individually', 'yes' );
		update_post_meta( $post_id, '_preview_files', $files );
		update_post_meta( $post_id, '_music_type', $type );

		wp_send_json_success();
	}

	/**
	 * Dismiss the registration notice for a week
	 *
	 * @since 3.0.0
	 */
	public static function dismiss_registration_notice() {
		set_transient( '_vwwaveplayer_registration_notice_dismissed', 1, 7 * DAY_IN_SECONDS );
	}

	/**
	 * Add a product to the cart
	 *
	 * @since 3.0.0
	 */
	public static function add_to_cart() {
		if ( ! defined( 'WC_VERSION' ) ) {
			wp_die();
		}

		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'vwwaveplayer-ajax-call' ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
			wp_send_json_error( array( 'message' => esc_html__( 'The request is not valid', 'vwwaveplayer' ) ) );
		}
		WooCommerce::ajax_add_to_cart();
	}

	/**
	 * Parse a shortcode from the MCE Editor
	 *
	 * @since 3.0.0
	 */
	public static function parse_shortcode() {
		Renderer::ajax_parse_shortcode();
	}

	/**
	 * Parse a single audio shortcode from the MCE Editor
	 *
	 * @since 3.0.0
	 */
	public static function parse_single_shortcode() {
		Renderer::ajax_parse_single_shortcode();
	}
}

/**
 * WVPLStats class
 *
 * @since 2.0.0
 * @deprecated 3.0.0
 * @phpcs:disable Generic.Files.OneObjectStructurePerFile.MultipleFound
 */
class WVPLStats {

	/**
	 * The play count of a track
	 *
	 * @var int
	 */
	public $play_count = 0;

	/**
	 * The time in seconds a track has been played back
	 *
	 * @var int
	 */
	public $runtime = 0;

	/**
	 * The number of times a track was downloaded
	 *
	 * @var int
	 */
	public $downloads = 0;

	/**
	 * The number of times a track was liked
	 *
	 * @var int
	 */
	public $likes = array();

	/**
	 * The main constructor of the class
	 *
	 * @since 2.0.0
	 * @param int $new_play_count The number of times a track was played back.
	 * @param int $new_runtime    The time in seconds a track was played back.
	 * @param int $new_downloads  The number of times a track was downloaded.
	 * @param int $new_likes      The number of times a track was liked.
	 */
	public function __construct( $new_play_count = 0, $new_runtime = 0, $new_downloads = 0, $new_likes = 0 ) {
		$this->play_count = $new_play_count;
		$this->runtime    = $new_runtime;
		$this->downloads  = $new_downloads;
		$this->likes      = $new_likes;
	}
}

AJAX::load();
