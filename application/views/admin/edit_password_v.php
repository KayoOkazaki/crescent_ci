<div id="container">
  <main>
    <h1>パスワードの変更</h1>
    <form action="" method="post">
      <!------------------------
          ログインID
      -------------------------->
         <p><label for="pass">ログインID</label></p>
            <?php echo form_input(array(
           		'name' => 'id',
           		'id' => 'id',
            	'value' => set_value('id',$id)
            ));?>
            <span class='error'><?php echo form_error('id');?></span>
      <!------------------------
          パスワード
      -------------------------->
         <p><label for="pass">パスワード</label></p>
            <?php echo form_input(array(
            	'type' => 'password',
           		'name' => 'pass',
           		'id' => 'pass',
           		'value' => set_value('pass','')
            ));?>
            <span class='error'><?php echo form_error('pass');?></span>
            <span class='error'><?php echo form_error('login');?></span>
      <!------------------------
          新しいパスワード
      -------------------------->
         <p><label for="newpass">新しいパスワード</label></p>
            <?php echo form_input(array(
            	'type' => 'password',
            	'name' => 'newpass',
           		'id' => 'newpass',
            	'value' => set_value('newpass','')
            ));?>
            <span class='error'><?php echo form_error('newpass');?></span><br>
      <p><input type="submit" name="submit" value="パスワードを変更する" onclick="return submitChk()"></p>
    </form>
  </main>
  <footer>
    <p>&copy; Crescent Shoes All rights reserved.</p>
  </footer>
</div>
</body>
</html>
<script>
    /**
     * 確認ダイアログの返り値によりフォーム送信
    */
    function submitChk () {
        /* 確認ダイアログ表示 */
        var flag = confirm ( "変更してもよろしいですか？\n\n変更したくない場合は[キャンセル]ボタンを押して下さい");
        /* send_flg が TRUEなら送信、FALSEなら送信しない */
        return flag;
    }
</script>