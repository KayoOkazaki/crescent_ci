<div id="container">
  <main id="admin_index">
    <h1>お知らせ一覧</h1>
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