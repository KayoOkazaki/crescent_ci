    <script>
    	$(function(){
        	$('.v').hover(
              function(){
              	$(this).text('detail_v.php');
              },
              function(){
               	$(this).text('View');
              }
            );
        	$('.c').hover(
             function(){
              	$(this).text('Home.php');
             },
             function(){
                $(this).text('Controller');
             }
           );

        });
    </script>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <nav>
            <h1 class="page-header">Product</h1>
            <a class="button c" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/controllers/Home.php">Controller</a>&nbsp&nbsp
            <a class="button v" target="_blank" href="https://github.com/KayoOkazaki/crescent_ci/blob/master/application/views/detail_v.php">View</a>&nbsp&nbsp
            <ol class="breadcrumb">
              <li><a href="<?php echo base_url('home')?>">Home</a></li>
              <li class="active">Product</li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="item">
            <img class="mainImage img-responsive" src="<?php echo base_url('images/products/'.$item->image1);?>" alt="">
          </div>
          <div class="row product-thumbnails">
            <div class="col-xs-2 col-sm-2 col-md-3"><img src="<?php echo base_url('images/products/'.$item->image1);?>" class="img-responsive thumb" alt=""></div>
            <div class="col-xs-2 col-sm-2 col-md-3"><img src="<?php echo base_url('images/products/'.$item->image2);?>" class="img-responsive thumb" alt=""></div>
            <div class="col-xs-2 col-sm-2 col-md-3"><img src="<?php echo base_url('images/products/'.$item->image3);?>" class="img-responsive thumb" alt=""></div>
            <div class="col-xs-2 col-sm-2 col-md-3"><img src="<?php echo base_url('images/products/'.$item->image4);?>" class="img-responsive thumb" alt=""></div>
          </div>
        </div>
        <div class="col-md-6">
         <div class="product-detail">
          <h2><?php echo $item->product_name; ?></h2>
          <p>CE59612 ESPP-HB BR</p>
          <hr class="page-divider"/>
          <p><?php echo '販売価格 ¥'.number_format($item->price).'(税込）'; ?></p>
          <hr class="page-divider"/>
          <div class="product-text">
            <h3>商品について</h3>
            <p><?php echo $item->description; ?></p>
          </div>
          <hr class="page-divider"/>
          <form action="#" class="variable" method="post">
            <div class="form-group selectpicker-wrapper">
              <label for="select1">サイズ</label>
              <select id="select1" class="selectpicker input-price form-control" data-live-search="true" data-width="50%" data-toggle="tooltip" title="Select">
                <option>サイズを選択してください</option>
                <option>23.5</option>
                <option>24.0</option>
                <option>24.5</option>
                <option>25.0</option>
                <option>25.5</option>
                <option>26.0</option>
                <option>26.5</option>
                <option>27.0</option>
                <option>27.5</option>
                <option>28.0</option>
              </select>
            </div>
            <hr class="page-divider"/>
            <div class="quantity form-group">
              <button class="btn"><i class="fa fa-minus"></i></button>
              <input class="form-control qty" type="number" step="1" min="1" name="quantity" value="1" title="Qty">
              <button class="btn"><i class="fa fa-plus"></i></button>
              <button class="btn btn-theme btn-cart btn-icon-left" type="submit"><i class="fa fa-shopping-cart"></i> カートに入れる</button>
            </div>
          </form>
          <hr class="page-divider"/>
          <div class="detail-table">
            <h3>商品詳細</h3>
            <table>
              <tr>
                <th>色</th>
                <td><?php echo $item->color; ?></td>
              </tr>
              <tr>
                <th>仕様</th>
                <td><?php echo $item->material; ?></td>
              </tr>
              <tr>
                <th>サイズ</th>
                <td><?php echo $item->min_size; ?>～<?php echo $item->max_size; ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>