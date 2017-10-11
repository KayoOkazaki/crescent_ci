<script>
	$(function(){
      $('.m').hover(
        function(){
          $(this).text('admin_model.php');
        },
        function(){
          $(this).text('Model');
        }
      );
      $('.v').hover(
        function(){
          $(this).text('edit_password_v.php');
        },
        function(){
          $(this).text('View');
        }
      );
      $('.c').hover(
        function(){
          $(this).text('Auth.php');
        },
        function(){
          $(this).text('Controller');
        }
      );
    });
</script>
<div id="container">
  <main>
    <h1>パスワードの変更</h1>
    <nav>
       <a class="button c" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/controllers/admin/Auth.php">Controller</a>&nbsp&nbsp
       <a class="button v" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/views/admin/edit_password_v.php">View</a>&nbsp&nbsp
       <a class="button m" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/models/Admin_model.php">Model</a>
    </nav>

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
           		'value' => ''
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
            	'value' => ''
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

