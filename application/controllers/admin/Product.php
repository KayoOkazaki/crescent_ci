<?php
class Product extends CI_Controller {

	// 1ページあたりの表示件数
	const NUM_PER_PAGE = 5;

	public function __construct() {
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('Admin_model');
		$this->load->model('Product_model');
		$this->load->library('form_validation');
		$this->load->helper('file');

		if (!$this->Admin_model->is_logged_in()) {
			redirect('admin/auth/login_c');
		}

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
	 商品一覧画面
	 **************************/
	public function index($page=1)
	{
		//peginationの設定
		//商品一覧画面のベースとなるindexページのURLを指定する
		$config['base_url'] = base_url('admin/product/index');

		//データ件数を取得
		$config['total_rows'] = $this->Product_model->getCount();

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
		$data['items'] = $this->Product_model->find_by_page($page, self::NUM_PER_PAGE);

		//取得したデータを一覧画面に表示する
		$this->load->view('admin/admin_header_v');
		$this->load->view('admin/product/product_index_v',$data);
	}
	/*************************
	 商品追加画面
	 **************************/
	public function add_c()
	{

		//エラーメッセージ初期化
		$data['error'] = array(0=>'',1=>'',2=>'',3=>'',4=>'');

		//キャンセルボタンクリックした時
		if ($this->input->post('cancel'))
		{
			//商品一覧画面へ遷移
			redirect('admin/product/index');
		}

		//追加ボタンクリックした時
		if ($this->input->post('upload'))
		{
			//バリデーションチェック
			$this->form_validation->set_rules('product_name','商品名','required');
			$this->form_validation->set_rules('product_code','商品コード','required');
			$this->form_validation->set_rules('description','商品説明','required');
			$this->form_validation->set_rules('price','価格','required');

			//バリデーションチェックOKの時
			if ($this->form_validation->run())
			{
				//サブ画像をアップロード
				for ($i = 0; $i < 4; $i++)
				{
					$fileName = 'image'. ($i+1);
					if ($_FILES[$fileName]['name'] != '') {
						//アップロード実行
						$sub_res[$i] = $this->Product_model->do_upload($fileName, 600,600);
						$data['error'][$i] = $sub_res[$i]['error'];
				    }
				}

				//メイン画像をアップロード
				//アップロードファイルが選択されている時
				if ($_FILES['main_img']['name'] != '') {

					//アップロード実行
					$main_res = $this->Product_model->do_upload('main_img',750,500);
					$data['error'][] = $main_res['error'];
				}

				//入力された値をオブジェクトにセット
				$product = new stdClass;
				$product->product_name = $this->input->post('product_name');
				$product->product_code = $this->input->post('product_code');
				$product->description = $this->input->post('description');
				$product->price = $this->input->post('price');
				$product->color = $this->input->post('color');
				$product->material = $this->input->post('material');
				$product->max_size = $this->input->post('max_size');
				$product->min_size = $this->input->post('min_size');
				$product->main_img = $_FILES['main_img']['name'];
				$product->image1 = $_FILES['image1']['name'];
				$product->image2 = $_FILES['image2']['name'];
				$product->image3 = $_FILES['image3']['name'];
				$product->image4 = $_FILES['image4']['name'];
				$product->created = date('Y-m-d H:i:s');

				//DBに追加
				$this->Product_model->insert($product);

				//商品完了ページへ遷移
				redirect('admin/product/add_done_c');
			}
		}

		//商品追加ページ表示
		$this->load->view('admin/admin_header_v');
 		$this->load->view('admin/product/product_add_v',$data);
	}
	/*************************
	 商品追加完了画面
	 **************************/
	public function add_done_c()
	{
		//追加完了ページ表示
		$this->load->view('admin/admin_header_v');
		$this->load->view('admin/product/product_add_done_v');
	}
	/*************************
	 商品編集画面
	 **************************/
	public function edit_c($id)
	{
		$error = '';
		$file_name = '';

		//キャンセルボタンクリックした時
		if ($this->input->post('cancel')) {

			//一覧ページへ戻る
			redirect('admin/product');
		}

		//保存ボタンクリックした時
		if ($this->input->post('upload')) {

			//画像の変更をする時
			if( ! $this->input->post('imageflg'))
			{
				//ファイルをアップロード
				$res = $this->Product_model->do_upload();
				$this->output->set_output('レスポンス：'.$res['file_name']);
				$file_name = $res['file_name'];
				$error= $res['error'];
			}

			//バリデーションチェック
			$this->form_validation->set_rules('product','商品名','required');
			$this->form_validation->set_rules('product_code','商品コード','required');
			$this->form_validation->set_rules('description','商品説明','required');

			//バリデーションチェックOKの時
			if ($this->form_validation->run())
			{
				$product = new stdClass;
				$product->id = $id;
				$product->posted = $this->input->post('posted');
				$product->title = $this->input->post('title');
				$product->message = $this->input->post('message');

				//画像の変更をする時
				if ( ! $this->input->post('imageflg')) {

					//アップロードファイル名をセット
					$product->image = $res['file_name'];
				}

				//入力された値をDBに追加
				$this->Product_model->update($product);

				//編集完了ページ表示
				redirect('admin/product/edit_done_c');
			}
		}
		//DBから商品データ取得
		$data['item'] = $this->Product_model->find_by_id($id);

		//アップロード情報をセット
		$data['error'] = $error;
		$data['file_name'] = $file_name;

		//編集ページ表示
		$this->load->view('admin/admin_header_v');
		$this->load->view('admin/product/product_edit_v',$data);

	}
	/*************************
	 商品編集完了画面
	 **************************/
	public function edit_done_c()
	{
		//編集完了ページ表示
		$this->load->view('admin/admin_header_v');
		$this->load->view('admin/product/product_edit_done_v');
	}
	/*************************
	 商品削除画面
	 **************************/
	public function delete_c($id)
	{
		//キャンセルボタンクリックした時
		if ($this->input->post('cancel')) {

			//一覧ページへ戻る
			redirect('admin/product');
		}

		//削除ボタンクリックした時
		if ($this->input->post('delete')) {

			//商品データを削除
			$this->Product_model->delete($id);

			//削除完了ページへ遷移
			redirect('admin/product/delete_done_c');
		}

		//DBから商品データ取得
		$data['item'] = $this->Product_model->find_by_id($id);

		//削除ページ表示
		$this->load->view('admin/admin_header_v');
		$this->load->view('admin/product/product_delete_v',$data);
	}
	/*************************
	 商品削除完了画面
	 **************************/
	public function delete_done_c()
	{
		//削除完了ページ表示
		$this->load->view('admin/admin_header_v');
		$this->load->view('admin/product/product_delete_done_v');
	}

// 	/**-----------------------------------------------------------------------
// 	 * 機能： ファイルアップロード処理
// 	 *
// 	 * @param1： なし
// 	 * @return： なし
// 	 -------------------------------------------------------------------------*/
// 	function do_upload()
// 	{
// 		$config['upload_path'] = base_url('images/products/'); //アップロードされたファイルが置かれるフォルダパス
// 		$config['allowed_types'] = 'gif|jpg|png'; //アップロードするファイルの種類を限定
// 		$config['max_size']	= '100'; //アップロードできるファイルの最大サイズ (KB)
// 		$config['max_width']  = '1024'; //ファイル幅の最大値 (px)
// 		$config['max_height']  = '768'; //ファイル高さの最大値 (px)
// 		$this->load->library('upload', $config);

// 		//アップロード開始
// 		if ( ! $this->upload->do_upload())
// 		{
// 			//アップロード失敗した時
// 			$error = array('error' => $this->upload->display_errors());
// // 			$this->load->view('admin/admin_header_v');
// // 			$this->load->view('admin/product/product_add_v',$error);

// 		} else {

// 			//アップロード成功した時
// 			$this->output->set_output("アップロードファイル名：".$this->upload->data());
// 			$data['upload_data'] = $this->upload->data();
// 			$this->load->view('admin/admin_header_v');
// 			$this->load->view('admin/product/product_add_v',$data);
// 		}
// 	}
}
?>