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
  <style>
  #filter_form {
  	float:left;
  }
  #pages {
  	float: right;
  	margin-right: auto;
  }
  ul li {
  	list-style-type: none;
  }
	#pages ul.pageNav04 {
		/zoom: 1;
		overflow: hidden;
		margin: 0 0 20px;
		padding: 0;
		background: #fff;
	}

	#pages ul.pageNav04 li {
		float: left;
		margin: 0 5px 5px 0;
	}

	#pages ul.pageNav04 li span,
	#pages ul.pageNav04 li a {
		float: left;
		padding: 5px 12px;
		background: #e1ebfa;
		border: 1px solid #339;
		color: #000;
	}

	#pages ul.pageNav04 li span {
		background: #fff;
	}

	#pages ul.pageNav04 li a:hover {
		background: #ccf;
		border-color: #000;
	}
  </style>
<div id="container">
  <main id="admin_index">
    <h1>お知らせ一覧</h1>
    <nav>
       <a class="button c" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/controllers/admin/News.php">Controller</a>&nbsp&nbsp
       <a class="button v" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/views/admin/news/news_index_v.php">View</a>&nbsp&nbsp
       <a class="button m" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/models/News_model.php">Model</a>
    </nav>
    <p><a href="<?php echo base_url('admin/news/add_c');?>">お知らせの追加</a></p>
    <form id="filter_form" action="<?php echo base_url('admin/news');?>" method="get">
	    <div>
	        <?php
	            //最初のリスト
	            $options['0'] = '全て';

	            //DBの値をリストの追加
	            foreach ($allnews as $news) {
	            	$options[$news->month] = $news->month.'月';
	            }
	            //その他属性の設定
	            $setting = array('style' => 'width:60px;');

	            //連想配列のキーで昇順ソート
	            ksort($options,SORT_NUMERIC);

	            //ドロップダウン表示（デフォルト0）
	            echo form_dropdown('month', $options, 0, $setting);
	        ?>
	        <input type="submit" name="filter" value="検索"/>
	    </div>
    </form>
    <div id="pages">
   		<?php echo $this->pagination->create_links(); ?>
<!--    	<ul class="pageNav04"> -->
<!-- 			<li><a href="1.html">&laquo; 前</a></li> -->
<!-- 			<li><a href="1.html">1</a></li> -->
<!-- 			<li><span>2</span></li> -->
<!-- 			<li><a href="3.html">3</a></li> -->
<!-- 			<li><a href="4.html">4</a></li> -->
<!-- 			<li><a href="5.html">5</a></li> -->
<!-- 			<li><a href="6.html">6</a></li> -->
<!-- 			<li><a href="3.html">次 &raquo;</a></li> -->
<!-- 		</ul> -->
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