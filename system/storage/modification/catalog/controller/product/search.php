<?php
class ControllerProductSearch extends Controller {
	public function index() {
		$this->load->language('product/search');

		$this->load->model('catalog/category');

		$this->load->model('catalog/product');


				$this->load->language('extension/module/frametheme/ft_global');

				function ft_plural($number, $text_arr) {
					$cases = array (2, 0, 1, 1, 1, 2);
					$text = $number . ' ' . $text_arr[ ($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)] ];
					return $text;
				}

				$data['review_status'] = $this->config->get('config_review_status');

				$this->load->model('setting/setting');

				$ft_settings = array();
				$ft_settings = $this->model_setting_setting->getSetting('theme_frame', $this->config->get('config_store_id'));
				$language_id = $this->config->get('config_language_id');

        if (isset($ft_settings['t1_high_definition_imgs']) && $ft_settings['t1_high_definition_imgs']){
    			$hd_imgs = $ft_settings['t1_high_definition_imgs'];
    		} else {
    			$hd_imgs = false;
    		}

				if (isset($this->request->get['route'])) {
					$route = $this->request->get['route'];
				} else {
					$route = 'common/home';
				}

				if (isset($ft_settings['t1_category_shown_pages']) && !empty($ft_settings['t1_category_shown_pages'])) {
					$shown_menu_routes = $ft_settings['t1_category_shown_pages'];
				} else {
					$shown_menu_routes = array('product/category', 'common/home');
				}

				if (isset($ft_settings['t1_category_description_position']) && !empty($ft_settings['t1_category_description_position'])) {
					$data['description_position'] = $ft_settings['t1_category_description_position'];
				} else {
					$data['description_position'] = false;
				}

        if (isset($ft_settings['t1_sub_cat_img_status']) && !empty($ft_settings['t1_sub_cat_img_status'])) {
					$data['sub_cat_img_status'] = $ft_settings['t1_sub_cat_img_status'];
				} else {
					$data['sub_cat_img_status'] = false;
				}

        if (isset($ft_settings['t1_catalog_page_lazy']) && !empty($ft_settings['t1_catalog_page_lazy'])) {
					$data['catalog_page_lazy'] = $ft_settings['t1_catalog_page_lazy'];
				} else {
					$data['catalog_page_lazy'] = false;
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

				if (isset($ft_settings['t1_stikers']) && !empty($ft_settings['t1_stikers'])) {
					$ft_stikers = $ft_settings['t1_stikers'];
				} else {
					$ft_stikers = array();
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

        if (isset($ft_settings['t1_view_default']) && !empty($ft_settings['t1_view_default'])) {
					$data['view_default'] = $ft_settings['t1_view_default'];
				} else {
					$data['view_default'] = 'grid';
				}

        if (isset($ft_settings['t1_catalog_stok_status']) && !empty($ft_settings['t1_catalog_stok_status'])) {
					$data['catalog_stok_status'] = $ft_settings['t1_catalog_stok_status'];
				} else {
					$data['catalog_stok_status'] = false;
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

        if (isset($ft_settings['t1_product_additional_fields_catalog']) && !empty($ft_settings['t1_product_additional_fields_catalog'])) {
					$additional_fields_catalog = $ft_settings['t1_product_additional_fields_catalog'];
				} else {
					$additional_fields_catalog = array();
				}

				$data['menu_open'] = false;

				if (in_array($route, $shown_menu_routes)) {
					$data['menu_open'] = true;
				}

      
		$this->load->model('tool/image');

		if (isset($this->request->get['search'])) {
			$search = $this->request->get['search'];
		} else {
			$search = '';
		}

		if (isset($this->request->get['tag'])) {
			$tag = $this->request->get['tag'];
		} elseif (isset($this->request->get['search'])) {
			$tag = $this->request->get['search'];
		} else {
			$tag = '';
		}

		if (isset($this->request->get['description'])) {
			$description = $this->request->get['description'];
		} else {
			$description = '';
		}

		if (isset($this->request->get['category_id'])) {
			$category_id = $this->request->get['category_id'];
		} else {
			$category_id = 0;
		}

		if (isset($this->request->get['sub_category'])) {
			$sub_category = $this->request->get['sub_category'];
		} else {
			$sub_category = '';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.sort_order';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = (int)$this->request->get['page'];
		} else {
			$page = 1;
		}

		if (isset($this->request->get['limit'])) {
			$limit = (int)$this->request->get['limit'];
		} else {
			$limit = $this->config->get('theme_' . $this->config->get('config_theme') . '_product_limit');
		}

		if (isset($this->request->get['search'])) {
			$this->document->setTitle($this->language->get('heading_title') .  ' - ' . $this->request->get['search']);
		} elseif (isset($this->request->get['tag'])) {
			$this->document->setTitle($this->language->get('heading_title') .  ' - ' . $this->language->get('heading_tag') . $this->request->get['tag']);
		} else {
			$this->document->setTitle($this->language->get('heading_title'));
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$url = '';

		if (isset($this->request->get['search'])) {
			$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['tag'])) {
			$url .= '&tag=' . urlencode(html_entity_decode($this->request->get['tag'], ENT_QUOTES, 'UTF-8'));
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
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('product/search', $url)
		);

		if (isset($this->request->get['search'])) {
			$data['heading_title'] = $this->language->get('heading_title') .  ' - ' . $this->request->get['search'];
		} else {
			$data['heading_title'] = $this->language->get('heading_title');
		}

		$data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));

		$data['compare'] = $this->url->link('product/compare');

		// 3 Level Category Search
		$data['categories'] = array();

		$categories_1 = $this->model_catalog_category->getCategories(0);

		foreach ($categories_1 as $category_1) {
			$level_2_data = array();

			$categories_2 = $this->model_catalog_category->getCategories($category_1['category_id']);

			foreach ($categories_2 as $category_2) {
				$level_3_data = array();

				$categories_3 = $this->model_catalog_category->getCategories($category_2['category_id']);

				foreach ($categories_3 as $category_3) {
					$level_3_data[] = array(
						'category_id' => $category_3['category_id'],
						'name'        => $category_3['name'],
					);
				}

				$level_2_data[] = array(
					'category_id' => $category_2['category_id'],
					'name'        => $category_2['name'],
					'children'    => $level_3_data
				);
			}

			$data['categories'][] = array(
				'category_id' => $category_1['category_id'],
				'name'        => $category_1['name'],
				'children'    => $level_2_data
			);
		}

		$data['products'] = array();

		if (isset($this->request->get['search']) || isset($this->request->get['tag'])) {
			$filter_data = array(
				'filter_name'         => $search,
				'filter_tag'          => $tag,
				'filter_description'  => $description,
				'filter_category_id'  => $category_id,
				'filter_sub_category' => $sub_category,
				'sort'                => $sort,
				'order'               => $order,
				'start'               => ($page - 1) * $limit,
				'limit'               => $limit
			);

			$product_total = $this->model_catalog_product->getTotalProducts($filter_data);

			$results = $this->model_catalog_product->getProducts($filter_data);

			foreach ($results as $result) {

				if ($result['image']) {
          if ($hd_imgs) {
  					$image2x = $this->model_tool_image->resize($result['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_width')*2, $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_height')*2);
  					$image3x = $this->model_tool_image->resize($result['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_width')*3, $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_height')*3);
  					$image4x = $this->model_tool_image->resize($result['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_width')*4, $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_height')*4);
          }
				} else {
          if ($hd_imgs) {
  					$image2x = $this->model_tool_image->resize('placeholder.png', $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_width')*2, $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_height')*2);
  					$image3x = $this->model_tool_image->resize('placeholder.png', $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_width')*3, $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_height')*3);
  					$image4x = $this->model_tool_image->resize('placeholder.png', $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_width')*4, $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_height')*4);
          }
				}
      
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_height'));
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




        $additional_fields = array();

        if ($result['model'] && in_array('model', $additional_fields_catalog)) {
					$additional_fields['model'] = array(
            'title' => $this->language->get('text_model'),
						'text'  => $result['model']
					);
				}

        if ($result['sku'] && in_array('sku', $additional_fields_catalog)) {
					$additional_fields['sku'] = array(
            'title' => $this->language->get('g_text_sku'),
						'text'  => $result['sku']
					);
				}


        if ($result['upc'] && in_array('upc', $additional_fields_catalog) && !$ft_stikers['upc']['status']) {
					$additional_fields['upc'] = array(
            'title' => $this->language->get('g_text_upc'),
						'text'  => $result['upc']
					);
				}

        if ($result['ean'] && in_array('ean', $additional_fields_catalog) && !$ft_stikers['ean']['status']) {
					$additional_fields['ean'] = array(
            'title' => $this->language->get('g_text_ean'),
						'text'  => $result['ean']
					);
				}

        if ($result['jan'] && in_array('jan', $additional_fields_catalog) && !$ft_stikers['jan']['status']) {
					$additional_fields['jan'] = array(
            'title' => $this->language->get('g_text_jan'),
						'text'  => $result['jan']
					);
				}

        if ($result['isbn'] && in_array('isbn', $additional_fields_catalog) && !$ft_stikers['isbn']['status']) {
					$additional_fields['isbn'] = array(
            'title' => $this->language->get('g_text_isbn'),
						'text'  => $result['isbn']
					);
				}

        if ($result['mpn'] && in_array('mpn', $additional_fields_catalog) && !$ft_stikers['mpn']['status']) {
					$additional_fields['mpn'] = array(
            'title' => $this->language->get('g_text_mpn'),
						'text'  => $result['mpn']
					);
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

				// temp

				if (isset($this->request->get['path'])){
					$p_path = 'path=' . $this->request->get['path'];
				} else {
					$p_path = '';
				}

				if ((int)$result['reviews'] > 0) {
					$reviews = ft_plural((int)$result['reviews'],array($this->language->get('g_text_reviews_1'),$this->language->get('g_text_reviews_2'),$this->language->get('g_text_reviews_3')));
					$reviews_href = $this->url->link('product/product', $p_path . '&product_id=' . $result['product_id'] . $url . '#reviews');
				} else {
					$reviews = $this->language->get('g_text_no_reviews');
					$reviews_href = '';
				}

        if ($result['quantity'] <= 0) {
  				$stock = $result['stock_status'];
  			} else if ($this->config->get('config_stock_display')) {
  				$stock = sprintf($this->language->get('g_stock_quantity'), (int)$result['quantity']);
  			} else {
  				$stock = $this->language->get('g_stock_status');
  			}

      
				$data['products'][] = array(

        'img_width'       => $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_width') . 'px',
        'img_height'      => $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_height') . 'px',
				'reviews'         => $reviews,
				'reviews_href'    => $reviews_href,
				'thumb2x'         => $hd_imgs ? $image2x : NULL,
				'thumb3x'         => $hd_imgs ? $image3x : NULL,
				'thumb4x'         => $hd_imgs ? $image4x : NULL,
				'stickers'  			=> $stickers,
        'additional_fields' => $additional_fields,
				'quantity'  			=> $result['quantity'],
        'stock' => $stock,
      
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(trim(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'))), 0, $this->config->get('theme_' . $this->config->get('config_theme') . '_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
					'rating'      => $result['rating'],
					'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'] . $url)
				);
			}

			$url = '';

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . urlencode(html_entity_decode($this->request->get['tag'], ENT_QUOTES, 'UTF-8'));
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

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['sorts'] = array();

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_default'),
				'value' => 'p.sort_order-ASC',
				'href'  => $this->url->link('product/search', 'sort=p.sort_order&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_asc'),
				'value' => 'pd.name-ASC',
				'href'  => $this->url->link('product/search', 'sort=pd.name&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_desc'),
				'value' => 'pd.name-DESC',
				'href'  => $this->url->link('product/search', 'sort=pd.name&order=DESC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_price_asc'),
				'value' => 'p.price-ASC',
				'href'  => $this->url->link('product/search', 'sort=p.price&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_price_desc'),
				'value' => 'p.price-DESC',
				'href'  => $this->url->link('product/search', 'sort=p.price&order=DESC' . $url)
			);

			if ($this->config->get('config_review_status')) {
				$data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_desc'),
					'value' => 'rating-DESC',
					'href'  => $this->url->link('product/search', 'sort=rating&order=DESC' . $url)
				);

				$data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_asc'),
					'value' => 'rating-ASC',
					'href'  => $this->url->link('product/search', 'sort=rating&order=ASC' . $url)
				);
			}

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_model_asc'),
				'value' => 'p.model-ASC',
				'href'  => $this->url->link('product/search', 'sort=p.model&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_model_desc'),
				'value' => 'p.model-DESC',
				'href'  => $this->url->link('product/search', 'sort=p.model&order=DESC' . $url)
			);

			$url = '';

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . urlencode(html_entity_decode($this->request->get['tag'], ENT_QUOTES, 'UTF-8'));
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

			$data['limits'] = array();

			$limits = array_unique(array($this->config->get('theme_' . $this->config->get('config_theme') . '_product_limit'), 25, 50, 75, 100));

			sort($limits);

			foreach($limits as $value) {
				$data['limits'][] = array(
					'text'  => $value,
					'value' => $value,
					'href'  => $this->url->link('product/search', $url . '&limit=' . $value)
				);
			}

			$url = '';

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . urlencode(html_entity_decode($this->request->get['tag'], ENT_QUOTES, 'UTF-8'));
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

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$pagination = new Pagination();

				$pagination = new Pagination_ft();
				$pagination->num_links = 5;
      
			$pagination->total = $product_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->url = $this->url->link('product/search', $url . '&page={page}');

			$data['pagination'] = $pagination->render();

			$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));

				$data['results'] = sprintf($this->language->get('g_text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));
      

			if (isset($this->request->get['search']) && $this->config->get('config_customer_search')) {
				$this->load->model('account/search');

				if ($this->customer->isLogged()) {
					$customer_id = $this->customer->getId();
				} else {
					$customer_id = 0;
				}

				if (isset($this->request->server['REMOTE_ADDR'])) {
					$ip = $this->request->server['REMOTE_ADDR'];
				} else {
					$ip = '';
				}

				$search_data = array(
					'keyword'       => $search,
					'category_id'   => $category_id,
					'sub_category'  => $sub_category,
					'description'   => $description,
					'products'      => $product_total,
					'customer_id'   => $customer_id,
					'ip'            => $ip
				);

				$this->model_account_search->addSearch($search_data);
			}
		}

		$data['search'] = $search;
		$data['description'] = $description;
		$data['category_id'] = $category_id;
		$data['sub_category'] = $sub_category;

		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['limit'] = $limit;

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('product/search', $data));
	}
}
