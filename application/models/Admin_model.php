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
}
?>