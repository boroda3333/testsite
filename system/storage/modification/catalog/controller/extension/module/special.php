<?php
class ControllerExtensionModuleSpecial extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/special');

		$this->load->model('catalog/product');

				$this->load->language('extension/module/frametheme/ft_global');
				$this->load->model('setting/setting');

				$ft_settings = array();
				$ft_settings = $this->model_setting_setting->getSetting('theme_frame', $this->config->get('config_store_id'));
				$language_id = $this->config->get('config_language_id');

        if (isset($ft_settings['t1_high_definition_imgs']) && $ft_settings['t1_high_definition_imgs']){
    			$hd_imgs = $ft_settings['t1_high_definition_imgs'];
    		} else {
    			$hd_imgs = false;
    		}

				if (isset($ft_settings['t1_qview_status']) && !empty($ft_settings['t1_qview_status'])) {
					$data['qview_status'] = $ft_settings['t1_qview_status'];
				} else {
					$data['qview_status'] = false;
				}

				if (isset($ft_settings['t1_fastorder_status']) && !empty($ft_settings['t1_fastorder_status'])) {
					$data['fastorder_status'] = $ft_settings['t1_fastorder_status'];
				} else {
					$data['fastorder_status'] = false;
				}

				if (isset($ft_settings['t1_buy_button_status']) && !empty($ft_settings['t1_buy_button_status'])) {
					$data['disable_btn_status'] = $ft_settings['t1_buy_button_status'];
				} else {
					$data['disable_btn_status'] = false;
				}

				if (isset($ft_settings['t1_buy_button_disabled_text'][$language_id]) && !empty($ft_settings['t1_buy_button_disabled_text'][$language_id])) {
					$data['disable_btn_text'] = $ft_settings['t1_buy_button_disabled_text'][$language_id];
				} else {
					$data['disable_btn_text'] = '';
				}

        if (isset($ft_settings['t1_catalog_mode']) && !empty($ft_settings['t1_catalog_mode'])) {
          $data['catalog_mode'] = $ft_settings['t1_catalog_mode'];
        } else {
          $data['catalog_mode'] = false;
        }

        if (isset($ft_settings['t1_catalog_mode_hide_price']) && !empty($ft_settings['t1_catalog_mode_hide_price'])) {
          $data['hide_price'] = $ft_settings['t1_catalog_mode_hide_price'];
        } else {
          $data['hide_price'] = false;
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

      

		$this->load->model('tool/image');

		$data['products'] = array();

		$filter_data = array(
			'sort'  => 'pd.name',
			'order' => 'ASC',
			'start' => 0,
			'limit' => $setting['limit']
		);

		$results = $this->model_catalog_product->getProductSpecials($filter_data);

		if ($results) {
			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height']);

        if ($hd_imgs) {
          $image2x = $this->model_tool_image->resize($result['image'], $setting['width']*2, $setting['height']*2);
          $image3x = $this->model_tool_image->resize($result['image'], $setting['width']*3, $setting['height']*3);
          $image4x = $this->model_tool_image->resize($result['image'], $setting['width']*4, $setting['height']*4);
        }
      
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
				}

				if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$price = false;
				}

				if (!is_null($result['special']) && (float)$result['special'] >= 0) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
					$tax_price = (float)$result['special'];
				} else {
					$special = false;
					$tax_price = (float)$result['price'];
				}
	
				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format($tax_price, $this->session->data['currency']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = $result['rating'];
				} else {
					$rating = false;
				}

				$data['products'][] = array(

        'quantity'     => $result['quantity'],
        'img_width'    => $setting['width'] . 'px',
        'img_height'    => $setting['height'] . 'px',
      

        'thumb2x' => $hd_imgs && isset($image2x) ? $image2x : NULL,
				'thumb3x' => $hd_imgs && isset($image3x) ? $image3x : NULL,
				'thumb4x' => $hd_imgs && isset($image4x) ? $image4x : NULL,
      
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(trim(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'))), 0, $this->config->get('theme_' . $this->config->get('config_theme') . '_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'rating'      => $rating,
					'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'])
				);
			}

			return $this->load->view('extension/module/special', $data);
		}
	}
}