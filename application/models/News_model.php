<?php
class News_model extends CI_Model {

	var $image_path;

	function News_model(){
		parent::__construct();

		// realpathとは
		// realpath() は、入力 path のシンボリックリンクをすべて展開し、正規化した絶対パスを返します。

		// APPPATHとは
		// CodeIgniterのApplicationフォルダの階層を指します
		$this->image_path = realpath(APPPATH. "../images/press");
	}

	/****************************************************
	 * 機能： お知らせ(news)テーブルの件数を取得
	 * @param1： int $month 絞り込み条件
	 * @return： int 件数
	 *****************************************************/
	public function getCount($month=0)
	{
	// ★直接SQL文記述する方法
// 		$where = ($month != 0) ? ' WHERE month = '.$month : '';
// 		$query = $this->db->query('SELECT * FROM cics_news '.$where);
// 		return $query->num_rows();

	// ★ActiveRecordでクエリ作成する方法
		$this->db->select('*');
		$this->db->from('cics_news');
		if ($month != 0) {
			$this->db->where('month', $month);
		}
		return $this->db->get()->num_rows();

	}
	/****************************************************
	 * 機能： お知らせ(news)テーブルを取得
	 * @param1： $field 取得するDBの項目を指定
	 * @return： int 件数
	 *****************************************************/
	public function getNews($field='*')
	{
	// ★直接SQL文記述する方法
	// 	$query = $this->db->query('SELECT '.$field.' FROM cics_news');
// 		return $query->result();

	// ★ActiveRecordでクエリ作成する方法
		$this->db->select($field);
		$this->db->from('cics_news');
		return $this->db->get()->result();

	}
	/****************************************************
	 * 機能： 1ページ分のお知らせ(news)データを取得
	 * @param1： int $page 現在ページ数
	 * @param2： int $perpage 1ページに表示する項目数
	 * @param3： int $month 絞り込み条件
	 * @return： obj 取得したnewsテーブルデータ
	 *****************************************************/
	public function find_by_page($page, $perpage, $month=0) {

		//開始レコード位置設定
		$start = (($page * $perpage)-$perpage);

	// ★直接SQL文記述する方法
// 		$where = ($month != 0) ? ' WHERE month = '.$month : '';
// 		$query = $this->db->query('SELECT * FROM cics_news ' .$where. ' ORDER BY posted DESC LIMIT ?, ?', array($start,$perpage));
// 		return $query->result();


	// ★ActiveRecordでクエリ作成する方法
 		$this->db->select('*');
		$this->db->from('cics_news');
		if ($month!=0) {
			$this->db->where('month',$month);
		}
		$this->db->order_by('posted DESC');
		$this->db->limit($perpage);
		$this->db->offset($start);

		//クエリ実行し結果を返す
		return $this->db->get()->result();

	}
	/****************************************************
	 * 機能： お知らせ(news)テーブルを追加
	 * @param1： obj $data 追加する値
	 * @return： なし
	 *****************************************************/
	public function insert($data) {

		$this->db->insert('cics_news', $data);
	}
	/****************************************************
	 * 機能： お知らせ(news)テーブルを取得
	 * @param1： int $id 取得するテーブルid
	 * @return： obj 取得したnewsテーブルデータ（1件）
	 *****************************************************/
	public function find_by_id($id) {

		$where = array(
				'id' => $id
		);
		return $this->db->get_where('cics_news', $where)->row();

	}
	/****************************************************
	 * 機能： お知らせ(news)テーブルを更新
	 * @param1： obj $data 更新する値
	 * @return： なし
	 *****************************************************/
	 public function update($data) {

		$this->db->where('id',$data->id);
		$this->db->update('cics_news',$data);

	}
	/****************************************************
	 * 機能： お知らせ(news)テーブルを削除
	 * @param1： int $id 削除するid
	 * @return： なし
	 *****************************************************/
	public function delete($id) {

		$where = array(
				'id' => $id
		);
		$this->db->delete('cics_news', $where);

	}
	/****************************************************
	 * 機能： ファイルアップロード
	 * @param1： なし
	 * @return： $result['error']     エラーメッセージ
	 *           $result['file_name'] アップロードファイル名
	 *****************************************************/
	function do_upload(){

		//戻り値初期化
		$result = array(
				'error' => '',
				'file_name' => ''
		);

		//アップロードの条件を設定
		$config['upload_path'] = $this->image_path; //アップロードされたファイルが置かれるフォルダパス
		$config['allowed_types'] = 'gif|jpg|png'; //アップロードするファイルの種類を限定
		$config['max_size']	= '2000'; //アップロードできるファイルの最大サイズ (KB)
		$config['max_width']  = '1024'; //ファイル幅の最大値 (px)
		$config['max_height']  = '1024'; //ファイル高さの最大値 (px)
		$config['overwrite'] = true; //アップロード先に同じ名前のファイルがあるとき上書きする

		// 第2引数で条件を受け取ることができます。
		$this->load->library("upload", $config);

		//アップロード開始
		if ( ! $this->upload->do_upload()) {
			//アップロード失敗した時エラーメッセージを返す
			$result['error'] = $this->upload->display_errors();
			return $result;
		}

		// アップロードライブラリを読み込み、$image_dataに格納
		$image_data = $this->upload->data();
		$result['file_name'] = $image_data['file_name'];

		// アップロードライブラリで生成された$image_dataから、
		// 以下のようにアップロードファイルのパスを取得できる
		$config = array(
				'source_image' => $image_data['full_path'],
				'new_image' => $this->image_path,

				// リサイズされるときや、固定の値を指定したとき、
				// もとの画像のアスペクト比を維持するかどうかを指定する
				'maintain_ration' => true,
				'width' => 64,
				'height' => 64
		);

		// イメージライブラリは次のように引数をとります。
		// 引数はライブラリ読み込み前に定義しておきます。
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();

		return $result;

	}
}
?>