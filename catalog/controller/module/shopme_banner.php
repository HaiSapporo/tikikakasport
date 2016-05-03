<?php
class ControllerModuleShopmeBanner extends Controller {
	public function index($setting) {
		
		
		if(empty($setting['module_title'][$this->config->get('config_language_id')])) {
			$data['module_title'] = false;
		} else if (isset($setting['module_title'][$this->config->get('config_language_id')])) {
			$data['module_title'] = html_entity_decode($setting['module_title'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
		}
		
		$data['columns'] = $setting['columns'];
		
		if (isset($setting['sections'])) {        
            $data['sections'] = array();

            $section_row = 0;
            
            foreach($setting['sections'] as $section) {
                $this->load->model('tool/image');

                if (isset($section['block'])){
                    $block = html_entity_decode($section['block'], ENT_QUOTES, 'UTF-8');
                } else {
                    $block = false;
                }
				
				if (isset($section['thumb_image'][$this->config->get('config_language_id')])){
				$image = 'image/' . $section['thumb_image'][$this->config->get('config_language_id')];
				} else {
				$image = false;
				}


                $section_row++;

                $data['sections'][] = array(
                    'index'   => $section_row,
                    'description'   => $block,
					'image' => $image
                );
            }
		
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/shopme_banner.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/shopme_banner.tpl', $data);
			} else {
				return $this->load->view('default/template/module/shopme_banner.tpl', $data);
			}
		}
	}
}