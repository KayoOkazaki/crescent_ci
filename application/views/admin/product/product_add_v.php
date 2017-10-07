<script>
	$(function(){
	    $('.m').hover(
	      function(){
	        $(this).text('Product_model.php');
	      },
	      function(){
	        $(this).text('Model');
	      }
	    );
	    $('.v').hover(
	      function(){
	        $(this).text('product_add_v.php');
	      },
	      function(){
	        $(this).text('View');
	      }
	    );
	    $('.c').hover(
	      function(){
	        $(this).text('Product.php');
	      },
	      function(){
	        $(this).text('Controller');
	      }
	    );
   	   /******************************
    	  アップロードファイル選択時に
    	  サムネイル画像を表示する
    	******************************/
  		$('#main_upfile').change(function(){
  		  if (this.files.length > 0) {
  		    // 選択されたファイル情報を取得
  		    var file = this.files[0];

  		    // readerのresultプロパティに、データURLとしてエンコードされたファイルデータを格納
  		    var reader = new FileReader();
  		    reader.readAsDataURL(file);

  		    reader.onload = function() {
  		      $('#main_thumb').attr('src', reader.result );
  		    }
  		  }
	  	});
	  	$('#sub_upfile1').change(function(){
		    if (this.files.length > 0) {
		      // 選択されたファイル情報を取得
		      var file = this.files[0];

		      // readerのresultプロパティに、データURLとしてエンコードされたファイルデータを格納
		      var reader = new FileReader();
		      reader.readAsDataURL(file);

		      reader.onload = function() {
		        $('#sub_thumb1').attr('src', reader.result );
		      }
		    }
		});
	  	$('#sub_upfile2').change(function(){
		    if (this.files.length > 0) {
		      // 選択されたファイル情報を取得
		      var file = this.files[0];

		      // readerのresultプロパティに、データURLとしてエンコードされたファイルデータを格納
		      var reader = new FileReader();
		      reader.readAsDataURL(file);

		      reader.onload = function() {
		        $('#sub_thumb2').attr('src', reader.result );
		      }
		    }
		});
	  	$('#sub_upfile3').change(function(){
		    if (this.files.length > 0) {
		      // 選択されたファイル情報を取得
		      var file = this.files[0];

		      // readerのresultプロパティに、データURLとしてエンコードされたファイルデータを格納
		      var reader = new FileReader();
		      reader.readAsDataURL(file);

		      reader.onload = function() {
		        $('#sub_thumb3').attr('src', reader.result );
		      }
		    }
		});
	  	$('#sub_upfile4').change(function(){
		    if (this.files.length > 0) {
		      // 選択されたファイル情報を取得
		      var file = this.files[0];

		      // readerのresultプロパティに、データURLとしてエンコードされたファイルデータを格納
		      var reader = new FileReader();
		      reader.readAsDataURL(file);

		      reader.onload = function() {
		        $('#sub_thumb4').attr('src', reader.result );
		      }
		    }
		});
    });
</script>
<div id="container">
  <main>
    <h1>商品の追加</h1>
    <nav>
       <a class="button c" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/controllers/admin/Product.php">Controller</a>&nbsp&nbsp
       <a class="button v" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/views/admin/product/product_add_v.php">View</a>&nbsp&nbsp
       <a class="button m" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/models/Product_model.php">Model</a>
    </nav>
    <p>情報を入力し、「追加」ボタンを押してください。</p>
<!--<form action="" method="post" enctype="multipart/form-data"> -->

	<!-- admin/product/add_c コントローラに情報がPOSTされる -->
	<?php echo form_open_multipart("admin/product/add_c");?>

    <table>
        <!------------------------
           商品名
        -------------------------->
      <tr>
        <th class="fixed">商品名</th>
        <td>
          <div class="error"><?php echo form_error('product_name'); ?></div>
          <?php echo form_input(array(
          		'name' => 'product_name',
          		'value' => set_value('product_name'),
          		'size' => 30
          )); ?>
        </td>
      </tr>
        <!------------------------
           商品コード
        -------------------------->
      <tr>
        <th class="fixed">商品コード</th>
        <td>
          <div class="error"><?php echo form_error('product_code'); ?></div>
          <?php echo form_input(array(
          		'name' => 'product_code',
          		'value' => set_value('product_code'),
          		'size' => 50
          )); ?>
        </td>
      </tr>
        <!------------------------
           商品説明
        -------------------------->
      <tr>
        <th class="fixed">商品説明</th>
        <td>
          <div class="error"><?php echo form_error('description'); ?></div>
          <?php
            $attr['name'] = 'description';
            $attr['value'] = set_value('description');
            $attr['cols'] = 80;
            $attr['rows'] = 5;
            echo form_textarea($attr);
          ?>
        </td>
      </tr>
        <!------------------------
           価格
        -------------------------->
      <tr>
        <th class="fixed">価格</th>
        <td>
          <div class="error"><?php echo form_error('price'); ?></div>
          <?php echo form_input(array(
          		'name' => 'price',
          		'value' => set_value('price'),
          		'size' => 20
          )); ?>
        </td>
      </tr>
        <!------------------------
           カラー
        -------------------------->
      <tr>
        <th class="fixed">カラー</th>
        <td>
          <div class="error"><?php echo form_error('color'); ?></div>
          <?php echo form_input(array(
          		'name' => 'color',
          		'value' => set_value('color'),
          		'size' => 25
          )); ?>
        </td>
      </tr>
        <!------------------------
           素材
        -------------------------->
      <tr>
        <th class="fixed">素材</th>
        <td>
          <div class="error"><?php echo form_error('material'); ?></div>
          <?php echo form_input(array(
          		'name' => 'material',
          		'value' => set_value('material'),
          		'size' => 25
          )); ?>
        </td>
      </tr>
        <!------------------------
           最小サイズ
        -------------------------->
      <tr>
        <th class="fixed">最小サイズ</th>
        <td>
          <div class="error"><?php echo form_error('min_size'); ?></div>
          <?php echo form_input(array(
          		'name' => 'min_size',
          		'value' => set_value('min_size'),
          		'size' => 10
          )); ?>
        </td>
      </tr>
        <!------------------------
           最大サイズ
        -------------------------->
      <tr>
        <th class="fixed">最大サイズ</th>
        <td>
          <div class="error"><?php echo form_error('max_size'); ?></div>
          <?php echo form_input(array(
          		'name' => 'max_size',
          		'value' => set_value('max_size'),
          		'size' => 10
          )); ?>
        </td>
      </tr>
      <!------------------------
          メイン画像
      -------------------------->
      <tr>
        <th class="fixed">メイン画像（75×50）</th>
        <td>
            <!--ファイルアップロード -->
			<?php
				$data = array('name' => 'main_img', 'id' => 'main_upfile');
				echo form_upload($data);
			?>
          <!--画像 -->
          <div class="product"><img id="main_thumb" src="" width="75" height="50" alt=""></div>
          <!--エラーメッセージ -->
          <div class="error"><?php echo $error[4] ;?></div>
          <div>画像は75x50ピクセルで表示されます</div>
        </td>
      </tr>
      <!------------------------
          サブ画像１
       -------------------------->
      <tr>
        <th class="fixed">サブ画像１（50×50）</th>
        <td>
         <!--ファイルアップロード -->
			<?php
				$data = array('name' => 'image1', 'id' => 'sub_upfile1');
				echo form_upload($data);
			?>
          <!--画像 -->
          <div class="product"><img id="sub_thumb1" src="" width="75" height="50" alt=""></div>
          <!--エラーメッセージ -->
          <div class="error"><?php echo $error[0] ;?></div>

          <div>画像は50x50ピクセルで表示されます</div>
        </td>
      </tr>
      <!------------------------
          サブ画像２
       -------------------------->
      <tr>
        <th class="fixed">サブ画像２（50×50）</th>
        <td>
            <!--ファイルアップロード -->
			<?php
				$data = array('name' => 'image2', 'id' => 'sub_upfile2');
				echo form_upload($data);
			?>
          <!--画像 -->
          <div class="product"><img id="sub_thumb2" src="" width="75" height="50" alt=""></div>
          <!--エラーメッセージ -->
          <div class="error"><?php echo $error[1];?></div>

          <div>画像は50x50ピクセルで表示されます</div>
        </td>
      </tr>
      <!------------------------
          サブ画像３
       -------------------------->
      <tr>
        <th class="fixed">サブ画像３（50×50）</th>
        <td>
            <!--ファイルアップロード -->
			<?php
				$data = array('name' => 'image3', 'id' => 'sub_upfile3');
				echo form_upload($data);
			?>
          <!--画像 -->
          <div class="product"><img id="sub_thumb3" src="" width="75" height="50" alt=""></div>
          <!--エラーメッセージ -->
          <div class="error"><?php echo $error[2];?></div>

          <div>画像は50x50ピクセルで表示されます</div>
        </td>
      </tr>
      <!------------------------
          サブ画像４
       -------------------------->
      <tr>
        <th class="fixed">サブ画像４（50×50）</th>
        <td>
            <!--ファイルアップロード -->
			<?php
				$data = array('name' => 'image4', 'id' => 'sub_upfile4');
				echo form_upload($data);
			?>
          <!--画像 -->
          <div class="product"><img id="sub_thumb4" src="" width="75" height="50" alt=""></div>
          <!--エラーメッセージ -->
          <div class="error"><?php echo $error[3];?></div>

          <div>画像は50x50ピクセルで表示されます</div>
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