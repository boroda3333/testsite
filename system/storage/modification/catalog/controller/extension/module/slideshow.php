<?php
class ControllerExtensionModuleSlideshow extends Controller {
	public function index($setting) {
		static $module = 0;		

		$this->load->model('design/banner');
		$this->load->model('tool/image');

		
        $this->document->addStyle('catalog/view/theme/' . $this->config->get('theme_frame_directory') . '/javascript/owl-carousel/owl.carousel.min.css');
      
		
        // removed by frame theme
      
		$this->document->addScript('catalog/view/javascript/jquery/swiper/js/swiper.jquery.min.js');
		
		$data['banners'] = array();

		$results = $this->model_design_banner->getBanner($setting['banner_id']);

		foreach ($results as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$data['banners'][] = array(

        'thumb_holder'    => $this->model_tool_image->resize('catalog/frametheme/src_holder.png', $setting['width'], $setting['height']),
        'img_width' => $setting['width'] . 'px',
        'img_height' => $setting['height'] . 'px',
      
					'title' => $result['title'],
					'link'  => $result['link'],
					'image' => $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
				);
			}
		}

		$data['module'] = $module++;

		return $this->load->view('extension/module/slideshow', $data);
	}
}