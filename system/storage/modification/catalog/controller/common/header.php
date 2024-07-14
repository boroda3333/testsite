<?php
class ControllerCommonHeader extends Controller {
	public function index() {
		// Analytics
		$this->load->model('setting/extension');

				$data['theme_dir'] 	= $this->config->get('theme_frame_directory');
				$data['ft_logo']		= $this->load->controller('extension/module/frametheme/ft_logo');
				$data['ft_menu']		= $this->load->controller('extension/module/frametheme/ft_menu');
				$data['ft_cart']		= $this->load->controller('extension/module/frametheme/ft_cart');
				$data['ft_hlinks'] 	= $this->load->controller('extension/module/frametheme/ft_hlinks');
				$data['ft_links'] 	= $this->load->controller('extension/module/frametheme/ft_links');
				$data['ft_search']	 = $this->load->controller('extension/module/frametheme/ft_search');
				$data['ft_contacts'] = $this->load->controller('extension/module/frametheme/ft_contacts');
      

		$data['analytics'] = array();

		$analytics = $this->model_setting_extension->getExtensions('analytics');

		foreach ($analytics as $analytic) {
			if ($this->config->get('analytics_' . $analytic['code'] . '_status')) {
				$data['analytics'][] = $this->load->controller('extension/analytics/' . $analytic['code'], $this->config->get('analytics_' . $analytic['code'] . '_status'));
			}
		}

		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$this->document->addLink($server . 'image/' . $this->config->get('config_icon'), 'icon');
		}

		$data['title'] = $this->document->getTitle();

		$data['base'] = $server;
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts('header');
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');

		$data['name'] = $this->config->get('config_name');

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}

		$this->load->language('common/header');

      	$data['x_http_accept'] = $_SERVER['HTTP_ACCEPT'];
      
				$this->load->language('extension/module/frametheme/ft_global');
				$data['g_text_compare'] = sprintf($this->language->get('g_text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
				$data['link_compare'] = $this->url->link('product/compare', '', true);

				$this->load->model('setting/setting');

        $data['site_dir'] = substr(dirname($_SERVER['SCRIPT_NAME']),1);

				$ft_settings = array();
				$ft_settings = $this->model_setting_setting->getSetting('theme_frame', $this->config->get('config_store_id'));

        if (isset($ft_settings['t1_minify_request']) && !empty($ft_settings['t1_minify_request'])) {
					$data['minify'] = $ft_settings['t1_minify_request'];
				} else {
					$data['minify'] = false;
				}

        if (isset($ft_settings['t1_version']) && !empty($ft_settings['t1_version']) && isset($ft_settings['t1_show_version']) && !empty($ft_settings['t1_show_version'])) {
					$data['theme_version'] = '?v=' . $ft_settings['t1_version'];
				} else {
					$data['theme_version'] = '';
				}

        if (isset($ft_settings['t1_meta_theme_color']) && !empty($ft_settings['t1_meta_theme_color'])) {
					$data['meta_theme_color'] = $ft_settings['t1_meta_theme_color'];
				} else {
					$data['meta_theme_color'] = false;
				}

        if (isset($ft_settings['t1_webfont_status']) && !empty($ft_settings['t1_webfont_status'])) {
					$data['webfont'] = $ft_settings['t1_webfont_status'];
				} else {
					$data['webfont'] = false;
				}

        if (isset($ft_settings['t1_webfont_link']) && !empty($ft_settings['t1_webfont_link'])) {
					$data['webfont_link'] = html_entity_decode($ft_settings['t1_webfont_link'], ENT_QUOTES, 'UTF-8');
				} else {
					$data['webfont_link'] = false;
				}

        if (isset($ft_settings['t1_webfont_style']) && !empty($ft_settings['t1_webfont_style'])) {
					$data['webfont_style'] = html_entity_decode($ft_settings['t1_webfont_style'], ENT_QUOTES, 'UTF-8');
				} else {
					$data['webfont_style'] = false;
				}

				if (isset($ft_settings['t1_fontawesome_status']) && !empty($ft_settings['t1_fontawesome_status'])) {
					$data['fontawesome'] = $ft_settings['t1_fontawesome_status'];
				} else {
					$data['fontawesome'] = false;
				}

        if (isset($ft_settings['t1_cust_code_top']) && !empty($ft_settings['t1_cust_code_top'])) {
					$data['cust_code'] = html_entity_decode($ft_settings['t1_cust_code_top'], ENT_QUOTES, 'UTF-8');
				} else {
					$data['cust_code'] = '';
				}

				if (isset($ft_settings['t1_stikers']) && !empty($ft_settings['t1_stikers'])) {
					$data['stikers'] = $ft_settings['t1_stikers'];
				} else {
					$data['stikers'] = array();
				}

				if (isset($ft_settings['t1_preloader_status']) && !empty($ft_settings['t1_preloader_status'])) {
					$data['preloader_status'] = $ft_settings['t1_preloader_status'];
				} else {
					$data['preloader_status'] = false;
				}

				if (isset($ft_settings['t1_preloader_color']) && !empty($ft_settings['t1_preloader_color'])) {
					$data['preloader_color'] = $ft_settings['t1_preloader_color'];
				} else {
					$data['preloader_color'] = '';
				}

				if (isset($ft_settings['t1_preload_ss']) && !empty($ft_settings['t1_preload_ss'])) {
					$data['preload_ss'] = $ft_settings['t1_preload_ss'];
				} else {
					$data['preload_ss'] = false;
				}

				if (isset($ft_settings['t1_preloader_type']) && !empty($ft_settings['t1_preloader_type'])) {
					$data['preloader_type'] = $ft_settings['t1_preloader_type'];
				} else {
					$data['preloader_type'] = '';
				}

				if (isset($ft_settings['t1_preloader_timeout']) && !empty($ft_settings['t1_preloader_timeout'])) {
					$data['preloader_timeout'] = $ft_settings['t1_preloader_timeout'];
				} else {
					$data['preloader_timeout'] = 0;
				}

        if (isset($ft_settings['t1_catalog_mode']) && !empty($ft_settings['t1_catalog_mode'])) {
					$data['catalog_mode'] = $ft_settings['t1_catalog_mode'];
				} else {
					$data['catalog_mode'] = false;
				}

        if (isset($ft_settings['t1_wishlist_status']) && !empty($ft_settings['t1_wishlist_status'])) {
					$data['wishlist_status'] = $ft_settings['t1_wishlist_status'];
				} else {
					$data['wishlist_status'] = false;
				}

        if (isset($ft_settings['t1_compare_status']) && !empty($ft_settings['t1_compare_status'])) {
					$data['compare_status'] = $ft_settings['t1_compare_status'];
				} else {
					$data['compare_status'] = false;
				}

        if (isset($ft_settings['t1_add_cart_action']) && !empty($ft_settings['t1_add_cart_action'])) {
					$data['toasts'] = $ft_settings['t1_add_cart_action'];
				} else {
					$data['toasts'] = false;
				}

        if (is_file(DIR_APPLICATION . 'view/theme/' .  $this->config->get('theme_frame_directory') . '/stylesheet/custom.css')) {
          $data['cust_css'] = true;
        } else {
          $data['cust_css'] = false;
        }


        $detect = new Mobile_Detect;

    		$data['isMobile'] = $detect->isMobile() or $detect->isTablet();

      

		// Wishlist
		if ($this->customer->isLogged()) {
			$this->load->model('account/wishlist');

			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), $this->model_account_wishlist->getTotalWishlist());

				$data['text_wishlist'] = sprintf($this->language->get('g_text_wishlist'), $this->model_account_wishlist->getTotalWishlist());
      
		} else {
			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));

				$data['text_wishlist'] = sprintf($this->language->get('g_text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
      
		}

		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', true), $this->customer->getFirstName(), $this->url->link('account/logout', '', true));
		
		$data['home'] = $this->url->link('common/home');
		$data['wishlist'] = $this->url->link('account/wishlist', '', true);
		$data['logged'] = $this->customer->isLogged();
		$data['account'] = $this->url->link('account/account', '', true);
		$data['register'] = $this->url->link('account/register', '', true);
		$data['login'] = $this->url->link('account/login', '', true);
		$data['order'] = $this->url->link('account/order', '', true);
		$data['transaction'] = $this->url->link('account/transaction', '', true);
		$data['download'] = $this->url->link('account/download', '', true);
		$data['logout'] = $this->url->link('account/logout', '', true);
		$data['shopping_cart'] = $this->url->link('checkout/cart');
		$data['checkout'] = $this->url->link('checkout/checkout', '', true);
		$data['contact'] = $this->url->link('information/contact');
		$data['telephone'] = $this->config->get('config_telephone');
		
		$data['language'] = $this->load->controller('common/language');
		$data['currency'] = $this->load->controller('common/currency');
		$data['search'] = $this->load->controller('common/search');
		$data['cart'] = $this->load->controller('common/cart');
		$data['menu'] = $this->load->controller('common/menu');

		return $this->load->view('common/header', $data);
	}
}
