<?php
class Auth extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('admin_model');

		//デバッグ用出力
		if (ENVIRONMENT === 'development') {
			//プロファイラを有効にする
			$this->output->enable_profiler();
			//True:表示 False:非表示
			$this->output->enable_profiler(false);
			//var_dumpのように値の出力を行う
			//$output = 'Hello';
			//$this->output->set_output($output);
		}
	}
	public function login_c()
	{
		//バリデーション設定
		$this->form_validation->set_rules('id','ログインID','required');
		$this->form_validation->set_rules('pass','パスワード','required');
		$this->form_validation->set_rules('login','ログイン','callback_login_check');

		//バリデーション実行
		if ($this->form_validation->run()) {
			redirect('admin/auth/admin_menu_c/');
		} else {
			//ログインページを表示
			$this->load->view('admin/login_v');
		}
	}
	public function admin_menu_c()
	{
		$this->load->view('admin/admin_menu_v');
	}
	public function logout_c()
	{
		$this->admin_model->logout();

		//ログアウトページを表示
		$this->load->view('admin/logout_v');

	}
	function login_check($value) {

		$id = $this->input->post('id');
		$pass = $this->input->post('pass');

		if (!empty($id) && !empty($pass))
		{
			$this->form_validation->set_message('login_check','ログインIDまたはパスワードに誤りがあります。');
			return $this->admin_model->login($id,$pass);
		}
	}
}
?>