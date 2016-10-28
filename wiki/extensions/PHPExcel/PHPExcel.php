<?php

if (!defined('MEDIAWIKI')) {
	die('Not an entry point.');
}

if (!extension_loaded('zip')) {
	die('Missing zip extension.');
}

if (!extension_loaded('xml')) {
	die('Missing xml extension.');
}

if (!extension_loaded('iconv')) {
	die('Missing iconv extension.');
}

$dir = __DIR__;

// Internationalization
$wgMessagesDirs['PHPExcel'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['PHPExcel'] = $dir . '/PHPExcel.i18n.php';

$wgExtensionCredits['other'][] = array(
	'path' => __FILE__,
	'name' => 'PHPExcel',
	'author' => 'Kim Eik',
	'url' => 'https://www.mediawiki.org/wiki/Extension:PHPExcel',
	'descriptionmsg' => 'phpexcel-desc',
	'version' => '1.8.0',
);

## PHPExcel library
$wgAutoloadClasses['PHPExcel'] = $dir . '/includes/PHPExcel.php';
