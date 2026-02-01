<?php

if ( ! class_exists( 'WP_CLI' ) ) {
	return;
}

/**
 * Open /wp-admin/ in a browser.
 */
function wp_cli_admin_command() {
	$admin_url = admin_url();

	// Detect if running over SSH connection
	$is_ssh = ! empty( $_SERVER['SSH_CONNECTION'] )
		|| ! empty( $_SERVER['SSH_CLIENT'] )
		|| ! empty( $_SERVER['SSH_TTY'] );

	// If SSH connection detected, output the URL instead of trying to open browser
	if ( $is_ssh ) {
		WP_CLI::log( 'Detected SSH connection. Please open this URL in your local browser:' );
		WP_CLI::log( $admin_url );
		return;
	}

	// Determine the command to open browser based on OS
	switch ( strtoupper( substr( PHP_OS, 0, 3 ) ) ) {
		case 'DAR':
			$exec = 'open';
			break;
		case 'WIN':
			$exec = 'start ""';
			break;
		default:
			$exec = 'xdg-open';
	}

	// Try to open the URL in the browser
	$output     = '';
	$return_var = 0;
	exec( $exec . ' ' . escapeshellarg( $admin_url ) . ' 2>&1', $output, $return_var );

	// If the command fails (e.g., xdg-open not found), fallback to printing the URL
	if ( 0 !== $return_var ) {
		WP_CLI::log( 'Unable to open browser automatically. Please open this URL:' );
		WP_CLI::log( $admin_url );
	}
}
WP_CLI::add_command( 'admin', 'wp_cli_admin_command' );
