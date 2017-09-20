<?php
class Home extends CI_Controller {
	// 1ページあたりの表示件数
	const NUM_PER_PAGE = 5;
	const NUM_SHOP_PER_PAGE = 10;

	public function __construct() {
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('News_model');
		$this->load->model('Product_model');
		$this->load->model('Home_model');

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
}