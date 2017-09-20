<?php
class News extends CI_Controller {

	// 1ページあたりの表示件数
	const NUM_PER_PAGE = 5;

	public function __construct() {
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('Admin_model');
		$this->load->model('News_model');
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
	     お知らせ一覧画面
	**************************/
	public function index($page=1)
	{
		//peginationの設定
		$this->load->library('form_validation');

		//お知らせ一覧画面のベースとなるindexページのURLを指定する
		$config['base_url'] = base_url('admin/news/index');

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
		$this->load->view('admin/news/news_header_v');
		$this->load->view('admin/news/news_index_v',$data);
	}
	/*************************
	     お知らせ追加画面
	 **************************/
	public function add_c()
	{
		$res = array('error' => ' ','file_name' => ' ');

		//キャンセルボタンクリックした時
		if ($this->input->post('cancel'))
		{
			//お知らせ一覧画面へ遷移
			redirect('admin/news/index');
		}

		//追加ボタンクリックした時
		if ($this->input->post('upload'))
		{
			//ファイルをアップロード
			$res = $this->News_model->do_upload();

			//バリデーションチェック
			$this->form_validation->set_rules('posted','日付','required|callback_valid_check[posted]');
			$this->form_validation->set_rules('title','タイトル','required');
			$this->form_validation->set_rules('message','お知らせ内容','required');

			//バリデーションチェックOKの時
			if ($this->form_validation->run())
			{
				$this->output->set_output('レスポンス：'.$res['file_name']);
				$news = new stdClass;
				$news->posted = $this->input->post('posted');
				$news->title= $this->input->post('title');
				$news->message= $this->input->post('message');
				$news->image = $res['file_name'];

				//入力された値をDBに追加
				$this->News_model->insert($news);

				//お知らせ完了ページへ遷移
				redirect('admin/news/add_done_c');
			}
		}

		//お知らせ追加ページ表示
		$this->load->view('admin/news/news_header_v');
		$this->load->view('admin/news/news_add_v',$res);
	}
	/*************************
	   お知らせ追加完了画面
	 **************************/
	public function add_done_c()
	{
		//追加完了ページ表示
		$this->load->view('admin/news/news_header_v');
		$this->load->view('admin/news/news_add_done_v');
	}
	/*************************
	    お知らせ編集画面
	 **************************/
	public function edit_c($id)
	{
		$error = '';
		$file_name = '';

		//キャンセルボタンクリックした時
		if ($this->input->post('cancel')) {

			//一覧ページへ戻る
			redirect('admin/news');
		}

		//保存ボタンクリックした時
		if ($this->input->post('upload')) {

			//画像の変更をする時
			if( ! $this->input->post('imageflg'))
			{
				//ファイルをアップロード
				$res = $this->News_model->do_upload();
				$this->output->set_output('レスポンス：'.$res['file_name']);
				$file_name = $res['file_name'];
				$error= $res['error'];
			}

			//バリデーションチェック
			$this->form_validation->set_rules('posted','日付','required|callback_valid_check[posted]');
			$this->form_validation->set_rules('title','タイトル','required');
			$this->form_validation->set_rules('message','お知らせ内容','required');

			//バリデーションチェックOKの時
			if ($this->form_validation->run())
			{
				$news = new stdClass;
				$news->id = $id;
				$news->posted = $this->input->post('posted');
				$news->title = $this->input->post('title');
				$news->message = $this->input->post('message');

				//画像の変更をする時
				if ( ! $this->input->post('imageflg')) {

					//アップロードファイル名をセット
					$news->image = $res['file_name'];
				}

				//入力された値をDBに追加
				$this->News_model->update($news);

				//編集完了ページ表示
				redirect('admin/news/edit_done_c');
			}
		}
		//DBからお知らせデータ取得
		$data['item'] = $this->News_model->find_by_id($id);

		//アップロード情報をセット
		$data['error'] = $error;
		$data['file_name'] = $file_name;

		//編集ページ表示
		$this->load->view('admin/news/news_header_v');
		$this->load->view('admin/news/news_edit_v',$data);

	}
	/*************************
	   お知らせ編集完了画面
	 **************************/
	public function edit_done_c()
	{
		//編集完了ページ表示
		$this->load->view('admin/news/news_header_v');
		$this->load->view('admin/news/news_edit_done_v');
	}
	/*************************
	     お知らせ削除画面
	 **************************/
	public function delete_c($id)
	{
		//キャンセルボタンクリックした時
		if ($this->input->post('cancel')) {

			//一覧ページへ戻る
			redirect('admin/news');
		}

		//削除ボタンクリックした時
		if ($this->input->post('delete')) {

			//お知らせデータを削除
			$this->News_model->delete($id);

			//削除完了ページへ遷移
			redirect('admin/news/delete_done_c');
		}

		//DBからお知らせデータ取得
		$data['item'] = $this->News_model->fid_by_id($id);

		//削除ページ表示
		$this->load->view('admin/news/news_header_v');
		$this->load->view('admin/news/news_delete_v',$data);
	}
	/*************************
	   お知らせ削除完了画面
	 **************************/
	public function delete_done_c()
	{
		//削除完了ページ表示
		$this->load->view('admin/news/news_header_v');
		$this->load->view('admin/news/news_delete_done_v');
	}
	/**-----------------------------------------------------------------------
	 * バリデーション用コールバック
	 *
	 * @param1 $value：入力値
	 * @param2 $which：入力項目
	 * @return boolean 形式が正しければTRUE、正しくなければFALSE
	 -------------------------------------------------------------------------*/
	function valid_check($value,$which) {

		$result = true;
		if ($which == 'posted') {
			if ( ! preg_match('/^\d{4}-\d{2}-\d{2}$/',$value))
			{
				$this->form_validation->set_message('valid_check', '日付は「0000-00-00」の形式で入力してください');
				$result = false;
			}
		}

		return $result;
	}
	/**-----------------------------------------------------------------------
	 * 機能： ファイルアップロード処理
	 *
	 * @param1： なし
	 * @return： なし
	 -------------------------------------------------------------------------*/
	function do_upload()
	{
		$config['upload_path'] = base_url('images/news/'); //アップロードされたファイルが置かれるフォルダパス
		$config['allowed_types'] = 'gif|jpg|png'; //アップロードするファイルの種類を限定
		$config['max_size']	= '100'; //アップロードできるファイルの最大サイズ (KB)
		$config['max_width']  = '1024'; //ファイル幅の最大値 (px)
		$config['max_height']  = '768'; //ファイル高さの最大値 (px)
		$this->load->library('upload', $config);

		//アップロード開始
		if ( ! $this->upload->do_upload())
		{
			//アップロード失敗した時
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('admin/news/news_header_v');
			$this->load->view('admin/news/news_add_v',$error);

		} else {

			//アップロード成功した時
			$this->output->set_output("アップロードファイル名：".$this->upload->data());
			$data['upload_data'] = $this->upload->data();
			$this->load->view('admin/news/news_header_v');
			$this->load->view('admin/news/news_add_v',$data);
		}
	}
}
?>