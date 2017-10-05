<script>
	$(function(){
      $('.v').hover(
        function(){
          $(this).text('admin_menu_v.php');
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
    <h1>管理メニュー</h1>
    <nav>
       <a class="button c" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/controllers/admin/Auth.php">Controller</a>&nbsp&nbsp
       <a class="button v" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/views/admin/admin_menu_v.php">View</a>&nbsp&nbsp
    </nav>
    <h3><a href="<?php echo base_url('admin/news/index');?>">お知らせ一覧</a></h3>
    <h3><a href="<?php echo base_url('admin/product');?>">商品一覧</a></h3>
    <h3><a href="<?php echo base_url('admin/auth/edit_password_c');?>">パスワードの変更</a></h3>
  </main>
  <footer>
    <p>&copy; Crescent Shoes All rights reserved.</p>
  </footer>
</div>
</body>
</html>