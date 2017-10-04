<div id="container">
  <main>
    <h1>ログイン</h1>
<!--     <p class="error">ログインIDを入力してください。</p> -->
<!--     <p class="error">パスワードを入力してください。</p> -->
<!--     <p class="error">ログインIDまたはパスワードに誤りがあります。</p> -->
    <span class="error"><?php echo validation_errors();?></span>
    <form action="" method="post">
    <table id="loginbox">
      <tr>
        <th>ログインID</th>
<!--         <td><input type="text" name="id"></td> -->
        <td><?php echo form_input(array('name'=>'id','value'=>set_value('id')));?></td>
      </tr>
      <tr>
        <th>パスワード</th>
<!--         <td><input type="password" name="pass"></td> -->
        <td><?php echo form_input(array('name'=>'pass','type'=>'password'));?></td>
      </tr>
    </table>
    <p><input type="submit" value="ログイン"></p>
    </form>
  </main>
  <footer>
    <p>&copy; Crescent Shoes All rights reserved.</p>
  </footer>
</div>
</body>
</html>