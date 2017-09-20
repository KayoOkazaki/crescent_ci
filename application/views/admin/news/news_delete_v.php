<div id="container">
  <main>
    <h1>お知らせの削除</h1>
    <p>以下のお知らせを削除します。</p>
    <p>よろしければ「削除」ボタンを押してください。</p>
    <form action="" method="post">
    <table>
      <tr>
        <!------------------------
           日付
        -------------------------->
        <th class="fixed">日付</th>
        <td>
        	<?php echo $item->posted; ?>
        </td>
      </tr>
      <tr>
        <!------------------------
           タイトル
        -------------------------->
        <th class="fixed">タイトル</th>
        <td>
        	<?php echo $item->title; ?>
        </td>
      </tr>
      <tr>
        <!------------------------
           お知らせの内容
        -------------------------->
        <th class="fixed">お知らせ内容</th>
        <td>
        	<?php echo $item->message; ?>
        </td>
      </tr>
      <tr>
       <!------------------------
           画像
       -------------------------->
        <th class="fixed">画像</th>
        <td><img src="<?php echo "../images/press/". $item->image; ?>" width="64" height="64" alt=""></td>
      </tr>
    </table>
    <p>
      <!------------------------
         削除・キャンセルボタン
      -------------------------->
      <input type="submit" name="delete" value="削除">
      <input type="submit" name="cancel" value="キャンセル">
    </p>
    </form>
  </main>
  <footer>
    <p>&copy; Crescent Shoes All rights reserved.</p>
  </footer>
</div>
</body>
</html>