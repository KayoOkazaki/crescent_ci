<script>
	$(function(){
      $('.m').hover(
        function(){
          $(this).text('News_model.php');
        },
        function(){
          $(this).text('Model');
        }
      );
      $('.v').hover(
        function(){
          $(this).text('news_edit_v.php');
        },
        function(){
          $(this).text('View');
        }
      );
      $('.c').hover(
        function(){
          $(this).text('News.php');
        },
        function(){
          $(this).text('Controller');
        }
      );
    });
</script>
<div id="container">
  <main>
    <h1>お知らせの編集</h1>
    <nav>
       <a class="button c" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/controllers/admin/News.php">Controller</a>&nbsp&nbsp
       <a class="button v" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/views/admin/news/news_edit_v.php">View</a>&nbsp&nbsp
       <a class="button m" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/models/News_model.php">Model</a>
    </nav>
    <p>情報を入力し、「保存」ボタンを押してください。</p>
<!-- <form action="" method="post" enctype="multipart/form-data"> -->
    <!-- admin/news/edit_c コントローラに情報がPOSTされる -->
    <?php echo form_open_multipart('admin/news/edit_c/'.$item->id);?>
    <table>
      <tr>
        <!------------------------
           日付
        -------------------------->
        <th class="fixed">日付(任意)</th>
        <td>
<!--           <div class="error">※日付は「0000-00-00」の形式で入力してください</div> -->
          <div class="error"><?php echo form_error('posted');?></div>
<!--           <input type="date" name="posted" value="2020-05-03"> -->
          <?php echo form_input(array(
          		'type' => 'date',
          		'name' => 'posted',
          		'value' => set_value('posted',$item->posted)
          ));?>
        </td>
      </tr>
      <tr>
        <!------------------------
           タイトル
        -------------------------->
        <th class="fixed">タイトル</th>
        <td>
<!--      <div class="error">※タイトルを入力してください</div> -->
          <div class="error"><?php echo form_error('title');?></div>
<!--      <input type="text" name="title" size="80" value="さわやかシーズンに登山はいかが？"> -->
		  <?php echo form_input(array(
		  		'name' => 'title',
		  		'value' => set_value('title',$item->title),
		  		'size' => 80
		  ));?>
        </td>
      </tr>
      <tr>
        <!------------------------
           お知らせの内容
        -------------------------->
        <th class="fixed">お知らせの内容</th>
        <td>
<!--      <div class="error">※お知らせ内容を入力してください</div> -->
          <div class="error"><?php echo form_error('message');?></div>
<!--           <textarea name="message" cols="80" rows="5">お待たせしました！これまで在庫切れで入手が困難だったクレセントシューズイチオシのトレッキングシューズが再入荷です。身体を動かすと気持ちのよい季節、さわやかな風を感じて登山はいかがでしょう？</textarea> -->
		  <?php
		  		$attr['name'] = 'message';
		  		$attr['value'] = set_value('message',$item->message);
		  		$attr['cols'] = 80;
		  		$attr['rows'] = 5;
		  		echo form_textarea($attr);
		  ?>
        </td>
      </tr>
      <tr>
       <!------------------------
           画像
       -------------------------->
        <th class="fixed">画像(任意)</th>
        <td>
<!--      <input type="file" name="pic" value="../images/press/press03.jpg"> -->
          <?php   echo form_upload('userfile');
		          $data = array(
		          		'name' => 'imageflg', 'id' => 'imageflg',
		          		'value' => '画像の変更をしない', 'checked' => set_value('imageflg',true)
		          );
		          echo form_checkbox($data);
		          echo form_label('画像の変更をしない','imageflg');
          ?>
          <div><img src="<?php echo base_url('images/press/'.$item->image);?>" width="64" height="64" alt=""></div>
          <!--エラーメッセージ -->
          <div class="error"><?php echo $error;?></div>
        </td>
      </tr>
    </table>
    <p>
      <!------------------------
         保存・キャンセルボタン
      -------------------------->
      <?php echo form_submit('upload','保存')?>
<!--  <input type="submit" name="save" value="保存"> -->
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