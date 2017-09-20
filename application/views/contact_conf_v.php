    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <nav>
            <h1 class="page-header">Contact</h1>
            <ol class="breadcrumb">
              <li><a href="<?php echo base_url('home'); ?>">Home</a></li>
              <li><a href="<?php echo base_url('home/contact_c'); ?>">Contact</a></li>
              <li class="active">送信内容確認</li>
            </ol>
          </nav>
        </div>
      </div>
        <div class="row">
          <div class="col-md-4 hidden-sm hidden-xs">
            <div class="contact-img">
            <img src="<?php echo base_url('images/contact.jpg')?>">
            </div>
          </div>
          <div class="col-md-8">
            <h3 class="page-header">Message Confirmation</h3>
            <p>内容を修正される場合は「修正する」ボタンを、送信される場合は「送信する」ボタンを押してください。</p>
            <table class="table table-hover table-bordered">
              <tr>
                <th>お名前</th>
                <td><?php echo $name; ?></td>
              </tr>
              <tr>
                <th>フリガナ</th>
                <td><?php echo $kana; ?></td>
              </tr>
              <tr>
                <th>メールアドレス</th>
                <td><?php echo $mail; ?></td>
              </tr>
              <tr>
                <th>電話番号</th>
                <td><?php echo $tel; ?></td>
              </tr>
              <tr>
                <th>お問い合わせ内容</th>
                <td><?php echo $message; ?></td>
              </tr>
            </table>
            <form action="" method="post" class="form-horizontal">
                <div class="form-group">
                <div class="col-sm-10">
<!--                   <button type="submit" name="send" class="btn btn-success btn-lg">送信する</button> -->
<!--                   <button type="submit" name="back" class="btn btn-success btn-lg">修正する</button> -->
                  <?php echo form_submit('send', '送信する',array('class' => 'btn btn-success btn-lg')); ?>
                  <?php echo form_submit('back', '修正する',array('class' => 'btn btn-success btn-lg')); ?>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>