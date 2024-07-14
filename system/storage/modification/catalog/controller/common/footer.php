<?php
class ControllerCommonFooter extends Controller {
	public function index() {
		$this->load->language('common/footer');

		$this->load->model('catalog/information');

		$data['informations'] = array();

		foreach ($this->model_catalog_information->getInformations() as $result) {
			if ($result['bottom']) {
				$data['informations'][] = array(
					'title' => $result['title'],
					'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
				);
			}
		}

		$data['contact'] = $this->url->link('information/contact');
		$data['return'] = $this->url->link('account/return/add', '', true);
		$data['sitemap'] = $this->url->link('information/sitemap');
		$data['tracking'] = $this->url->link('information/tracking');
		$data['manufacturer'] = $this->url->link('product/manufacturer');
		$data['voucher'] = $this->url->link('account/voucher', '', true);
		$data['affiliate'] = $this->url->link('affiliate/login', '', true);
		$data['special'] = $this->url->link('product/special');
		$data['account'] = $this->url->link('account/account', '', true);
		$data['order'] = $this->url->link('account/order', '', true);
		$data['wishlist'] = $this->url->link('account/wishlist', '', true);
		$data['newsletter'] = $this->url->link('account/newsletter', '', true);

		$data['powered'] = sprintf($this->language->get('text_powered'), $this->config->get('config_name'), date('Y', time()));

		// Whos Online
		if ($this->config->get('config_customer_online')) {
			$this->load->model('tool/online');

			if (isset($this->request->server['REMOTE_ADDR'])) {
				$ip = $this->request->server['REMOTE_ADDR'];
			} else {
				$ip = '';
			}

			if (isset($this->request->server['HTTP_HOST']) && isset($this->request->server['REQUEST_URI'])) {
				$url = ($this->request->server['HTTPS'] ? 'https://' : 'http://') . $this->request->server['HTTP_HOST'] . $this->request->server['REQUEST_URI'];
			} else {
				$url = '';
			}

			if (isset($this->request->server['HTTP_REFERER'])) {
				$referer = $this->request->server['HTTP_REFERER'];
			} else {
				$referer = '';
			}

			$this->model_tool_online->addOnline($ip, $this->customer->getId(), $url, $referer);
		}


				$this->load->model('setting/setting');

				$ft_settings = array();
				$ft_settings = $this->model_setting_setting->getSetting('theme_frame', $this->config->get('config_store_id'));

				if (isset($ft_settings['t1_cust_code_bottom']) && !empty($ft_settings['t1_cust_code_bottom'])) {
					$data['cust_code'] = html_entity_decode($ft_settings['t1_cust_code_bottom'], ENT_QUOTES, 'UTF-8');
				} else {
					$data['cust_code'] = '';
				}

        if (isset($ft_settings['t1_version']) && !empty($ft_settings['t1_version']) && isset($ft_settings['t1_show_version']) && !empty($ft_settings['t1_show_version'])) {
					$data['theme_version'] = '?v=' . $ft_settings['t1_version'];
				} else {
					$data['theme_version'] = false;
				}

        if (isset($ft_settings['t1_livesearch_toggle']) && $ft_settings['t1_livesearch_toggle']){
          $data['livesearch'] = true;
    		}

        $data['theme_dir'] 	= $this->config->get('theme_frame_directory');

				$data['ft_fmap'] 	 = $this->load->controller('extension/module/frametheme/ft_fmap');
				$data['ft_footer'] = $this->load->controller('extension/module/frametheme/ft_footer');
				$data['ft_modal'] = $this->load->controller('extension/module/frametheme/ft_modal');
      
		$data['scripts'] = $this->document->getScripts('footer');
		$data['styles'] = $this->document->getStyles('footer');
		
		return $this->load->view('common/footer', $data);
	}
}
