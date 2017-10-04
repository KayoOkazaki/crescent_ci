    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <nav>
            <h1 class="page-header">Online Shop</h1>
            <a class="button" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/controllers/Home.php">Controller</a>&nbsp&nbsp
            <a class="button" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/views/shop_v.php">View</a>&nbsp&nbsp
            <a class="button" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/models/Product_model.php">Model</a>
            <ol class="breadcrumb">
              <li><a href="<?php echo base_url('home')?>">Home</a></li>
              <li class="active">Online Shop</li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="row">
      <?php foreach($items as $item): ?>
        <div class="col-md-4 text-center">
          <a href="<?php echo base_url('home/detail_c/'.$item->id)?>">
            <div class="thumbnail">
              <img class="img-responsive" src="<?php echo base_url('images/products/'.$item->main_img);?>" height="500" width="750" alt="">
              <div class="caption">
                <h2 class="h4"><?php echo $item->product_code; ?><br>
                  <small><?php echo '￥'.number_format($item->price).'(税込）'; ?></small>
                </h2>
              </div>
            </div>
          </a>
        </div>
       <?php endforeach; ?>
      </div>
    </div>