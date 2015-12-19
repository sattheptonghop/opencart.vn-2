<?php
class ControllerModuleNews extends Controller {
	public function index() {
		$this->load->language('module/news');

		$data['heading_title'] = $this->language->get('heading_title');

		if (isset($this->request->get['id'])) {
			$parts = explode('_', (string)$this->request->get['id']);
		} else {
			$parts = array();
		}

		if (isset($parts[0])) {
			$data['news_id'] = $parts[0];
		} else {
			$data['news_id'] = 0;
		}

		$this->load->model('module/news');


		$this->load->model('extension/module');
 		$lastest_news = $this->model_extension_module->getModulesByCode('news');
 		$setting_news = json_decode($lastest_news[0]['setting']);
 		$data['module_title'] = $lastest_news[0]['name'];
		$news = $this->model_module_news->getAllNews(array('start'=>0,'limit'=>$setting_news->limit));
		foreach ($news as $n) {
			$data['news'][] = array(
				'news_id' 		=> $n['id'],
				'name'       	=> $n['title'],
				'thumb'       	=> $n['thumb'],
				'href'        	=> $this->url->link('news/news', 'id=' . $n['id'])
			);
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/news.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/news.tpl', $data);
		} else {
			return $this->load->view('default/template/module/news.tpl', $data);
		}
	}

	public function vi($str){
		$marTViet=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề" ,"ế","ệ","ể","ễ", "ì","í","ị","ỉ","ĩ", "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ" ,"ờ","ớ","ợ","ở","ỡ", "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ", "ỳ","ý","ỵ","ỷ","ỹ", "đ", "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă" ,"Ằ","Ắ","Ặ","Ẳ","Ẵ", "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ", "Ì","Í","Ị","Ỉ","Ĩ", "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ" ,"Ờ","Ớ","Ợ","Ở","Ỡ", "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ", "Ỳ","Ý","Ỵ","Ỷ","Ỹ", "Đ"); 
		$marKoDau=array("a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a", "e","e","e","e","e","e","e","e","e","e","e", "i","i","i","i","i", "o","o","o","o","o","o","o","o","o","o","o","o" ,"o","o","o","o","o", "u","u","u","u","u","u","u","u","u","u","u", "y","y","y","y","y", "d", "A","A","A","A","A","A","A","A","A","A","A","A" ,"A","A","A","A","A", "E","E","E","E","E","E","E","E","E","E","E", "I","I","I","I","I", "O","O","O","O","O","O","O","O","O","O","O","O" ,"O","O","O","O","O", "U","U","U","U","U","U","U","U","U","U","U", "Y","Y","Y","Y","Y", "D");
		$str = strtolower($str);
		$temp = str_replace($marTViet, $marKoDau, $str);
		$temp = str_replace(array('?',':',',',';','\'','"','(',')','[',']','|','\\',"/","!","@","$","^","&","*","+","=","<",">","–", '™', '®', '%','“','”','́','̀','̃','̉','̣','_',' '), '-', $temp);
		while(strpos($temp, '--') !== FALSE)	$temp = str_replace('--', '-', $temp);
		return strtolower($temp);
	}
}