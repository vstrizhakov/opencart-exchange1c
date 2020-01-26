<?php
class ControllerExtensionExchange1c extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('extension/exchange1c');
		$this->load->model('tool/image');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->request->post['exchange1c_order_date'] = $this->config->get('exchange1c_order_date');
			$this->model_setting_setting->editSetting('exchange1c', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('extension/exchange1c', 'user_token=' . $this->session->data['user_token'], 'SSL'));
		}

		$data['version'] = 'Version 2.0.0';

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		}
		else {
			$data['error_warning'] = '';
		}

 		if (isset($this->error['image'])) {
			$data['error_image'] = $this->error['image'];
		} else {
			$data['error_image'] = '';
		}

		if (isset($this->error['exchange1c_username'])) {
			$data['error_exchange1c_username'] = $this->error['exchange1c_username'];
		}
		else {
			$data['error_exchange1c_username'] = '';
		}

		if (isset($this->error['exchange1c_password'])) {
			$data['error_exchange1c_password'] = $this->error['exchange1c_password'];
		}
		else {
			$data['error_exchange1c_password'] = '';
		}
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'		=> $this->language->get('text_home'),
			'href'		=> $this->url->link('common/home', 'user_token=' . $this->session->data['user_token'], 'SSL'),
			'separator'	=> false
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('extension/exchange1c', 'user_token=' . $this->session->data['user_token'], 'SSL'),
			'separator' => ' :: '
		);

		$data['user_token'] = $this->session->data['user_token'];

		$data['action'] = $this->url->link('extension/exchange1c', 'user_token=' . $this->session->data['user_token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/exchange1c', 'user_token=' . $this->session->data['user_token'], 'SSL');

		if (isset($this->request->post['exchange1c_username'])) {
			$data['exchange1c_username'] = $this->request->post['exchange1c_username'];
		}
		else {
			$data['exchange1c_username'] = $this->config->get('exchange1c_username');
		}

		if (isset($this->request->post['exchange1c_password'])) {
			$data['exchange1c_password'] = $this->request->post['exchange1c_password'];
		}
		else {
			$data['exchange1c_password'] = $this->config->get('exchange1c_password'); 
		}

		if (isset($this->request->post['exchange1c_allow_ip'])) {
			$data['exchange1c_allow_ip'] = $this->request->post['exchange1c_allow_ip'];
		}
		else {
			$data['exchange1c_allow_ip'] = $this->config->get('exchange1c_allow_ip'); 
		} 
		
		if (isset($this->request->post['exchange1c_status'])) {
			$data['exchange1c_status'] = $this->request->post['exchange1c_status'];
		}
		else {
			$data['exchange1c_status'] = $this->config->get('exchange1c_status');
		}

		if (isset($this->request->post['exchange1c_price_type'])) {
			$data['exchange1c_price_type'] = $this->request->post['exchange1c_price_type'];
		}
		else {
			$data['exchange1c_price_type'] = $this->config->get('exchange1c_price_type');
			if(empty($data['exchange1c_price_type'])) {
				$data['exchange1c_price_type'][] = array(
					'keyword'			=> '',
					'customer_group_id'		=> 0,
					'quantity'			=> 0,
					'priority'			=> 0
				);
			}
		}

		if (isset($this->request->post['exchange1c_flush_product'])) {
			$data['exchange1c_flush_product'] = $this->request->post['exchange1c_flush_product'];
		}
		else {
			$data['exchange1c_flush_product'] = $this->config->get('exchange1c_flush_product');
		}

		if (isset($this->request->post['exchange1c_flush_category'])) {
			$data['exchange1c_flush_category'] = $this->request->post['exchange1c_flush_category'];
		}
		else {
			$data['exchange1c_flush_category'] = $this->config->get('exchange1c_flush_category');
		}

		if (isset($this->request->post['exchange1c_flush_manufacturer'])) {
			$data['exchange1c_flush_manufacturer'] = $this->request->post['exchange1c_flush_manufacturer'];
		}
		else {
			$data['exchange1c_flush_manufacturer'] = $this->config->get('exchange1c_flush_manufacturer');
		}
        
		if (isset($this->request->post['exchange1c_flush_quantity'])) {
			$data['exchange1c_flush_quantity'] = $this->request->post['exchange1c_flush_quantity'];
		}
		else {
			$data['exchange1c_flush_quantity'] = $this->config->get('exchange1c_flush_quantity');
		}

		if (isset($this->request->post['exchange1c_flush_attribute'])) {
			$data['exchange1c_flush_attribute'] = $this->request->post['exchange1c_flush_attribute'];
		}
		else {
			$data['exchange1c_flush_attribute'] = $this->config->get('exchange1c_flush_attribute');
		}
		
		if (isset($this->request->post['exchange1c_relatedoptions'])) {
			$data['exchange1c_relatedoptions'] = $this->request->post['exchange1c_relatedoptions'];
		} else {
			$data['exchange1c_relatedoptions'] = $this->config->get('exchange1c_relatedoptions');
		}
		
		if (isset($this->request->post['exchange1c_order_status_to_exchange'])) {
			$data['exchange1c_order_status_to_exchange'] = $this->request->post['exchange1c_order_status_to_exchange'];
		} else {
			$data['exchange1c_order_status_to_exchange'] = $this->config->get('exchange1c_order_status_to_exchange');
		}
		
		if (isset($this->request->post['exchange1c_default_stock_status_id'])) {
			$data['exchange1c_default_stock_status_id'] = $this->request->post['exchange1c_default_stock_status_id'];
		} else {
			$data['exchange1c_default_stock_status_id'] = $this->config->get('exchange1c_default_stock_status_id');
		}
		
		if (isset($this->request->post['exchange1c_dont_use_artsync'])) {
			$data['exchange1c_dont_use_artsync'] = $this->request->post['exchange1c_dont_use_artsync'];
		} else {
			$data['exchange1c_dont_use_artsync'] = $this->config->get('exchange1c_dont_use_artsync');
		}

		if (isset($this->request->post['exchange1c_seo_url'])) {
			$data['exchange1c_seo_url'] = $this->request->post['exchange1c_seo_url'];
		}
		else {
			$data['exchange1c_seo_url'] = $this->config->get('exchange1c_seo_url');
		}

		if (isset($this->request->post['exchange1c_full_log'])) {
			$data['exchange1c_full_log'] = $this->request->post['exchange1c_full_log'];
		}
		else {
			$data['exchange1c_full_log'] = $this->config->get('exchange1c_full_log');
		}

		if (isset($this->request->post['exchange1c_apply_watermark'])) {
			$data['exchange1c_apply_watermark'] = $this->request->post['exchange1c_apply_watermark'];
		}
		else {
			$data['exchange1c_apply_watermark'] = $this->config->get('exchange1c_apply_watermark');
		}

		if (isset($this->request->post['exchange1c_watermark'])) {
			$data['exchange1c_watermark'] = $this->request->post['exchange1c_watermark'];
		}
		else {
			$data['exchange1c_watermark'] = $this->config->get('exchange1c_watermark');
		}

		if (isset($data['exchange1c_watermark']) && is_file(DIR_IMAGE . $data['exchange1c_watermark'])) {
			$data['thumb'] = $this->model_tool_image->resize($data['exchange1c_watermark'], 100, 100);
		}
		else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		if (isset($this->request->post['exchange1c_order_status'])) {
			$data['exchange1c_order_status'] = $this->request->post['exchange1c_order_status'];
		}
		else {
			$data['exchange1c_order_status'] = $this->config->get('exchange1c_order_status');
		}

		if (isset($this->request->post['exchange1c_order_currency'])) {
			$data['exchange1c_order_currency'] = $this->request->post['exchange1c_order_currency'];
		}
		else {
			$data['exchange1c_order_currency'] = $this->config->get('exchange1c_order_currency');
		}

		if (isset($this->request->post['exchange1c_order_notify'])) {
			$data['exchange1c_order_notify'] = $this->request->post['exchange1c_order_notify'];
		}
		else {
			$data['exchange1c_order_notify'] = $this->config->get('exchange1c_order_notify');
		}

		// Группы
		$this->load->model('customer/customer_group');
		$data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();

		$this->load->model('localisation/order_status');

		$order_statuses = $this->model_localisation_order_status->getOrderStatuses();

		foreach ($order_statuses as $order_status) {
			$data['order_statuses'][] = array(
				'order_status_id' => $order_status['order_status_id'],
				'name'			  => $order_status['name']
			);
		}

		// Состояние на складе по умолчанию
		$this->load->model('localisation/stock_status');
		$stock_statuses = $this->model_localisation_stock_status->getStockStatuses();
		foreach ($stock_statuses as $stock_status) {
			$data['stock_statuses'][] = [
				'stock_status_id' => $stock_status['stock_status_id'],
				'name'			  => $stock_status['name'],
			];
		}

		$this->template = 'extension/exchange1c';
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view($this->template, $data));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/exchange1c')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		}
		else {
			return false;
		}
	}

	public function install() {}

	public function uninstall() {}

	// ---
	public function modeCheckauth() {
		// Проверяем включен или нет модуль
		if (!$this->config->get('exchange1c_status')) {
			echo "failure\n";
			echo "1c extension OFF";
			exit;
		}

		// Разрешен ли IP
		$allowedIPs = $this->config->get('exchange1c_allow_ip');
		if ($allowedIPs != '') {
			$ip = $_SERVER['REMOTE_ADDR'];
			$allow_ips = explode("\r\n", $allowedIPs);

			if (!in_array($ip, $allow_ips)) {
				echo "failure\n";
				echo "IP is not allowed";
				exit;
			}
		}

		// Авторизуем
		if (($this->config->get('exchange1c_username') != '') && (@$_SERVER['PHP_AUTH_USER'] != $this->config->get('exchange1c_username'))) {
			echo "failure\n";
			echo "error login";
		}
		
		if (($this->config->get('exchange1c_password') != '') && (@$_SERVER['PHP_AUTH_PW'] != $this->config->get('exchange1c_password'))) {
			echo "failure\n";
			echo "error password";
			exit;
		}

		echo "success\n";
		echo "key\n";
		echo md5($this->config->get('exchange1c_password')) . "\n";
	}

	public function manualImport() {
		$this->load->language('extension/exchange1c');

		$cache = DIR_CACHE . 'exchange1c/';
		$json = array();

		if (!empty($this->request->files['file']['name'])) {

			$zip = new ZipArchive;
			
			if ($zip->open($this->request->files['file']['tmp_name']) === true) {
				$this->modeCatalogInit(false);

				$zip->extractTo($cache);
				$files = scandir($cache);

				foreach ($files as $file) {
					if (is_file($cache . $file)) {
						$this->modeImport($file);
					}
				}

				if (is_dir($cache . 'import_files')) {
					$images = DIR_IMAGE . 'import_files/';
					
					if (is_dir($images)) {
						$this->cleanDir($images);
					}

					rename($cache . 'import_files/', $images);
				}

			}
			else {

				// Читаем первые 1024 байт и определяем файл по сигнатуре, ибо мало ли, какое у него имя
				$handle = fopen($this->request->files['file']['tmp_name'], 'r');
				$buffer = fread($handle, 1024);
				fclose($handle);

				if (strpos($buffer, 'Классификатор')) {
					$this->modeCatalogInit(false);
					move_uploaded_file($this->request->files['file']['tmp_name'], $cache . 'import.xml');
					$this->modeImport('import.xml');
				
				}
				else if (strpos($buffer, 'ПакетПредложений')) {
					move_uploaded_file($this->request->files['file']['tmp_name'], $cache . 'offers.xml');
					$this->modeImport('offers.xml');
				}
				else {
					$json['error'] = $this->language->get('text_upload_error');
					exit;
				}
			}

			$json['success'] = $this->language->get('text_upload_success');
		}

		$this->response->setOutput(json_encode($json));
	}
	
	public function modeCatalogInit($echo = true) {
		
		$this->load->model('extension/exchange1c');
		
		// чистим кеш, убиваем старые данные
		$this->cleanCacheDir();
		
		// Проверяем есть ли БД для хранения промежуточных данных.
		$this->model_extension_exchange1c->checkDbSheme();
		
		// Очищаем таблицы
		$this->model_extension_exchange1c->flushDb(array(
			'product' 		=> $this->config->get('exchange1c_flush_product'),
			'category'		=> $this->config->get('exchange1c_flush_category'),
			'manufacturer'	=> $this->config->get('exchange1c_flush_manufacturer'),
			'attribute'		=> $this->config->get('exchange1c_flush_attribute'),
			'full_log'		=> $this->config->get('exchange1c_full_log'),
			'apply_watermark'	=> $this->config->get('exchange1c_apply_watermark'),
			'quantity'		=> $this->config->get('exchange1c_flush_quantity')
		));

		$limit = 100000 * 1024;
	
		if ($echo) {
			echo "zip=no\n";
			echo "file_limit=".$limit."\n";
		}
	}

	public function modeSaleInit() {
		$limit = 100000 * 1024;
	
		echo "zip=no\n";
		echo "file_limit=".$limit."\n";
	}
	
	public function modeFile() {

		if (!isset($this->request->cookie['key'])) {
			return;
		}

		if ($this->request->cookie['key'] != md5($this->config->get('exchange1c_password'))) {
			echo "failure\n";
			echo "Session error";
			return;
		}

		$cache = DIR_CACHE . 'exchange1c/';

		// Проверяем на наличие имени файла
		if (isset($this->request->get['filename'])) {
			$uplod_file = $cache . $this->request->get['filename'];
		}
		else {
			echo "failure\n";
			echo "ERROR 10: No file name variable";
			return;
		}

		// Проверяем XML или изображения
		if (strpos($this->request->get['filename'], 'import_files') !== false) {
			$cache = DIR_IMAGE;
			$uplod_file = $cache . $this->request->get['filename'];
			$this->checkUploadFileTree(dirname($this->request->get['filename']) , $cache);
		}

		// Получаем данные
		$data = file_get_contents("php://input");

		if ($data !== false) {
			if ($fp = fopen($uplod_file, "wb")) {
				$result = fwrite($fp, $data);

				if ($result === strlen($data)) {
					echo "success\n";

					chmod($uplod_file , 0777);
					//echo "success\n";
				}
				else {
					echo "failure\n";
				}
			}
			else {
				echo "failure\n";
				echo "Can not open file: $uplod_file\n";
				echo $cache;
			}
		}
		else {
			echo "failure\n";
			echo "No data file\n";
		}
	}

	public function modeImport($manual = false) {

		$cache = DIR_CACHE . 'exchange1c/';

		if ($manual) {
			$filename = $manual;
			$importFile = $cache . $filename;
		}
		else if (isset($this->request->get['filename'])) {
			$filename = $this->request->get['filename'];
			$importFile = $cache . $filename;
		}
		else {
			echo "failure\n";
			echo "ERROR 10: No file name variable";
			return 0;
		}		

		$this->load->model('extension/exchange1c');

		// Определяем текущую локаль
		$language_id = $this->model_extension_exchange1c->getLanguageId($this->config->get('config_language'));

		if (strpos($filename, 'import') !== false) {
			
			$this->model_extension_exchange1c->parseImport($filename, $language_id);

            // Только если выбран способ deadcow_seo
			if ($this->config->get('exchange1c_seo_url') == 1) {
				$this->load->model('extension/deadcow_seo');
				$this->model_module_deadcow_seo->generateCategories($this->config->get('deadcow_seo_categories_template'), 'Russian');
				$this->model_module_deadcow_seo->generateProducts($this->config->get('deadcow_seo_products_template'), 'Russian');
				$this->model_module_deadcow_seo->generateManufacturers($this->config->get('deadcow_seo_manufacturers_template'), 'Russian');
			}

			if (!$manual)
			{
				echo "success\n";
			}
		}
		else if (strpos($filename, 'offers') !== false) {

			$exchange1c_price_type = $this->config->get('exchange1c_price_type');
			$this->model_extension_exchange1c->parseOffers($filename, $exchange1c_price_type, $language_id);
			
			if (!$manual) {
				echo "success\n";
			}
		}
		else {
			echo "failure\n";
			echo $filename;
		}
		return;
	}

	public function modeQueryOrders() {
		if (!isset($this->request->cookie['key'])) {
			echo "Cookie fail\n";
			return;
		}

		if ($this->request->cookie['key'] != md5($this->config->get('exchange1c_password'))) {
			echo "failure\n";
			echo "Session error";
			return;
		}

		$this->load->model('extension/exchange1c');

		$orders = $this->model_extension_exchange1c->queryOrders(array(
			 'from_date' 	=> $this->config->get('exchange1c_order_date')
			,'exchange_status'	=> $this->config->get('exchange1c_order_status_to_exchange')
			,'new_status'	=> $this->config->get('exchange1c_order_status')
			,'notify'		=> $this->config->get('exchange1c_order_notify')
			,'currency'		=> $this->config->get('exchange1c_order_currency') ? $this->config->get('exchange1c_order_currency') : 'руб.'
		));

		echo iconv('utf-8', 'cp1251', $orders);
	}

	/**
	 * Changing order statuses.
	 */
	public function modeOrdersChangeStatus(){
		if (!isset($this->request->cookie['key'])) {
			echo "Cookie fail\n";
			return;
		}

		if ($this->request->cookie['key'] != md5($this->config->get('exchange1c_password'))) {
			echo "failure\n";
			echo "Session error";
			return;
		}

		$this->load->model('extension/exchange1c');

		$result = $this->model_extension_exchange1c->queryOrdersStatus(array(
			'from_date' 		=> $this->config->get('exchange1c_order_date'),
			'exchange_status'	=> $this->config->get('exchange1c_order_status_to_exchange'),
			'new_status'		=> $this->config->get('exchange1c_order_status'),
			'notify'			=> $this->config->get('exchange1c_order_notify')
		));

		if($result){
			$this->load->model('setting/setting');
			$config = $this->model_setting_setting->getSetting('exchange1c');
			$config['exchange1c_order_date'] = date('Y-m-d H:i:s');
			$this->model_setting_setting->editSetting('exchange1c', $config);
		}

		if($result)
			echo "success\n";
		else
			echo "fail\n";
	}

	// -- Системные процедуры
	private function cleanCacheDir() {

		// Проверяем есть ли директория
		if (file_exists(DIR_CACHE . 'exchange1c')) {
			if (is_dir(DIR_CACHE . 'exchange1c')) {
				return $this->cleanDir(DIR_CACHE . 'exchange1c/');
			}
			else { 
				unlink(DIR_CACHE . 'exchange1c');
			}
		}

		mkdir (DIR_CACHE . 'exchange1c'); 

		return 0;
	}

	private function checkUploadFileTree($path, $curDir = null) {

		if (!$curDir) $curDir = DIR_CACHE . 'exchange1c/';

		foreach (explode('/', $path) as $name) {

			if (!$name) continue;

			if (file_exists($curDir . $name)) {
				if (is_dir( $curDir . $name)) {
					$curDir = $curDir . $name . '/';
					continue;
				}

				unlink ($curDir . $name);
			}

			mkdir ($curDir . $name );
			$curDir = $curDir . $name . '/';
		}
		
	}

	private function cleanDir($root, $self = false) {

		$dir = dir($root);

		while ($file = $dir->read()) {
			if ($file == '.' || $file == '..') continue;
			if (file_exists($root . $file)) {
				if (is_file($root . $file)) { unlink($root . $file); continue; }
				if (is_dir($root . $file)) { $this->cleanDir($root . $file . '/', true); continue; }
				var_dump ($file);	
			}
			var_dump($file);
		}

		if ($self) {
			if(file_exists($root) && is_dir($root)) {
				rmdir($root); return 0;
			}

			var_dump($root);
		}
		return 0;
	}

}