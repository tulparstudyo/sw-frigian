<?php
$enc = $this->encoder();
$products = frigian_top_products();

?>

<!-- ::::::  Start  Product Style - Default Section  ::::::  -->
<div class="product m-t-30">
  <div class="container">
    <div class="row">
      <div class="col-12"> 
        <!-- Start Section Title -->
        <div class="section-content section-content--border m-b-35" style="padding-bottom:35px">
          <h5 class="section-content__title"><?= $this->translate( 'client', 'Top products' ); ?></h5>
          <ul class="tablist tablist--style-blue tablist--style-gap-20 nav">
          </ul>
        </div>
        <!-- End Section Title --> 
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="tab-content tab-animate-zoom"> 
          <!-- Start Single Tab Item -->
          <div class="tab-pane show active" id="fruits">
            <div class="default-slider default-slider--hover-bg-red product-default-slider">
              <div class="product-default-slider-4grid-1rows gap__col--30 gap__row--40 row">
               
              <?php foreach($products  as $product ){ 

              // dd( $product);
                  echo $this->partial( $this->config( 'client/html/common/partials/product', 'common/partials/product-standard' ),
                    array(
                      'require-stock' => (bool) $this->config( 'client/html/basket/require-stock', true ),
                      'basket-add' => $this->config( 'client/html/catalog/product/basket-add', false ),
                      'product' => $product,
                      'position' => $this->get( 'itemPosition' )
                    )
                  );			  
              }?>  



              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- ::::::  End  Product Style - Default Section  ::::::  --> 

