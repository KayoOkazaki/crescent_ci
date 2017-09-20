<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>File Upload</title>
</head>
<body>
	<div id="upload">
	<?php
		// galleryに情報がPOSTされる
		echo form_open_multipart("gallery");

		// ファイルアップロードクラスを利用します。
		// デフォルトのファイルアップロード名は『userfile』なので、これを利用すると便利です。
		echo form_upload("userfile");

		echo form_submit("upload", "追加");
		echo form_input(array(
				'name' => 'title',
				'value' => set_value('title'),
				'size' => 80));
		echo form_close();
	?>
	</div>

	<div id="gallery">
		<?php	if(isset($images) && count($images)):
		 // フォルダ内に画像がある場合は以下を実行
			foreach($images as $image):
		?>
			<div class="tumbs">
				<a href="<?php echo $image["url"]; ?>">
					<img src="<?php echo $image["thumb_url"]; ?>">
				</a>
			</div>
		<?php endforeach; ?>

		<?php else: ?>
			<div id="blank_gallery">画像をアップロードしてください</div>
		<?php endif;?>


	</div>
</body>
</html>