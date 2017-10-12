<?php
class Admin_model extends CI_Model {
	/*************************************************************************
	 * 機能： ログイン処理
	 *        ユーザIDとパスワードが admins テーブルと一致するかどうかチェックし
	 *        OKならログイン情報をセッション変数へ登録する
	 *
	 * @param1： string $id ユーザID
	 * @param2： string $pass パスワード
	 * @return： boolean TRUE:OK FALSE:NG
	 *************************************************************************/
	public function login($id, $pass)
	{
		$hashed = hash('sha256', $pass . $id);
		$query = $this->db->query('SELECT * FROM admins WHERE login_id=? AND login_pass = ?',
		array($id,$hashed));

		//ログイン成功
		if ($query->num_rows() > 0)
		{
			//セッション変数を作成
			$data = array(
					'admin_id' => $id,
					'admin_auth' => true
			);
			//セッション変数セット
			$this->session->set_userdata($data);
			return true;

		} else {

			//ログイン失敗
			return false;
		}
	}
	/**********************************************************
	 * 機能： ログアウト処理　セッション変数を破棄
	 * @param1： なし
	 * @return： boolean TRUE:OK FALSE:NG
	 **********************************************************/
	 public function logout()
	{
		//セッション変数破棄
		$this->session->sess_destroy();
	}
	/**********************************************************
	 * 機能： ログイン認証しているかチェック
	 * @param1： なし
	 * @return： boolean TRUE:認証済 FALSE:未認証
	 **********************************************************/
	public function is_logged_in() {
		return ($this->session->userdata('admin_auth') == true);
	}
	/**********************************************************
	 * 機能： セッション変数よりユーザIDを取得する
	 * @param1： なし
	 * @return： boolean TRUE:ログイン中 FALSE:ログインしてない
	 **********************************************************/
	public function get_id()
	{
		return $this->session->userdata('admin_id');
	}
	/**********************************************************
	 * 機能： パスワード暗号化
	 * @param1： ユーザid
	 * @param2： パスワード
	 * @return： 暗号化したパスワード
	 **********************************************************/
	public function hash_pass($id,$pass) {
		//SHA2で暗号化
		return hash('sha256', $pass . $id); //Salt用にidを付加
	}
	/**********************************************************
	 * 機能： パスワードDB更新
	 * @param1： ユーザID
	 * @param2： 新しいパスワード
	 * @return： なし
	 **********************************************************/
	public function update_admins($login_id, $login_pass){

		$data = array('login_pass' => $login_pass);
		$where = array('login_id' => $login_id);
		$this->db->update('admins', $data, $where);

	}
}
?>