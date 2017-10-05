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
             	$(this).text('news_index_v.php');
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
  <main id="admin_index">
    <h1>お知らせ一覧</h1>
    <nav>
       <a class="button c" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/controllers/admin/News.php">Controller</a>&nbsp&nbsp
       <a class="button v" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/views/admin/news/news_index_v.php">View</a>&nbsp&nbsp
       <a class="button m" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/models/News_model.php">Model</a>
    </nav>
    <p><a href="<?php echo base_url('admin/news/add_c');?>">お知らせの追加</a></p>
    <div id="pages">
   		<?php echo $this->pagination->create_links(); ?>
	</div>
    <table>
      <tr>
        <th>日付</th>
        <th>タイトル／お知らせ内容</th>
        <th>画像(64x64)</th>
        <th>編集</th>
        <th>削除</th>
      </tr>
      <?php foreach ($items as $item): ?>
      <tr>
        <td class="center"><?php echo $item->posted; ?></td>
        <td>
        <span class="title"><?php echo $item->title; ?></span>
        <?php echo $item->message; ?>
        </td>
        <td class="center">
        <?php if($item->image):?>
        	<img src="<?php echo base_url('images/press/'.$item->image); ?>" width="64" height="64" alt="">
        <?php else:?>
        	<img src="<?php echo base_url('images/press/press.png')?>" width="64" height="64" alt="">
        <?php endif;?>
        </td>
        <td class="center"><a href="<?php echo base_url('admin/news/edit_c/'.$item->id);?>">編集</a></td>
        <td class="center"><a href="<?php echo base_url('admin/news/delete_c/'.$item->id);?>">削除</a></td>
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