<?php
class ControllerProductProduct extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('product/product');



				if (isset($this->request->cookie['xds_viewed_products'])) {
					$xds_viewed_products = json_decode($this->request->cookie['xds_viewed_products'], true);
  				$xds_viewed_products[] = (int)$this->request->get['product_id'];
  			} else {
					$xds_viewed_products = array();
					$xds_viewed_products[] = (int)$this->request->get['product_id'];
  			}

        setcookie("xds_viewed_products", json_encode($xds_viewed_products), 0, '/');

				$this->load->model('setting/setting');
				$this->load->language('extension/module/frametheme/ft_global');

				$ft_settings = array();
				$ft_settings = $this->model_setting_setting->getSetting('theme_frame', $this->config->get('config_store_id'));
				$language_id = $this->config->get('config_language_id');

        if (isset($ft_settings['t1_high_definition_imgs']) && $ft_settings['t1_high_definition_imgs']){
    			$hd_imgs = $ft_settings['t1_high_definition_imgs'];
    		} else {
    			$hd_imgs = false;
    		}

        if (isset($ft_settings['t1_catalog_page_lazy']) && !empty($ft_settings['t1_catalog_page_lazy'])) {
					$data['catalog_page_lazy'] = $ft_settings['t1_catalog_page_lazy'];
				} else {
					$data['catalog_page_lazy'] = false;
				}

				if (isset($ft_settings['t1_product_short_description'])) {
					$data['show_short_description'] = $ft_settings['t1_product_short_description'];
				} else {
					$data['show_short_description'] = false;
				}

				if (isset($ft_settings['t1_product_short_attributes'])) {
					$data['show_short_attributes'] = $ft_settings['t1_product_short_attributes'];
				} else {
					$data['show_short_attributes'] = false;
				}

        if (isset($ft_settings['t1_product_short_attributes_limit'])) {
					$data['short_attributes_limit'] = $ft_settings['t1_product_short_attributes_limit'];
				} else {
					$data['short_attributes_limit'] = 5;
				}

				if (isset($ft_settings['t1_product_social_likes'])) {
					$data['show_social_likes'] = $ft_settings['t1_product_social_likes'];
				} else {
					$data['show_social_likes'] = false;
				}

        if (isset($ft_settings['t1_product_social_likes_code'])) {
					$data['social_likes_code'] = html_entity_decode($ft_settings['t1_product_social_likes_code'], ENT_QUOTES, 'UTF-8');
				} else {
					$data['social_likes_code'] = false;
				}

				if (isset($ft_settings['t1_related_product_position'])) {
					$data['related_product_position'] = $ft_settings['t1_related_product_position'];
				} else {
					$data['related_product_position'] = false;
				}

        if (isset($ft_settings['t1_related_product_buttons'])) {
					$data['related_product_buttons'] = $ft_settings['t1_related_product_buttons'];
				} else {
					$data['related_product_buttons'] = false;
				}

				if (isset($ft_settings['t1_product_add_images_limit'])) {
					$data['add_images_limit'] = $ft_settings['t1_product_add_images_limit'];
				} else {
					$data['add_images_limit'] = false;
				}

				if (isset($ft_settings['t1_stikers']) && !empty($ft_settings['t1_stikers'])) {
					$ft_stikers = $ft_settings['t1_stikers'];
				} else {
					$ft_stikers = array();
				}

        if (isset($ft_settings['t1_product_additional_fields']) && !empty($ft_settings['t1_product_additional_fields'])) {
					$additional_fields = $ft_settings['t1_product_additional_fields'];
				} else {
					$additional_fields = array('model');
				}

				if (isset($ft_settings['t1_buy_button_status']) && !empty($ft_settings['t1_buy_button_status'])) {
					$data['disable_btn_status'] = $ft_settings['t1_buy_button_status'];
				} else {
					$data['disable_btn_status'] = false;
				}

        if (isset($ft_settings['t1_fastorder_status']) && !empty($ft_settings['t1_fastorder_status'])) {
					$data['fastorder_status'] = $ft_settings['t1_fastorder_status'];
				} else {
					$data['fastorder_status'] = false;
				}

        if (isset($ft_settings['t1_qview_status']) && !empty($ft_settings['t1_qview_status'])) {
					$data['qview_status'] = $ft_settings['t1_qview_status'];
				} else {
					$data['qview_status'] = false;
				}

				if (isset($ft_settings['t1_buy_button_disabled_text'][$language_id]) && !empty($ft_settings['t1_buy_button_disabled_text'][$language_id])) {
					$data['disable_btn_text'] = $ft_settings['t1_buy_button_disabled_text'][$language_id];
				} else {
					$data['disable_btn_text'] = '';
				}

        if (isset($ft_settings['t1_extra_tab_status']) && !empty($ft_settings['t1_extra_tab_status'])) {
					$data['extra_tab_status'] = $ft_settings['t1_extra_tab_status'];
				} else {
					$data['extra_tab_status'] = false;
				}

        if (isset($ft_settings['t1_extra_tab_heading'][$language_id]) && !empty($ft_settings['t1_extra_tab_heading'][$language_id])) {
					$data['extra_tab_heading'] = $ft_settings['t1_extra_tab_heading'][$language_id];
				} else {
					$data['extra_tab_heading'] = '';
				}

        if (isset($ft_settings['t1_extra_tab_content'][$language_id]) && !empty($ft_settings['t1_extra_tab_content'][$language_id])) {
					$data['extra_tab_content'] = html_entity_decode($ft_settings['t1_extra_tab_content'][$language_id], ENT_QUOTES, 'UTF-8');
				} else {
					$data['extra_tab_content'] = '';
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

				$data['theme_dir'] = $this->config->get('theme_frame_directory');


        $data['reviews_array'] = $this->load->controller('extension/module/frametheme/ft_reviews_noajax', $this->request->get['product_id']);


      
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$this->load->model('catalog/category');

		if (isset($this->request->get['path'])) {
			$path = '';

			$parts = explode('_', (string)$this->request->get['path']);

			$category_id = (int)array_pop($parts);

			foreach ($parts as $path_id) {
				if (!$path) {
					$path = $path_id;
				} else {
					$path .= '_' . $path_id;
				}

				$category_info = $this->model_catalog_category->getCategory($path_id);

				if ($category_info) {
					$data['breadcrumbs'][] = array(
						'text' => $category_info['name'],
						'href' => $this->url->link('product/category', 'path=' . $path)
					);
				}
			}

			// Set the last category breadcrumb
			$category_info = $this->model_catalog_category->getCategory($category_id);

			if ($category_info) {
				$url = '';

				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}

				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}

				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}

				if (isset($this->request->get['limit'])) {
					$url .= '&limit=' . $this->request->get['limit'];
				}

				$data['breadcrumbs'][] = array(
					'text' => $category_info['name'],
					'href' => $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url)
				);
			}
		}

		$this->load->model('catalog/manufacturer');

		if (isset($this->request->get['manufacturer_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_brand'),
				'href' => $this->url->link('product/manufacturer')
			);

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($this->request->get['manufacturer_id']);

			if ($manufacturer_info) {
				$data['breadcrumbs'][] = array(
					'text' => $manufacturer_info['name'],
					'href' => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . $url)
				);
			}
		}

		if (isset($this->request->get['search']) || isset($this->request->get['tag'])) {
			$url = '';

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_search'),
				'href' => $this->url->link('product/search', $url)
			);
		}

		if (isset($this->request->get['product_id'])) {
			$product_id = (int)$this->request->get['product_id'];
		} else {
			$product_id = 0;
		}

		$this->load->model('catalog/product');

		$product_info = $this->model_catalog_product->getProduct($product_id);

		//check product page open from cateory page
		if (isset($this->request->get['path'])) {
			$parts = explode('_', (string)$this->request->get['path']);
						
			if(empty($this->model_catalog_product->checkProductCategory($product_id, $parts))) {
				$product_info = array();
			}
		}

		//check product page open from manufacturer page
		if (isset($this->request->get['manufacturer_id']) && !empty($product_info)) {
			if($product_info['manufacturer_id'] !=  $this->request->get['manufacturer_id']) {
				$product_info = array();
			}
		}

		if ($product_info) {


        $data['microdata_price_valid_until'] = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')));

        if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
  				$data['microdata_price'] = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency'], '', false);
  			} else {
  				$data['microdata_price'] = false;
  			}

  			if ((float)$product_info['special']) {
  				$data['microdata_special'] = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency'], '', false);

          $this->load->model('extension/theme/frame');

          $special_end_date = $this->model_extension_theme_frame->getSpecialEndDate($product_id);

          if ($special_end_date) {
            $data['microdata_price_valid_until'] = $special_end_date;
          }

  			} else {
  				$data['microdata_special'] = false;
  			}

        $data['microdata_currency'] = $this->session->data['currency'];

        $data['microdata_reviews_count'] = (int)$product_info['reviews'];

        $data['microdata_canonical_url'] = $this->url->link('product/product', 'product_id=' . $this->request->get['product_id']);

        $data['microdata_date_available'] = $product_info['date_available'];

      
			$url = '';

			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
			}

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $product_info['name'],
				'href' => $this->url->link('product/product', $url . '&product_id=' . $this->request->get['product_id'])
			);

			$this->document->setTitle($product_info['meta_title']);
			$this->document->setDescription($product_info['meta_description']);
			$this->document->setKeywords($product_info['meta_keyword']);

        if (!$this->config->get('config_review_status')) {
      

        if (!$this->config->get('config_review_status')) {
      
			$this->document->addLink($this->url->link('product/product', 'product_id=' . $this->request->get['product_id']), 'canonical');

        }
      

        }
      
			
    		$this->document->addScript('catalog/view/theme/' . $this->config->get('theme_frame_directory') . '/javascript/owl-carousel/owl.carousel.min.js');
      
			
				$this->document->addStyle('catalog/view/theme/' . $this->config->get('theme_frame_directory') . '/javascript/owl-carousel/owl.carousel.min.css');
      
			
				// removed by frame theme
      
			
				// removed by frame theme
      
			
				// removed by frame theme
      
			
				// removed by frame theme
      

			$data['heading_title'] = $product_info['name'];

			$data['text_minimum'] = sprintf($this->language->get('text_minimum'), $product_info['minimum']);
			$data['text_login'] = sprintf($this->language->get('text_login'), $this->url->link('account/login', '', true), $this->url->link('account/register', '', true));

			$this->load->model('catalog/review');

			$data['tab_review'] = sprintf($this->language->get('tab_review'), $product_info['reviews']);

			$data['product_id'] = (int)$this->request->get['product_id'];
			$data['manufacturer'] = $product_info['manufacturer'];
			$data['manufacturers'] = $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $product_info['manufacturer_id']);
			$data['model'] = $product_info['model'];
			$data['reward'] = $product_info['reward'];
			$data['points'] = $product_info['points'];
			$data['description'] = html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8');


        $delimiter = '<!--more-->';
        $split_description = explode($delimiter, html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8'), 2);

        if (count($split_description) > 1) {
          $data['short_description'] = html_entity_decode($split_description[0], ENT_QUOTES, 'UTF-8');
          $data['description'] = html_entity_decode($split_description[1], ENT_QUOTES, 'UTF-8');
        } else {
          $data['short_description'] = utf8_substr(trim(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8'))), 0, 300) . '...';
        }

				$data['quantity'] = $product_info['quantity'];
      

			if ($product_info['quantity'] <= 0) {
				$data['stock'] = $product_info['stock_status'];
			} elseif ($this->config->get('config_stock_display')) {
				$data['stock'] = $product_info['quantity'];
			} else {
				$data['stock'] = $this->language->get('text_instock');
			}

			$this->load->model('tool/image');

        if ($product_info['image'] && method_exists($this->document, 'setOgImage')) {
          $this->document->setOgImage($this->model_tool_image->resize($product_info['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_thumb_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_thumb_height')));
        }
      

			if ($product_info['image']) {
				$data['popup'] = $this->model_tool_image->resize($product_info['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_popup_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_popup_height'));
			} else {
				$data['popup'] = '';
			}

			if ($product_info['image']) {
				$data['thumb'] = $this->model_tool_image->resize($product_info['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_thumb_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_thumb_height'));
			} else {
				$data['thumb'] = '';
			}



        $data['additional_fields'] = array();

        if ($product_info['model'] && in_array('model', $additional_fields)) {
					$data['additional_fields']['model'] = array(
            'title' => $this->language->get('text_model'),
						'text'  => $product_info['model']
					);
				}

        if ($product_info['sku'] && in_array('sku', $additional_fields)) {
					$data['additional_fields']['sku'] = array(
            'title' => $this->language->get('g_text_sku'),
						'text'  => $product_info['sku']
					);
				}


        if ($product_info['upc'] && in_array('upc', $additional_fields) && !$ft_stikers['upc']['status']) {
					$data['additional_fields']['upc'] = array(
            'title' => $this->language->get('g_text_upc'),
						'text'  => $product_info['upc']
					);
				}

        if ($product_info['ean'] && in_array('ean', $additional_fields) && !$ft_stikers['ean']['status']) {
					$data['additional_fields']['ean'] = array(
            'title' => $this->language->get('g_text_ean'),
						'text'  => $product_info['ean']
					);
				}

        if ($product_info['jan'] && in_array('jan', $additional_fields) && !$ft_stikers['jan']['status']) {
					$data['additional_fields']['jan'] = array(
            'title' => $this->language->get('g_text_jan'),
						'text'  => $product_info['jan']
					);
				}

        if ($product_info['isbn'] && in_array('isbn', $additional_fields) && !$ft_stikers['isbn']['status']) {
					$data['additional_fields']['isbn'] = array(
            'title' => $this->language->get('g_text_isbn'),
						'text'  => $product_info['isbn']
					);
				}

        if ($product_info['mpn'] && in_array('mpn', $additional_fields) && !$ft_stikers['mpn']['status']) {
					$data['additional_fields']['mpn'] = array(
            'title' => $this->language->get('g_text_mpn'),
						'text'  => $product_info['mpn']
					);
				}

				$data['stickers'] = array();

				if ($product_info['price'] && $product_info['special'] && $ft_stikers['special']['status']) {
					$data['stickers']['special'] = array(
						'text'  => round(100 - ($product_info['special'] / $product_info['price']) * 100) * (-1) . '%',
						'class' => 'badge stiker-special'
					);
				}

				if ($product_info['upc'] && $ft_stikers['upc']['status']) {
					$data['stickers']['upc'] = array(
						'text'  => $product_info['upc'],
						'class' => 'badge stiker-upc'
					);
				}

				if ($product_info['ean'] && $ft_stikers['ean']['status']) {
					$data['stickers']['ean'] = array(
						'text'  => $product_info['ean'],
						'class' => 'badge stiker-ean'
					);
				}

				if ($product_info['jan'] && $ft_stikers['jan']['status']) {
					$data['stickers']['jan'] = array(
						'text'  => $product_info['jan'],
						'class' => 'badge stiker-jan'
					);
				}

				if ($product_info['isbn'] && $ft_stikers['isbn']['status']) {
					$data['stickers']['isbn'] = array(
						'text'  => $product_info['isbn'],
						'class' => 'badge stiker-isbn'
					);
				}

				if ($product_info['mpn'] && $ft_stikers['mpn']['status']) {
					$data['stickers']['mpn'] = array(
						'text'  => $product_info['mpn'],
						'class' => 'badge stiker-mpn'
					);
				}

				$data['bullets'] = array();

				$data['thumb_width'] = $this->config->get('theme_' . $this->config->get('config_theme') . '_image_thumb_width');
				$data['thumb_height'] = $this->config->get('theme_' . $this->config->get('config_theme') . '_image_thumb_height');

				$data['thumb_holder'] = $this->model_tool_image->resize('catalog/frametheme/src_holder.png', $data['thumb_width'], $data['thumb_height']);

				$data['popup_width'] = $this->config->get('theme_' . $this->config->get('config_theme') . '_image_popup_width');
				$data['popup_height'] = $this->config->get('theme_' . $this->config->get('config_theme') . '_image_popup_height');

				if ($product_info['image']) {
					$data['popup'] = $this->model_tool_image->resize($product_info['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_popup_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_popup_height'));
				} else {
					$data['popup'] = '';
				}

				if ($product_info['image']) {

					$data['bullets'][] = array(
            'img_width' => $this->config->get('theme_' . $this->config->get('config_theme') . '_image_additional_width') . 'px',
            'img_height' => $this->config->get('theme_' . $this->config->get('config_theme') . '_image_additional_height') . 'px',
						'img1x' => $this->model_tool_image->resize($product_info['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_additional_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_additional_height')),
						'img2x' => $hd_imgs ? $this->model_tool_image->resize($product_info['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_additional_width')*2, $this->config->get('theme_' . $this->config->get('config_theme') . '_image_additional_height')*2) : NULL,
						'img3x' => $hd_imgs ? $this->model_tool_image->resize($product_info['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_additional_width')*3, $this->config->get('theme_' . $this->config->get('config_theme') . '_image_additional_height')*3) : NULL,
						'img4x' => $hd_imgs ? $this->model_tool_image->resize($product_info['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_additional_width')*4, $this->config->get('theme_' . $this->config->get('config_theme') . '_image_additional_height')*4) : NULL
					);

					$data['thumb'] = $this->model_tool_image->resize($product_info['image'], $data['thumb_width'], $data['thumb_height']);

          if ($hd_imgs) {
            $data['thumb2x'] = $this->model_tool_image->resize($product_info['image'], $data['thumb_width']*2, $data['thumb_height']*2);
            $data['thumb3x'] = $this->model_tool_image->resize($product_info['image'], $data['thumb_width']*3, $data['thumb_height']*3);
            $data['thumb4x'] = $this->model_tool_image->resize($product_info['image'], $data['thumb_width']*4, $data['thumb_height']*4);
          }

				} else {
					$data['thumb'] = '';
				}

      
			$data['images'] = array();

			$results = $this->model_catalog_product->getProductImages($this->request->get['product_id']);

			foreach ($results as $result) {

				$data['bullets'][] = array(
          'img_width' => $this->config->get('theme_' . $this->config->get('config_theme') . '_image_additional_width') . 'px',
          'img_height' => $this->config->get('theme_' . $this->config->get('config_theme') . '_image_additional_height') . 'px',
					'img1x' => $this->model_tool_image->resize($result['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_additional_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_additional_height')),
					'img2x' => $hd_imgs ? $this->model_tool_image->resize($result['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_additional_width')*2, $this->config->get('theme_' . $this->config->get('config_theme') . '_image_additional_height')*2) : NULL,
					'img3x' => $hd_imgs ? $this->model_tool_image->resize($result['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_additional_width')*3, $this->config->get('theme_' . $this->config->get('config_theme') . '_image_additional_height')*3) : NULL,
					'img4x' => $hd_imgs ? $this->model_tool_image->resize($result['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_additional_width')*4, $this->config->get('theme_' . $this->config->get('config_theme') . '_image_additional_height')*4) : NULL
				);

      
				$data['images'][] = array(
					'popup' => $this->model_tool_image->resize($result['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_popup_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_popup_height')),
					
				'thumb' => $this->model_tool_image->resize($result['image'], $data['thumb_width'], $data['thumb_height']),
				'thumb2x' => $hd_imgs ? $this->model_tool_image->resize($result['image'], $data['thumb_width']*2, $data['thumb_height']*2) : NULL,
				'thumb3x' => $hd_imgs ? $this->model_tool_image->resize($result['image'], $data['thumb_width']*3, $data['thumb_height']*3) : NULL,
				'thumb4x' => $hd_imgs ? $this->model_tool_image->resize($result['image'], $data['thumb_width']*4, $data['thumb_height']*4) : NULL
      
				);
			}

			if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
				$data['price'] = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
			} else {
				$data['price'] = false;
			}

			if (!is_null($product_info['special']) && (float)$product_info['special'] >= 0) {
				$data['special'] = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				$tax_price = (float)$product_info['special'];
			} else {
				$data['special'] = false;
				$tax_price = (float)$product_info['price'];
			}

			if ($this->config->get('config_tax')) {
				$data['tax'] = $this->currency->format($tax_price, $this->session->data['currency']);
			} else {
				$data['tax'] = false;
			}

			$discounts = $this->model_catalog_product->getProductDiscounts($this->request->get['product_id']);

			$data['discounts'] = array();

			foreach ($discounts as $discount) {
				$data['discounts'][] = array(
					'quantity' => $discount['quantity'],
					'price'    => $this->currency->format($this->tax->calculate($discount['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency'])
				);
			}

			$data['options'] = array();

			foreach ($this->model_catalog_product->getProductOptions($this->request->get['product_id']) as $option) {
				$product_option_value_data = array();

				foreach ($option['product_option_value'] as $option_value) {
					if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
						if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value['price']) {
							$price = $this->currency->format($this->tax->calculate($option_value['price'], $product_info['tax_class_id'], $this->config->get('config_tax') ? 'P' : false), $this->session->data['currency']);
						} else {
							$price = false;
						}

						$product_option_value_data[] = array(

				'image2x'          => $hd_imgs ? $this->model_tool_image->resize($option_value['image'], 50*2, 50*2) : NULL,
				'image3x'          => $hd_imgs ? $this->model_tool_image->resize($option_value['image'], 50*3, 50*3) : NULL,
				'image4x'          => $hd_imgs ? $this->model_tool_image->resize($option_value['image'], 50*4, 50*4) : NULL,
      
							'product_option_value_id' => $option_value['product_option_value_id'],
							'option_value_id'         => $option_value['option_value_id'],
							'name'                    => $option_value['name'],
							'image'                   => $this->model_tool_image->resize($option_value['image'], 50, 50),
							'price'                   => $price,
							'price_prefix'            => $option_value['price_prefix']
						);
					}
				}

				$data['options'][] = array(
					'product_option_id'    => $option['product_option_id'],
					'product_option_value' => $product_option_value_data,
					'option_id'            => $option['option_id'],
					'name'                 => $option['name'],
					'type'                 => $option['type'],
					'value'                => $option['value'],
					'required'             => $option['required']
				);
			}

			if ($product_info['minimum']) {
				$data['minimum'] = $product_info['minimum'];
			} else {
				$data['minimum'] = 1;
			}

			$data['review_status'] = $this->config->get('config_review_status');

			if ($this->config->get('config_review_guest') || $this->customer->isLogged()) {
				$data['review_guest'] = true;
			} else {
				$data['review_guest'] = false;
			}

			if ($this->customer->isLogged()) {
				$data['customer_name'] = $this->customer->getFirstName() . '&nbsp;' . $this->customer->getLastName();
			} else {
				$data['customer_name'] = '';
			}

			$data['reviews'] = sprintf($this->language->get('text_reviews'), (int)$product_info['reviews']);
			$data['rating'] = (int)$product_info['rating'];

			// Captcha
			if ($this->config->get('captcha_' . $this->config->get('config_captcha') . '_status') && in_array('review', (array)$this->config->get('config_captcha_page'))) {
				$data['captcha'] = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha'));
			} else {
				$data['captcha'] = '';
			}

			$data['share'] = $this->url->link('product/product', 'product_id=' . (int)$this->request->get['product_id']);

			$data['attribute_groups'] = $this->model_catalog_product->getProductAttributes($this->request->get['product_id']);

			$data['products'] = array();

			$results = $this->model_catalog_product->getProductRelated($this->request->get['product_id']);

			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_height'));
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
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}



				if ($result['image']) {
          if ($hd_imgs) {
  					$image2x = $this->model_tool_image->resize($result['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_width')*2, $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_height')*2);
  					$image3x = $this->model_tool_image->resize($result['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_width')*3, $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_height')*3);
  					$image4x = $this->model_tool_image->resize($result['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_width')*4, $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_height')*4);
          }
				} else {
          if ($hd_imgs) {
  					$image2x = $this->model_tool_image->resize('placeholder.png', $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_width')*2, $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_height')*2);
  					$image3x = $this->model_tool_image->resize('placeholder.png', $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_width')*3, $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_height')*3);
  					$image4x = $this->model_tool_image->resize('placeholder.png', $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_width')*4, $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_height')*4);
          }
				}

				$stickers = array();

				if ($result['price'] && $result['special'] && $ft_stikers['special']['status']) {
					$stickers['special'] = array(
						'text'  => round(100 - ($result['special'] / $result['price']) * 100) * (-1) . '%',
						'class' => 'badge stiker-special'
					);
				}

				if ($result['upc'] && $ft_stikers['upc']['status']) {
					$stickers['upc'] = array(
						'text'  => $result['upc'],
						'class' => 'badge stiker-upc'
					);
				}

				if ($result['ean'] && $ft_stikers['ean']['status']) {
					$stickers['ean'] = array(
						'text'  => $result['ean'],
						'class' => 'badge stiker-ean'
					);
				}

				if ($result['jan'] && $ft_stikers['jan']['status']) {
					$stickers['jan'] = array(
						'text'  => $result['jan'],
						'class' => 'badge stiker-jan'
					);
				}

				if ($result['isbn'] && $ft_stikers['isbn']['status']) {
					$stickers['isbn'] = array(
						'text'  => $result['isbn'],
						'class' => 'badge stiker-isbn'
					);
				}

				if ($result['mpn'] && $ft_stikers['mpn']['status']) {
					$stickers['mpn'] = array(
						'text'  => $result['mpn'],
						'class' => 'badge stiker-mpn'
					);
				}
      
				$data['products'][] = array(

        'img_width'    => $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_width') . 'px',
        'img_height'   => $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_height') . 'px',
        'thumb_holder'    => $this->model_tool_image->resize('catalog/frametheme/src_holder.png', $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_height')),
				'thumb2x'         => $hd_imgs ? $image2x : NULL,
				'thumb3x'         => $hd_imgs ? $image3x : NULL,
				'thumb4x'         => $hd_imgs ? $image4x : NULL,
				'stickers'  			=> $stickers,
        'quantity'        => $result['quantity'],
      
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(trim(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'))), 0, $this->config->get('theme_' . $this->config->get('config_theme') . '_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
					'rating'      => $rating,
					'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'])
				);
			}

			$data['tags'] = array();

			if ($product_info['tag']) {
				$tags = explode(',', $product_info['tag']);

				foreach ($tags as $tag) {
					$data['tags'][] = array(
						'tag'  => trim($tag),
						'href' => $this->url->link('product/search', 'tag=' . trim($tag))
					);
				}
			}

			$data['recurrings'] = $this->model_catalog_product->getProfiles($this->request->get['product_id']);

			$this->model_catalog_product->updateViewed($this->request->get['product_id']);
			
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');

        $data['ft_additional_position1'] = $this->load->controller('extension/module/frametheme/ft_additional_position1');
				$data['ft_additional_position2'] = $this->load->controller('extension/module/frametheme/ft_additional_position2');
				$data['ft_additional_position3'] = $this->load->controller('extension/module/frametheme/ft_additional_position3');
				$data['ft_additional_position4'] = $this->load->controller('extension/module/frametheme/ft_additional_position4');
				$data['ft_additional_position5'] = $this->load->controller('extension/module/frametheme/ft_additional_position5');
				$data['ft_additional_position6'] = $this->load->controller('extension/module/frametheme/ft_additional_position6');
      
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('product/product', $data));
		} else {
			$url = '';

			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
			}

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('product/product', $url . '&product_id=' . $product_id)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['continue'] = $this->url->link('common/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');

        $data['ft_additional_position1'] = $this->load->controller('extension/module/frametheme/ft_additional_position1');
				$data['ft_additional_position2'] = $this->load->controller('extension/module/frametheme/ft_additional_position2');
				$data['ft_additional_position3'] = $this->load->controller('extension/module/frametheme/ft_additional_position3');
				$data['ft_additional_position4'] = $this->load->controller('extension/module/frametheme/ft_additional_position4');
				$data['ft_additional_position5'] = $this->load->controller('extension/module/frametheme/ft_additional_position5');
				$data['ft_additional_position6'] = $this->load->controller('extension/module/frametheme/ft_additional_position6');
      
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('error/not_found', $data));
		}
	}

	public function review() {
		$this->load->language('product/product');

		$this->load->model('catalog/review');

		if (isset($this->request->get['page'])) {
			$page = (int)$this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['reviews'] = array();

		$review_total = $this->model_catalog_review->getTotalReviewsByProductId($this->request->get['product_id']);

		$results = $this->model_catalog_review->getReviewsByProductId($this->request->get['product_id'], ($page - 1) * 5, 5);

		foreach ($results as $result) {
			$data['reviews'][] = array(
				'author'     => $result['author'],
				'text'       => nl2br($result['text']),
				'rating'     => (int)$result['rating'],
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}

		$pagination = new Pagination();

				$pagination = new Pagination_ft(5);
      
		$pagination->total = $review_total;
		$pagination->page = $page;
		$pagination->limit = 5;
		$pagination->url = $this->url->link('product/product/review', 'product_id=' . $this->request->get['product_id'] . '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($review_total) ? (($page - 1) * 5) + 1 : 0, ((($page - 1) * 5) > ($review_total - 5)) ? $review_total : ((($page - 1) * 5) + 5), $review_total, ceil($review_total / 5));

		$this->response->setOutput($this->load->view('product/review', $data));
	}

	public function write() {
		$this->load->language('product/product');

		$json = array();

		if (isset($this->request->get['product_id']) && $this->request->get['product_id']) {
			if ($this->request->server['REQUEST_METHOD'] == 'POST') {
				if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 25)) {
					$json['error'] = $this->language->get('error_name');
				}

				if ((utf8_strlen($this->request->post['text']) < 25) || (utf8_strlen($this->request->post['text']) > 1000)) {
					$json['error'] = $this->language->get('error_text');
				}
			
				if (empty($this->request->post['rating']) || $this->request->post['rating'] < 0 || $this->request->post['rating'] > 5) {
					$json['error'] = $this->language->get('error_rating');
				}

				// Captcha
				if ($this->config->get('captcha_' . $this->config->get('config_captcha') . '_status') && in_array('review', (array)$this->config->get('config_captcha_page'))) {
					$captcha = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha') . '/validate');

					if ($captcha) {
						$json['error'] = $captcha;
					}
				}

				if (!isset($json['error'])) {
					$this->load->model('catalog/review');

					$this->model_catalog_review->addReview($this->request->get['product_id'], $this->request->post);

					$json['success'] = $this->language->get('text_success');
				}
			}
		} else {
			$json['error'] = $this->language->get('error_product');
		} 

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getRecurringDescription() {
		$this->load->language('product/product');
		$this->load->model('catalog/product');

		if (isset($this->request->post['product_id'])) {
			$product_id = $this->request->post['product_id'];
		} else {
			$product_id = 0;
		}

		if (isset($this->request->post['recurring_id'])) {
			$recurring_id = $this->request->post['recurring_id'];
		} else {
			$recurring_id = 0;
		}

		if (isset($this->request->post['quantity'])) {
			$quantity = $this->request->post['quantity'];
		} else {
			$quantity = 1;
		}

		$product_info = $this->model_catalog_product->getProduct($product_id);
		
		$recurring_info = $this->model_catalog_product->getProfile($product_id, $recurring_id);

		$json = array();

		if ($product_info && $recurring_info) {
			if (!$json) {
				$frequencies = array(
					'day'        => $this->language->get('text_day'),
					'week'       => $this->language->get('text_week'),
					'semi_month' => $this->language->get('text_semi_month'),
					'month'      => $this->language->get('text_month'),
					'year'       => $this->language->get('text_year'),
				);

				if ($recurring_info['trial_status'] == 1) {
					$price = $this->currency->format($this->tax->calculate($recurring_info['trial_price'] * $quantity, $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
					$trial_text = sprintf($this->language->get('text_trial_description'), $price, $recurring_info['trial_cycle'], $frequencies[$recurring_info['trial_frequency']], $recurring_info['trial_duration']) . ' ';
				} else {
					$trial_text = '';
				}

				$price = $this->currency->format($this->tax->calculate($recurring_info['price'] * $quantity, $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);

				if ($recurring_info['duration']) {
					$text = $trial_text . sprintf($this->language->get('text_payment_description'), $price, $recurring_info['cycle'], $frequencies[$recurring_info['frequency']], $recurring_info['duration']);
				} else {
					$text = $trial_text . sprintf($this->language->get('text_payment_cancel'), $price, $recurring_info['cycle'], $frequencies[$recurring_info['frequency']], $recurring_info['duration']);
				}

				$json['success'] = $text;
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
