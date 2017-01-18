<?php

if ( ! class_exists( 'WP_CLI' ) ) {
	return;
}

/**
 * Open /wp-admin/ in a browser.
 */
$wp_admin = function() {
	$exec = 'xdg-open';
	if ( 'DAR' === strtoupper( substr( PHP_OS, 0, 3 ) ) ) {
		$exec = 'open';
	}
	passthru( $exec . ' ' . escapeshellarg( admin_url() ) );
};
WP_CLI::add_command( 'admin', $wp_admin );
