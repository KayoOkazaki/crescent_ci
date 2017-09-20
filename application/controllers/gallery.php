<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {
	function index(){
		//デバッグ用出力
		if (ENVIRONMENT === 'development') {
			//プロファイラを有効にする
			$this->output->enable_profiler();
			//True:表示 False:非表示
			$this->output->enable_profiler(true);
			//var_dumpのように値の出力を行う
			//$output = 'Hello';
			//$this->output->set_output($output);
		}
		$this->load->model("Gallery_model");

		// アップロード情報がPOSTされたかどうかで条件分岐
		if($this->input->post("upload")){

			//ファイルをアップロード
			$this->Gallery_model->do_upload();
			$this->output->set_output('title='.$this->input->post('title'));
		}

		// get_imagesメソッドはまだ未完成なので、これから作っていきます
		$data["images"] = $this->Gallery_model->get_images();

		// galleryのビューを読み込む
		$this->load->view("gallery", $data);
	}
}