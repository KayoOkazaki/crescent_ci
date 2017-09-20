<?php
require_once "../util.inc.php";
require_once "../db.inc.php";

define("IMAGE_PATH", "../images/press/");

try {
  //--------------------
  // データベースの準備
  //--------------------
  $pdo = db_init();

  //--------------------
  // お知らせリストの取得
  //--------------------
  $sql = "SELECT * FROM news ORDER BY posted DESC";
  $stmt = $pdo->query($sql);
  $news = $stmt->fetchAll();
}
catch (PDOException $e) {
  echo $e->getMessage();
  exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>お知らせ一覧 | Crescent Shoes 管理</title>
<link rel="stylesheet" href="css/admin.css">
</head>
<body id="admin_index">
<header>
  <div class="inner">
    <span><a href="index.php">Crescent Shoes 管理</a></span>
    <div id="account">
      admin
      [ <a href="logout.php">ログアウト</a> ]
    </div>
  </div>
</header>
<div id="container">
  <main>
    <h1>お知らせ一覧</h1>
    <p><a href="news_add.php">お知らせの追加</a></p>
    <table>
      <tr>
        <th>日付</th>
        <th>タイトル／お知らせ内容</th>
        <th>画像(64x64)</th>
        <th>編集</th>
        <th>削除</th>
      </tr>
      <?php foreach ($news as $item): ?>
      <tr>
        <td class="center"><?php echo h($item["posted"]); ?></td>
        <td>
        <span class="title"><?php echo h($item["title"]); ?></span>
        <?php echo h($item["message"]); ?>
        </td>
        <td class="center">
        <?php if($item["image"]):?>
        <img src="<?php echo IMAGE_PATH . h($item["image"]); ?>" width="64" height="64" alt="">
        <?php else:?>
        <img src="../images/press.png" width="64" height="64" alt="">
        <?php endif;?>
        </td>
        <td class="center"><a href="news_edit.php?id=<?php echo h($item["id"]); ?>">編集</a></td>
        <td class="center"><a href="news_delete.php?id=<?php echo h($item["id"]); ?>">削除</a></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </main>
  <footer>
    <p>&copy; Crescent Shoes All rights reserved.</p>
  </footer>
</div>
</body>
</html>