<?php

if ( ! class_exists( 'WP_CLI' ) ) {
	return;
}

/**
 * Open /wp-admin/ in a browser.
 */
$wp_admin = function() {
    switch ( strtoupper( substr( PHP_OS, 0, 3 ) ) ) {
        case 'DAR':
            $exec = 'open';
            break;
        case 'WIN':
            $exec = 'start';
            break;
        default:
            $exec = 'xdg-open';
    }
	passthru( $exec . ' ' . escapeshellarg( admin_url() ) );
};
WP_CLI::add_command( 'admin', $wp_admin );
