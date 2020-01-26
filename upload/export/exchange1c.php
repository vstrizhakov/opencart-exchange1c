<?php
// Version
define('VERSION', '1.6.0');

// Configuration
require_once('../admin/config.php');

require_once(DIR_SYSTEM . 'startup.php');
require_once(DIR_SYSTEM . 'library/cart/currency.php');
require_once(DIR_SYSTEM . 'library/cart/user.php');
require_once(DIR_SYSTEM . 'library/cart/weight.php');
require_once(DIR_SYSTEM . 'library/cart/length.php');

// Registry
$registry = new Registry();

// Loader
$loader = new Loader($registry);
$registry->set('load', $loader);

// Config
$config = new Config();
$config->load('default');
$registry->set('config', $config);

// Database
$db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
$registry->set('db', $db);

// Settings
$query = $db->query("SELECT * FROM " . DB_PREFIX . "setting");
 
foreach ($query->rows as $setting) {
	if (!$setting['serialized']) {
		$config->set($setting['key'], $setting['value']);
	} else {
		$config->set($setting['key'], json_decode($setting['value']));
	}
}

// Log 
$log = new Log($config->get('config_error_filename'));
$registry->set('log', $log);

// Event
$event = new Event($registry);
$registry->set('event', $event);

date_default_timezone_set($config->get('date_timezone'));

// Error Handler
set_error_handler(function($code, $message, $file, $line) use($log, $config) {
	// error suppressed with @
	if (error_reporting() === 0) {
		return false;
	}

	switch ($code) {
		case E_NOTICE:
		case E_USER_NOTICE:
			$error = 'Notice';
			break;
		case E_WARNING:
		case E_USER_WARNING:
			$error = 'Warning';
			break;
		case E_ERROR:
		case E_USER_ERROR:
			$error = 'Fatal Error';
			break;
		default:
			$error = 'Unknown';
			break;
	}

	if ($config->get('error_display')) {
		echo '<b>' . $error . '</b>: ' . $message . ' in <b>' . $file . '</b> on line <b>' . $line . '</b>';
	}

	if ($config->get('error_log')) {
		$log->write('PHP ' . $error . ':  ' . $message . ' in ' . $file . ' on line ' . $line);
	}

	return true;
});

// Request
$request = new Request();
$registry->set('request', $request);

// Response
$response = new Response();
$response->addHeader('Content-Type: text/html; charset=utf-8');
$response->setCompression($config->get('config_compression'));
$registry->set('response', $response); 

// Session
$registry->set('session', new Session($config->get('session_engine'), $registry));

// Cache
$registry->set('cache', new Cache($config->get('cache_engine'), $config->get('cache_expire')));

// Document
$registry->set('document', new Document());

// Language
$languages = array();

$query = $db->query("SELECT * FROM " . DB_PREFIX . "language"); 

foreach ($query->rows as $result) {
	$languages[$result['code']] = array(
		'language_id'	=> $result['language_id'],
		'name'		=> $result['name'],
		'code'		=> $result['code'],
		'locale'	=> $result['locale'],
		'directory'	=> $result['directory']
	);
}

$config->set('config_language_id', $languages[$config->get('config_admin_language')]['language_id']);

$language = new Language($languages[$config->get('config_admin_language')]['directory']);
$language->load($languages[$config->get('config_admin_language')]['directory']);	
$registry->set('language', $language);

// Currency
$registry->set('currency', new Cart\Currency($registry));

// Weight
$registry->set('weight', new Cart\Weight($registry));

// Length
$registry->set('length', new Cart\Length($registry));

// User
$registry->set('user', new Cart\User($registry));

// Front Controller
$controller = new Router($registry);


// Router
if (isset($request->get['mode']) && $request->get['type'] == 'catalog') {

	switch ($request->get['mode']) {
		case 'checkauth':
			$action = new Action('extension/exchange1c/modeCheckauth');
		break;
		
		case 'init':
			$action = new Action('extension/exchange1c/modeCatalogInit');
		break;

		case 'file':
			$action = new Action('extension/exchange1c/modeFile');
		break;

		case 'import':
			$action = new Action('extension/exchange1c/modeImport');
		break;

		default:
			echo "success\n";
	}
	
} else if (isset($request->get['mode']) && $request->get['type'] == 'sale') {
	
	switch ($request->get['mode']) {
		case 'checkauth':
			$action = new Action('extension/exchange1c/modeCheckauth');
		break;
		
		case 'init':
			$action = new Action('extension/exchange1c/modeSaleInit');
		break;

		case 'query':
			$action = new Action('extension/exchange1c/modeQueryOrders');
		break;

		case 'success':
			$action = new Action('extension/exchange1c/modeOrdersChangeStatus');
		break;

		default:
			echo "success\n";
	}

} else {
	echo "success\n";
	exit;
}

// Dispatch
if (isset($action))
	$controller->dispatch($action, new Action('error/not_found'));

// Output
$response->output();