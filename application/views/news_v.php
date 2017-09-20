    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <nav>
            <h1 class="page-header">News</h1>
            <ol class="breadcrumb">
              <li><a href="<?php echo base_url('home');?>">Home</a></li>
              <li class="active">News</li>
            </ol>
          </nav>
        </div>
      </div>
    <div id="pages">
   		<?php echo $this->pagination->create_links(); ?>
	</div>
    <div class="row">
      <div class="col-md-9 col-xs-12 margin-top-md">

      <?php foreach ($items as $item): ?>
        <div class="well well-lg">
          <div class="media">
            <a class="pull-left">
              <img class="media-object" src="<?php echo base_url('images/press/'.$item->image);?>" height="64" width="64" alt="">
            </a>
            <div class="media-body">
              <h4 class="media-heading"><?php echo $item->title; ?>
                <small><?php echo $item->posted; ?></small>
              </h4>
				<?php echo $item->message; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="col-md-3 col-xs-12">
    <div class="row">
      <div class="margin-top-md col-xs-6 col-md-12"><a href="#"><img class="img-responsive center-block" src="images/banner01.jpg" alt=""></a></div>
      <div class="margin-top-md col-xs-6 col-md-12"><a href="#"><img class="img-responsive center-block" src="images/banner02.jpg" alt=""></a></div>
      <div class="margin-top-md col-xs-6 col-md-12"><a href="#"><img class="img-responsive center-block" src="images/banner03.jpg" alt=""></a></div>
      <div class="margin-top-md col-xs-6 col-md-12"><a href="#"><img class="img-responsive center-block" src="images/banner04.jpg" alt=""></a></div>
    </div>
  </div>
</div><!-- /row-->
    </div>
