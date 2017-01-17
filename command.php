<?php

if ( ! class_exists( 'WP_CLI' ) ) {
	return;
}

/**
 * Open /wp-admin/ in a browser.
 */
$wp_admin = function() {
	passthru( 'open ' . escapeshellarg( admin_url() ) );
};
WP_CLI::add_command( 'admin', $wp_admin );
