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
			$this->output->enable_profiler(true);
			//var_dumpのように値の出力を行う
			//$output = 'Hello';
			//$this->output->set_output($output);
		}
	}
	/*************************
	   ログイン画面
	 **************************/
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
			$this->load->view('admin/admin_header_v');
			$this->load->view('admin/login_v');
		}
	}
	/*************************
	   管理画面
	 **************************/
	public function admin_menu_c()
	{
		$this->load->view('admin/admin_header_v');
		$this->load->view('admin/admin_menu_v');
	}
	/*************************
	   ログアウト画面
	 **************************/
	public function logout_c()
	{
		$this->admin_model->logout();

		//ログアウトページを表示
		$this->load->view('admin/logout_v');
	}

	/*************************
	   パスワード変更画面
	 **************************/
	function edit_password_c() {

		//ログインしている時
		if ($this->admin_model->is_logged_in() == TRUE) {

			//パスワード変更をクリックしたとき
			if ($this->input->post('submit')) {

				//バリデーション設定
				$this->form_validation->set_rules('id','ログインID','required');
				$this->form_validation->set_rules('pass','パスワード','required');
				$this->form_validation->set_rules('login','ログイン','callback_login_check');
				$this->form_validation->set_rules('newpass','新しいパスワード','required');

				//バリデーションチェックOKの時
				if ($this->form_validation->run())
				{
					$id = $this->input->post('id');
					$newpass = $this->input->post('newpass');
					$hashedpass = $this->admin_model->hash_pass($id,$newpass);
					$this->admin_model->update_admins($id,$hashedpass);

					//パスワード変更完了画面
					redirect('admin/auth/edit_password_done_c');
				}
			}
			//パスワード変更画面
			$data['id'] = $this->admin_model->get_id();
			$this->load->view('admin/admin_header_v');
			$this->load->view('admin/edit_password_v',$data);

		//ログインしていない時
		} else {
			//ログイン画面へ遷移
			$this->logout_c();
		}
	}
	/*************************
	 パスワード変更画面
	 **************************/
	function edit_password_done_c() {
		$this->load->view('admin/admin_header_v');
		$this->load->view('admin/edit_password_done_v');
	}
	/**-----------------------------------------------------------------------
	 * バリデーション用コールバック
	 *
	 * @param1 $value：入力値
	 * @return boolean 形式が正しければTRUE、正しくなければFALSE
	 -------------------------------------------------------------------------*/
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