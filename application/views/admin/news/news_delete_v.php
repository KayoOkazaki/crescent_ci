<script>
	$(function(){
	    /******************************
		  Githubボタンの設定
		*******************************/
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
	         $(this).text('news_delete_v.php');
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
    <h1>お知らせの削除</h1>
    <nav>
       <a class="button c" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/controllers/admin/News.php">Controller</a>&nbsp&nbsp
       <a class="button v" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/views/admin/news/news_delete_v.php">View</a>&nbsp&nbsp
       <a class="button m" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/models/News_model.php">Model</a>
    </nav>
    <p>以下のお知らせを削除します。</p>
    <p>よろしければ「削除」ボタンを押してください。</p>
    <form action="" method="post" >
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
      <input type="submit" name="delete" value="削除" onclick="return submitChk()">
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
<script>
    /**
     * 確認ダイアログの返り値によりフォーム送信
    */
    function submitChk () {

        /* 確認ダイアログ表示 */
        var flag = confirm ( "削除してもよろしいですか？\n\n削除したくない場合は[キャンセル]ボタンを押して下さい");
        /* send_flg が TRUEなら送信、FALSEなら送信しない */
        return flag;
    }
</script>