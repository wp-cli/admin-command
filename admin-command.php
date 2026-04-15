<?php

if ( ! class_exists( 'WP_CLI' ) ) {
	return;
}

$wpcli_core_autoloader = __DIR__ . '/vendor/autoload.php';
if ( file_exists( $wpcli_core_autoloader ) ) {
	require_once $wpcli_core_autoloader;
}

WP_CLI::add_command(
	'admin',
	static function () {
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
		passthru( $exec . ' ' . escapeshellarg( admin_url() ) );
	}
);
