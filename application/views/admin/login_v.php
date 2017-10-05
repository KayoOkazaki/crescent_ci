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
          $(this).text('login_v.php');
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
    <h1>ログイン</h1>
    <nav>
       <a class="button c" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/controllers/admin/Auth.php">Controller</a>&nbsp&nbsp
       <a class="button v" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/views/admin/login_v.php">View</a>&nbsp&nbsp
       <a class="button m" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/models/Admin_model.php">Model</a>
    </nav>
    <br>
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