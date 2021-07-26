<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2012
 * @copyright Aimeos (aimeos.org), 2015-2020
 */

$enc = $this->encoder(); 

$target = $this->config( 'client/html/catalog/lists/url/target' );
$cntl = $this->config( 'client/html/catalog/lists/url/controller', 'catalog' );
$action = $this->config( 'client/html/catalog/lists/url/action', 'list' );
$config = $this->config( 'client/html/catalog/lists/url/config', [] );

$optTarget = $this->config( 'client/jsonapi/url/target' );
$optCntl = $this->config( 'client/jsonapi/url/controller', 'jsonapi' );
$optAction = $this->config( 'client/jsonapi/url/action', 'options' );
$optConfig = $this->config( 'client/jsonapi/url/config', [] );

$textTypes = $this->config( 'client/html/catalog/lists/head/text-types', array( 'short', 'long' ) );
$catalog_lists = $this->get( 'catalog_lists', map() );

?>
<?php if($catalog_lists){ ?>
    <?php foreach($catalog_lists as $code => $catalog_list){?>
        <?php if(frigian_option('show_'.$code.'_products') && $catalog_list['listProductItems'] != ''){ ?>  
            <div class="product m-t-30"> 
  <div class="container">
    <div class="row">
      <div class="col-12"> 
        <!-- Start Section Title -->
        <div class="section-content section-content--border m-b-35">
          <h5 class="section-content__title"><?=$this->translate( 'client', $catalog_list['label'].' Products' )?></h5>
          <a href="<?= $enc->attr( $this->link( 'client/html/catalog/tree/url', ['f_catid' => $this->homeTree->getId(), 'f_name' => $this->homeTree->getName( 'url' )] ) ) ?>" class="btn btn--icon-left btn--small btn--radius btn--transparent btn--border-green btn--border-green-hover-green font--regular text-capitalize"><?= $this->translate( 'client', 'More Products' ); ?><i class="fal fa-angle-right"></i></a> </div>
        <!-- End Section Title --> 
      </div> 
    </div>
    <div class="row">
      <div class=" home-product catalog-list col-12">
        <div class="default-slider default-slider--hover-bg-red product-default-slider">
          <div class="product-default-slider-4grid-1rows gap__col--30 gap__row--40 row">

                                <?php foreach($catalog_list['listProductItems']  as $product ){ 
                                        echo $this->partial( $this->config( 'client/html/common/partials/product', 'common/partials/product-standard' ),
                                            array(
                                                'require-stock' => (bool) $this->config( 'client/html/basket/require-stock', true ),
                                                'basket-add' => $this->config( 'client/html/catalog/product/basket-add', false ),
                                                'product' => $product,
                                            )
                                        );			  
                                }?> 

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <?php }?>  
    <?php }?>
<?php }?>

