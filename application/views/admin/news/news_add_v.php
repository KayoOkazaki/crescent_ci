<div id="container">
  <main>
    <h1>お知らせの追加</h1>
    <p>情報を入力し、「追加」ボタンを押してください。</p>
<!--<form action="" method="post" enctype="multipart/form-data"> -->

	<!-- admin/news/add_c コントローラに情報がPOSTされる -->
	<?php echo form_open_multipart("admin/news/add_c");?>

    <table>
        <!------------------------
           日付
        -------------------------->
      <tr>
        <th class="fixed">日付(任意)</th>
        <td>
<!--      <div class="error">※日付は「0000-00-00」の形式で入力してください</div> -->
          <div class="error"><?php echo form_error('posted'); ?></div>
<!--      <input type="date" name="posted"> -->
          <?php echo form_input(array(
          		'name' => 'posted',
          		'value' => set_value('posted', date('Y-m-d')),
          		'size' => 14
          )); ?>
        </td>
      </tr>
        <!------------------------
           タイトル
        -------------------------->
      <tr>
        <th class="fixed">タイトル</th>
        <td>
<!--      <div class="error">※タイトルを入力してください</div> -->
          <div class="error"><?php echo form_error('title'); ?></div>
<!--      <input type="text" name="title" size="80"> -->
          <?php echo form_input(array(
          		'name' => 'title',
          		'value' => set_value('title'),
          		'size' => 80
          )); ?>
        </td>
      </tr>
        <!------------------------
           お知らせの内容
        -------------------------->
      <tr>
        <th class="fixed">お知らせの内容</th>
        <td>
<!--      <div class="error">※お知らせ内容を入力してください</div> -->
          <div class="error"><?php echo form_error('message'); ?></div>
<!--      <textarea name="message" cols="80" rows="5"></textarea> -->
          <?php
            $attr['name'] = 'message';
            $attr['value'] = set_value('message');
            $attr['cols'] = 80;
            $attr['rows'] = 5;
            echo form_textarea($attr);
          ?>
        </td>
      </tr>
      <!------------------------
          画像
      -------------------------->
      <tr>
        <th class="fixed">画像(任意)</th>
        <td>
            <!--ファイルアップロード -->

			<!-- デフォルトのファイルアップロード名は『userfile』 -->
			<?php echo form_upload('userfile');?>

          <!--エラーメッセージ -->
          <div class="error"><?php echo $error;?></div>

          <div>画像は64x64ピクセルで表示されます</div>
        </td>
      </tr>
    </table>
    <!------------------------
       追加・キャンセルボタン
    -------------------------->
    <p>
      <?php echo form_submit("upload", "追加"); ?>
      <input type="submit" name="cancel" value="キャンセル">
    </p>
<!--</form> -->
    <?php echo form_close();?>
  </main>
  <footer>
    <p>&copy; Crescent Shoes All rights reserved.</p>
  </footer>
</div>
</body>
</html>