<?php
class Home extends CI_Controller {
	// 1ページあたりの表示件数
	const NUM_PER_PAGE = 5;
	const NUM_SHOP_PER_PAGE = 10;

	public function __construct() {
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->helper('file');
		$this->load->model('News_model');
		$this->load->model('Product_model');
		$this->load->model('Home_model');

		$key = 'my secretkey';
		$encrypted_string = $this->encrypt->encode($key);
		$config['encryption_key'] = $encrypted_string;

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
	    Homeページ
	 **************************/
	public function index() {
		$this->load->view('header_v');
		$this->load->view('index_v');
		$this->load->view('footer_v');
	}
	/*************************
	    Aboutページ
	 **************************/
	public function about_c() {
		$this->load->view('header_v');
		$this->load->view('about_v');
		$this->load->view('footer_v');
	}
	 /*************************
	    Newsページ
	 **************************/
	public function news_c($page=1) {

		//ニュースページのベースとなるindexページのURLを指定する
		$config['base_url'] = base_url('home/news_c');

		//データ件数を取得
		$config['total_rows'] = $this->News_model->getCount();

		//1ページに表示するデータ数を定数よりセット
		$config['per_page'] = self::NUM_PER_PAGE;

		//use_page_numbers にTRUEを設定すると、
		//ページ番号がURIパスに付加され、引数：$pageに現ページ数が渡されます。
		$config['use_page_numbers'] = true;

		//上記設定内容をページネーションライブラリに上書き
		$config['prev_link'] = '前ページ';
		$config['next_link'] = '次ページ';
		$config['prev_tag_close'] = ' | ';
		$config['num_tag_close'] = ' | ';
		$config['cur_tag_close'] = '</strong> | ';
		$this->pagination->initialize($config);

		//現在のページ数と1ページ毎の項目数をもとに、表示するべきデータを取得する
		$data['items'] = $this->News_model->find_by_page($page, self::NUM_PER_PAGE);

		//取得したデータを一覧画面に表示する
		$this->load->view('header_v');
		$this->load->view('news_v',$data);
		$this->load->view('footer_v');
	}
	/*************************
	   Shopページ
	 **************************/
	public function shop_c($page=1) {

		//ショップページのベースとなるページのURLを指定する
		$config['base_url'] = base_url('home/shop_c');

		//データ件数を取得
		$config['total_rows'] = $this->Product_model->getCount();

		//1ページに表示するデータ数を定数よりセット
		$config['per_page'] = self::NUM_SHOP_PER_PAGE;

		//use_page_numbers にTRUEを設定すると、
		//ページ番号がURIパスに付加され、引数：$pageに現ページ数が渡されます。
		$config['use_page_numbers'] = true;

		//上記設定内容をページネーションライブラリに上書き
		$config['prev_link'] = '前ページ';
		$config['next_link'] = '次ページ';
		$config['prev_tag_close'] = ' | ';
		$config['num_tag_close'] = ' | ';
		$config['cur_tag_close'] = '</strong> | ';
		$this->pagination->initialize($config);

		//現在のページ数と1ページ毎の項目数をもとに、表示するべきデータを取得する
		$data['items'] = $this->Product_model->find_by_page($page, self::NUM_SHOP_PER_PAGE);

		//取得したデータを一覧画面に表示する
		$this->load->view('header_v');
		$this->load->view('shop_v',$data);
		$this->load->view('footer_v');
	}
	/*************************
	   商品詳細ページ
	 **************************/
	 public function detail_c($id) {
	 	$data['item'] = $this->Product_model->find_by_id($id);

	 	//取得したデータを詳細ページに表示する
	 	$this->load->view('header_v');
	 	$this->load->view('detail_v',$data);
	 	$this->load->view('footer_v');
	}
	/*************************
	   コンタクトページ
	 **************************/
	public function contact_c() {

		if ($this->input->post('conf'))
		{
			//バリデーションルールの設定
			$this->form_validation->set_rules('name','お名前','required');
			$this->form_validation->set_rules('kana','フリガナ','required|regex_match[/^[ァ-ヶー 　マ]+$/]');
			$this->form_validation->set_rules('mail','メールアドレス','required|regex_match[/^[a-zA-Z0-9_.+-]+[@][a-zA-Z0-9.-]+$/]');
			$this->form_validation->set_rules('tel','電話番号','regex_match[/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$|^ $/]');
			$this->form_validation->set_rules('message','お問い合わせ内容','required');

			$this->form_validation->set_message('required', '%sを入力してください');
			$this->form_validation->set_message('regex_match', '正しい%sではありません');

			//バリーデーションチェック実行、OKの時
			if ($this->form_validation->run()) {

				//入力値を配列にセット
				$new_session = array(
						'name' => $this->input->post('name'),
						'kana' => $this->input->post('kana'),
						'mail' => $this->input->post('mail'),
						'tel' => $this->input->post('tel'),
						'message' => $this->input->post('message')
				);
				//セッション変数を設定
				$config['sess_expire_on_close'] = true;
				$this->session->set_userdata($new_session,$config);

				redirect('home/contact_conf_c');
			}
		}

		//セッション変数がセットされているとき
		if ($_SESSION['name'])
		{
			//値をセット
			$data['name'] = $_SESSION['name'];
			$data['kana'] = $_SESSION['kana'];
			$data['mail'] = $_SESSION['mail'];
			$data['tel'] = $_SESSION['tel'];
			$data['message'] = $_SESSION['message'];
		} else
		{
			//初期値をセット
			$data['name'] = '';
			$data['kana'] = '';
			$data['mail'] = '';
			$data['tel'] = '';
			$data['message'] = '';
		}

		//コンタクトページ表示
		$this->load->view('header_v');
		$this->load->view('contact_v',$data);
		$this->load->view('footer_v');
	}
	/*************************
	   コンタクト確認ページ
	 **************************/
	public function contact_conf_c() {

		//値をセット
		// 以下記述は$data['name'] = $_SESSION['name']; と同じ
		$data['name'] = $this->session->userdata('name');
		$data['kana'] = $this->session->userdata('kana');
		$data['mail'] = $this->session->userdata('mail');
		$data['tel'] = $this->session->userdata('tel');
		$data['message'] = $this->session->userdata('message');

		//セッション情報が正しくセットされているとき
		if ($data['name'] && $data['kana'] && $data['mail'] && $data['message'])
		{
			//コンタクト確認ページを表示
			$this->load->view('header_v');
			$this->load->view('contact_conf_v', $data);
			$this->load->view('footer_v');
		} else
		{
			//なかったらエラーページへ飛ばす
			redirect('home/contact_error_c');
		}
		//修正するをクリックしたとき
		if ($this->input->post('back'))
		{
			redirect('home/contact_c');
		}
		//送信するをクリックしたとき
		if ($this->input->post('send'))
		{
			redirect('home/contact_done_c');
		}
	}
	/*************************
	   コンタクトエラーページ
	 **************************/
	public function contact_error_c() {

		$this->load->view('header_v');
		$this->load->view('contact_error_v');
		$this->load->view('footer_v');
	}
	/*************************
	 コンタクト完了ページ
	 **************************/
	public function contact_done_c() {

		$this->load->view('header_v');
		$this->load->view('contact_done_v');
		$this->load->view('footer_v');
	}
}