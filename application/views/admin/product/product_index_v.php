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
    <h1>商品一覧</h1>
    <nav>
       <a class="button c" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/controllers/admin/News.php">Controller</a>&nbsp&nbsp
       <a class="button v" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/views/admin/news/news_index_v.php">View</a>&nbsp&nbsp
       <a class="button m" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/models/News_model.php">Model</a>
    </nav>
    <p><a href="<?php echo base_url('admin/product/add_c');?>">商品の追加</a></p>
    <div id="pages">
   		<?php echo $this->pagination->create_links(); ?>
	</div>
    <table>
      <tr>
        <th>商品名</th>
        <th>商品コード／商品説明</th>
        <th>画像(75x50)</th>
        <th>編集</th>
        <th>削除</th>
      </tr>
      <?php foreach ($items as $item): ?>
      <tr>
        <td class="center"><?php echo $item->product_name; ?></td>
        <td>
        <span class="title"><?php echo $item->product_code; ?></span>
        <?php echo $item->description; ?>
        </td>
        <td class="center product">
        <?php if($item->main_img):?>
        	<img src="<?php echo base_url('images/products/'.$item->main_img); ?>" width="75" height="50" alt="">
        <?php else:?>
        	<img src="<?php echo base_url('images/products/press.png')?>" width="75" height="50" alt="">
        <?php endif;?>
        </td>
        <td class="center"><a href="<?php echo base_url('admin/product/edit_c/'.$item->id);?>">編集</a></td>
        <td class="center"><a href="<?php echo base_url('admin/product/delete_c/'.$item->id);?>">削除</a></td>
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