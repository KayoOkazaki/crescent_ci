    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <nav>
            <h1 class="page-header">Contact</h1>
            <ol class="breadcrumb">
              <li><a href="<?php echo base_url('home'); ?>">Home</a></li>
              <li class="active">Contact</li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6479.926203846024!2d139.7001925!3d35.702525600000016!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188d2f6cba44df%3A0x18b3bc4c95b9f078!2z44CSMTY5LTAwNzMg5p2x5Lqs6YO95paw5a6_5Yy655m-5Lq655S677yS5LiB55uu77yU4oiS77yY!5e0!3m2!1sja!2sjp!4v1439870260921" width="100%" height="400px" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
        <div class="col-md-4">
          <h3>Contact Details</h3>
          <p>
            〒169-0073<br>東京都新宿区百人町2-4-8　グレースビル1階
          </p>
          <p><i class="fa fa-phone"></i> 03-1234-5678</p>
          <p><i class="fa fa-envelope-o"></i> info@crescent.com
          </p>
          <p><i class="fa fa-clock-o"></i>
            月-金曜日: 9:00 AM to 5:00 PM</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 hidden-sm hidden-xs contactleft">
            <div class="contact-img">
            <img src="<?php echo base_url('images/contact.jpg'); ?>">
            </div>
          </div>
          <div class="col-md-8">
            <h3 class="page-header">Send Message</h3>
            <form action="" method="post" class="form-horizontal" novalidate>
              <!------------------------
                   お名前
              -------------------------->
              <div class="form-group">
                <label for="inputname" class="col-sm-3 control-label">お名前<span>(必須)</span></label>
                <div class="col-sm-9">
<!--              <input type="text" class="form-control" id="inputname" required> -->
                  <?php echo form_input(array(
                  		'name' => 'name',
                  		'id' => 'name',
                  		'class' => 'form-control',
                  		'value' => set_value('name',$name)
                  ));?>
                  <p class="help-block">(例)山田　太郎</p>
                  <span class='error'><?php echo form_error('name');?></span>
                </div>
              </div>
               <!------------------------
                    フリガナ
               -------------------------->
              <div class="form-group">
                <label for="inputkana" class="col-sm-3 control-label">フリガナ<span>(必須)</span></label>
                <div class="col-sm-9">
<!--              <input type="text" class="form-control" id="inputkana" required> -->
                  <?php echo form_input(array(
                  		'name' => 'kana',
                  		'id' => 'kana',
                  		'class' => 'form-control',
                  		'value' => set_value('kana',$kana)
                  ));?>
                  <p class="help-block">(例)ヤマダ　タロウ ※全角カタカナ</p>
                  <span class='error'><?php echo form_error('kana');?></span>
                </div>
              </div>
              <!------------------------
                   メールアドレス
              -------------------------->
              <div class="form-group">
                <label for="inputemail" class="col-sm-3 control-label">メールアドレス<span>(必須)</span></label>
                <div class="col-sm-9">
<!--            <input type="email" class="form-control" id="inputemail" required> -->
                 <?php echo form_input(array(
                 		'type' => 'email',
                 		'name' => 'mail',
                 		'id' => 'mail',
                 		'class' => 'form-control',
                 		'value' => set_value('mail',$mail)
                 ));?>
                  <p class="help-block">(例)abc@zz.com ※半角英数字</p>
                  <span class='error'><?php echo form_error('mail');?></span>
                </div>
              </div>
              <!------------------------
                   電話番号
              -------------------------->
              <div class="form-group">
                <label for="inputtel" class="col-sm-3 control-label">電話番号</label>
                <div class="col-sm-9">
<!--             <input type="tel" class="form-control" id="inputtel"> -->
                 <?php echo form_input(array(
                 		'type' => 'tel',
                 		'name' => 'tel',
                 		'id' => 'tel',
                 		'class' => 'form-control',
                 		'value' => set_value('tel',$tel)
                 ));?>
                  <p class="help-block">(例)03-1234-3214　※ハイフンあり　半角数字</p>
                  <span class='error'><?php echo form_error('tel');?></span>
                </div>
              </div>
              <!------------------------
                   お問い合わせ内容
              -------------------------->
              <div class="form-group">
                <label for="inputmessage" class="col-sm-3 control-label">お問い合わせ内容<span>(必須)</span></label>
                <div class="col-sm-9">
<!--             <textarea rows="10" cols="100" class="form-control" id="message" required maxlength="999" style="resize:none"></textarea> -->
                 <?php
                     $attr['name'] = 'message';
                     $attr['id'] = 'message';
                     $attr['class'] = 'form-control';
                     $attr['rows'] = 10;
                     $attr['cols'] = 100;
                     $attr['maxlength'] = 999;
                     $attr['value'] = set_value('message',$message);
                     $attr['style'] = 'resize:none';
                     echo form_textarea($attr);
                  ;?>
                  <span class='error'><?php echo form_error('message');?></span>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-10">
<!--                   <button type="submit" name='conf' class="btn btn-success btn-lg">内容を確認して送信</button> -->
                  <?php echo form_submit('conf', '内容を確認して送信',array('class' => 'btn btn-success btn-lg')); ?>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>