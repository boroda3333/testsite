<?php
class ControllerCommonHome extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		if (isset($this->request->get['route'])) {
			$this->document->addLink($this->config->get('config_url'), 'canonical');
		}



				$this->load->model('setting/setting');

				$ft_settings = array();
				$ft_settings = $this->model_setting_setting->getSetting('theme_frame', $this->config->get('config_store_id'));
				$language_id = $this->config->get('config_language_id');

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

				$data['menu_open'] = false;

				if (in_array($route, $shown_menu_routes)) {
					$data['menu_open'] = true;
				}

      
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

		$this->response->setOutput($this->load->view('common/home', $data));
	}
}
