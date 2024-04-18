<?php
/**
 * Soundcloud class
 *
 * @package VwWavePlayer/SoundCloud
 */

namespace PerfectPeach\VwWavePlayer;

use WP_Error;

defined( 'ABSPATH' ) || exit;

/**
 * The Soundcloud class provides support for Soundcloud URLs
 *
 * @package VwWavePlayer/SoundCloud
 */
class Soundcloud {

	public static function get_credentials() {
		$data = get_transient( 'vwwaveplayer_soundcloud_access_token' );

		if ( ! $data ) {
			$data = self::get_access_data();
		} elseif ( isset( $data['valid_until'] ) && $data['valid_until'] < time() ) {
			$data = self::get_access_data( $data['refresh_token'] );
		}

		return $data;
	}

	public static function get_access_token() {
		$data = self::get_credentials();

		if ( $data ) {
			return $data['access_token'];
		}

		return false;
	}

	public static function get_api_url( $path = '' ) {
		$url = 'https://api.soundcloud.com';

		return wp_normalize_path( "$url/$path" );
	}

	private static function get_access_data( $refresh_token = '' ) {
		$client_id_secret = self::get_client_id_secret();

		if ( ! $client_id_secret['client_id'] || ! $client_id_secret['client_id'] ) {
			return false;
		}

		$body = array(
			'grant_type'    => 'client_credentials',
			'client_id'     => $client_id_secret['client_id'],
			'client_secret' => $client_id_secret['client_secret'],
		);

		if ( $refresh_token ) {
			$body['grant_type']    = 'refresh_token';
			$body['refresh_token'] = $refresh_token;
		}

		$response = wp_remote_post(
			'https://api.soundcloud.com/oauth2/token',
			array(
				'headers' => array(
					'Accept'       => 'application/json; charset=utf-8',
					'Content-Type' => 'application/x-www-form-urlencoded',
				),
				'body'    => $body,
			)
		);

		if ( is_wp_error( $response ) || ! is_array( $response ) ) {
			return false;
		}

		$data = [];

		if ( is_array( $response ) && isset( $response['body'] ) ) {
			$data = self::set_access_token_transient( json_decode( $response['body'], true ) );
		}

		return $data;
	}

	private static function set_access_token_transient( $data ) {
		if ( isset( $data['access_token'] ) ) {
			$expires_in  = isset( $data['expires_in'] ) ? $data['expires_in'] : 3599;
			$valid_until = time() + $expires_in - MINUTE_IN_SECONDS;

			$data['valid_until'] = $valid_until;

			set_transient( 'vwwaveplayer_soundcloud_access_token', $data, $expires_in - MINUTE_IN_SECONDS );

			return $data;
		}

		return false;
	}


	private static function get_client_id_secret() {
		return apply_filters(
			'vwwaveplayer_soundcloud_client_id_secret',
			[
				'client_id'     => '',
				'client_secret' => '',
			]
		);
	}

	/**
	 * Return an array of tracks corresponding to a soundcloud URL
	 * The URL can be a single track or a playlist
	 *
	 * @since  3.0.0
	 * @param  string $sc_url A URL to a track or a playlist on Soundcloud.
	 * @return array
	 */
	public static function get_tracks( $sc_url ) {
		$credentials = self::get_credentials();
		$options     = array(
			'headers' => array(
				'Authorization' => "OAuth {$credentials['access_token']}",
			)
		);

		$tracks = array();

		if ( pathinfo( $sc_url, PATHINFO_EXTENSION ) === 'rss' ) {
			$feed  = fetch_feed( $sc_url );
			$items = $feed->get_items( 0, 5 );

			foreach ( $items as $item ) {
				$track_url = rawurlencode( $item->get_permalink() );
				$sc_url    = self::get_api_url( "/resolve?url=$track_url" );
				$response  = wp_remote_get( $sc_url, $options );
				$body      = wp_remote_retrieve_body( $response );

				if ( is_wp_error( $body ) ) {
					continue;
				}

				$tracks[] = json_decode( $body, true );
			}
		} else {
			$sc_url = rawurlencode( $sc_url );
			$sc_url = self::get_api_url( "/resolve?url=$sc_url" );

			$response = wp_remote_get( $sc_url, $options );
			$body     = wp_remote_retrieve_body( $response );

			if ( is_wp_error( $body ) ) {
				return array();
			}

			$data = json_decode( $body, true );

			if ( 'playlist' === $data['kind'] ) {
				$tracks = $data['tracks'];
			} else {
				$tracks = array( $data );
			}
		}

		return $tracks;
	}

	/**
	 * Return the URL of the streamable audio file of a Soundcloud track
	 *
	 * @since  3.0.0
	 * @param  string $track_id     The Soundcloud URL to retrieve the streamable file.
	 * @return array
	 */
	public static function get_track_stream( $track_id ) {
		$credentials = self::get_credentials();
		$sc_url      = self::get_api_url( "tracks/$track_id/streams" );
		$options     = array(
			'headers' => array(
				'Authorization' => "OAuth {$credentials['access_token']}",
			)
		);

		$response      = wp_remote_get( $sc_url, $options );
		$body          = wp_remote_retrieve_body( $response );
		$track_streams = json_decode( $body, true );

		if ( isset( $track_streams['http_mp3_128_url'] ) ) {
			return $track_streams['http_mp3_128_url'];
		}

		if ( isset( $track_streams['code'] ) ) {
			return new WP_Error( $track_streams['code'], $track_streams['message'] );
		}

		return new WP_Error( '400', __( 'Soundcloud returned a generic error.', 'vwwaveplayer' ) );
	}
}
