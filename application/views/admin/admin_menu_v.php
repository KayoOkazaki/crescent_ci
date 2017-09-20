<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>お知らせ一覧 | Crescent Shoes 管理</title>
<link rel="stylesheet" href="<?php echo base_url('css/admin.css');?>">
</head>
<body id="admin_index">
<header>
  <div class="inner">
    <span><a href="index.php">Crescent Shoes 管理</a></span>
    <div id="account">
      admin
      [ <a href="<?php echo base_url('admin/auth/login_c');?>">ログアウト</a> ]
    </div>
  </div>
</header>
<div id="container">
  <main>
    <h1>管理メニュー</h1>
    <h3><a href="<?php echo base_url('admin/news/index');?>">お知らせ一覧</a></h3>
    <h3><a href="<?php echo base_url('admin/product/product_index_c');?>"></a>商品一覧</h3>
  </main>
  <footer>
    <p>&copy; Crescent Shoes All rights reserved.</p>
  </footer>
</div>
</body>
</html>