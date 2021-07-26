<?php

$favorite_product=frigian_favorite_products();
$watch_product=frigian_watch_products();

//dd($favoriler);

$enc = $this->encoder();
$position = $this->get( 'position' );
$detailTarget = $this->config( 'client/html/catalog/detail/url/target' );
$detailController = $this->config( 'client/html/catalog/detail/url/controller', 'catalog' );
$detailAction = $this->config( 'client/html/catalog/detail/url/action', 'detail' );
$detailConfig = $this->config( 'client/html/catalog/detail/url/config', [] ); 
$detailFilter = array_flip( $this->config( 'client/html/catalog/detail/url/filter', ['d_prodid'] ) );
$basketTarget = $this->config( 'client/html/basket/standard/url/target' );
$basketController = $this->config( 'client/html/basket/standard/url/controller', 'basket' );
$basketAction = $this->config( 'client/html/basket/standard/url/action', 'index' );
$basketConfig = $this->config( 'client/html/basket/standard/url/config', [] );
$basketSite = $this->config( 'client/html/basket/standard/url/site' );
$watchTarget = $this->config( 'client/html/account/watch/url/target' );
$watchController = $this->config( 'client/html/account/watch/url/controller', 'account' );
$watchAction = $this->config( 'client/html/account/watch/url/action', 'watch' );
$watchConfig = $this->config( 'client/html/account/watch/url/config', [] );
$pinTarget = $this->config( 'client/html/catalog/session/pinned/url/target' );
$pinController = $this->config( 'client/html/catalog/session/pinned/url/controller', 'catalog' );
$pinAction = $this->config( 'client/html/catalog/session/pinned/url/action', 'detail' );
$pinConfig = $this->config( 'client/html/catalog/session/pinned/url/config', [] );
$favTarget = $this->config( 'client/html/account/favorite/url/target' );
$favController = $this->config( 'client/html/account/favorite/url/controller', 'account' );
$favAction = $this->config( 'client/html/account/favorite/url/action', 'favorite' );
$favConfig = $this->config( 'client/html/account/favorite/url/config', [] );
$productItem = $this->get('product');
//print_r($productItem->getId());

//print_r( get_class_methods($productItem));
$price= $productItem->getRefItems( 'price', null, 'default' );
//dd($price->getValue()->first()); 
if($productItem ){
	$params = array_diff_key( ['d_name' => $productItem->getName( 'url' ), 'd_prodid' => $productItem->getId(), 'd_pos' => $position !== null ? $position++ : ''], $detailFilter ); 
?>



<!-- Start Single Default Product -->
<?php if($price->getValue()->first() > 0 ) :?>
    <div class="col-md-4 col-12"> 
<div class="product__box product__default--single text-center"> 
	
  <!-- Start Product Image -->
  <div class="product__img-box  pos-relative"> <a href="<?= $enc->attr( $this->url( ( $productItem->getTarget() ?: $detailTarget ), $detailController, $detailAction, $params, [], $detailConfig ) ); ?>" class="product__img--link"> 
	  <?php if( ( $mediaItem = $productItem->getRefItems( 'media', 'default', 'default' )->first() ) !== null ) : ?>
	  <div class="product__img img-fluid" style=" background-image: url(<?= $enc->attr( $this->content( $mediaItem->getPreview() ) ); ?>);" alt="<?= $enc->attr( $mediaItem->getName() ); ?>" alt=""></div>
	  <?php else: ?>
	  <img class="product__img img-fluid" src="<?=frigian_url('assets/img/product/size-normal/product-home-1-img-1.jpg') ?>" alt="">  
	  <?php endif; ?>
    </a><!-- End Product Image --> 
    
    <!-- Start Product Action Link-->
    <?php	$urls = array(
	'pin' => $this->url( $pinTarget, $pinController, $pinAction, ['pin_action' => 'add', 'pin_id' => $productItem->getId(), 'd_name' => $productItem->getName( 'url' )], $pinConfig ),
    'watch' => $this->url( $watchTarget, $watchController, $watchAction, ['wat_action' => 'add', 'wat_id' => $productItem->getId(), 'd_name' => $productItem->getName( 'url' )], $watchConfig ),
    'favorite' => $this->url( $favTarget, $favController, $favAction, ['fav_action' => 'add', 'fav_id' => $productItem->getId(), 'd_name' => $productItem->getName( 'url' )], $favConfig ),
    );
    ?>
    <ul class="product__action--link pos-absolute">
   
        <li>
            <form method="POST" action="<?= $enc->attr( $this->url( $basketTarget, $basketController, $basketAction, ( $basketSite ? ['site' => $basketSite] : [] ), [], $basketConfig ) ); ?>">
			    <!-- catalog.detail.csrf -->
			    <?= $this->csrf()->formfield(); ?>
			    <!-- catalog.detail.csrf -->
			    <?php if( $basketSite ) : ?>
			    <input type="hidden" name="<?= $this->formparam( 'site' ) ?>" value="<?= $enc->attr( $basketSite ) ?>" />
                <?php endif ?>
               
                <div class="stock-list">
			        <div class="articleitem stock-actual"
				        data-prodid="<?= $enc->attr( $productItem->getId() ); ?>"
				        data-prodcode="<?= $enc->attr( $productItem->getCode() ); ?>">
				    </div>
			        <?php foreach( $productItem->getRefItems( 'product', null, 'default' ) as $articleId => $articleItem ) : ?>
				    <div class="articleitem"
					    data-prodid="<?= $enc->attr( $articleId ); ?>"
					    data-prodcode="<?= $enc->attr( $articleItem->getCode() ); ?>">
				    </div>
			        <?php endforeach; ?>
                </div>
                <?php if( !$productItem->getRefItems( 'price', 'default', 'default' )->empty() ) : ?>
                    <div class="product-quantity product-var__item d-flex align-items-center">
                        <span class="product-var__text"></span>
                        <input type="hidden" value="add" name="<?= $enc->attr( $this->formparam( 'b_action' ) ); ?>" />
				    	<input type="hidden"
				    		name="<?= $enc->attr( $this->formparam( ['b_prod', 0, 'prodid'] ) ); ?>"
				    		value="<?= $enc->attr( $productItem->getId() ); ?>"
				    	/>
        
                        <div class="quantity-scale ">
                                            
                            <input type="hidden" id="number" <?= !$productItem->isAvailable() ? 'disabled' : '' ?>
                            name="<?= $enc->attr( $this->formparam( ['b_prod', 0, 'quantity'] ) ); ?>"
				    		min="<?= $productItem->getScale() ?>" max="2147483647"
				    		step="<?= $productItem->getScale() ?>" maxlength="10"
				    		value="1" required="required" />
                                      
                        </div>
                    </div>
                    <div class="product-var__item button" >
                        <button type="submit" class=""
                        <?= !$productItem->isAvailable() ? 'disabled' : '' ?>>
                        <li><a class="btn btn--round btn--round-size-small btn--green btn--green-hover-black" > 
                            <i class="fa fa-shopping-cart "></i>
                            </a>
			            </li>
                        </button>         
                    </div>     
                <?php endif; ?>			
            </form> 
        </li>
        <?php $params_fav = ['fav_action' => 'delete', 'fav_id' => $productItem->getId()] + $this->get( 'favoriteParams', [] ); ?>
    	<?php $params_watch = ['wat_action' => 'delete', 'wat_id' => $productItem->getId()] + $this->get( 'watchParams', [] ); ?>
						
    <?php 
	$icons = array('pin'=>'fa-map-pin','watch'=>'fa-eye','favorite'=>'fa-heart');
	 foreach( $this->config( 'client/html/catalog/actions/list', [ 'pin', 'favorite', 'watch'] ) as $entry ) : ?>
		<?php if( isset( $urls[$entry] ) ) : ?>
            <li class="<?= $entry?>">
            <?php 
            $fav_class = '';
            foreach( $favorite_product as $listItem ) {
                $fav_id=$listItem->getRefId(); 
                 if($entry == "favorite" && $fav_id == $productItem->getId() ) {
                    $fav_class = 'fav-added';
                } 
            }?>

            <?php 
            $watch_class = '';
            foreach( $watch_product as $listItem ) {
                $watch_id=$listItem->getRefId(); 
                 if($entry == "watch" && $watch_id == $productItem->getId() ) {
                    $fav_class = 'watch-added';
                } 
            }?>
               

                <a  href="<?= $enc->attr( $urls[$entry] );  ?> " class="<?=$fav_class?> <?=$watch_class?> btn btn--round btn--round-size-small btn--green btn--green-hover-black" data-add="<?= $enc->attr( $urls[$entry] );  ?> " data-remove="<?= $enc->attr( $this->url( $favTarget, $favController, $favAction, $params_fav, [], $favConfig ) ); ?> " 
                data-remove-watch="<?= $this->url( $watchTarget, $watchController, $watchAction, $params_watch, [], $watchConfig ); ?> " 
                title="<?= $enc->attr( $this->translate( 'client/code', $entry ) ); ?>" data-toggle="tooltip" target="_blank" title="" 
                data-original-title="<?= $enc->attr( $entry ); ?>">   
                    <i class="fa <?= @$icons[$enc->attr( $entry )]; ?>"></i>
                </a>
            </li>        
		<?php endif; ?>
	  <?php endforeach; ?>
    </ul>
    <!-- End Product Action Link --> 
  </div>

   
  
  <!-- Start Product Content -->
  <div class="product__content">
    <ul class="product__review">
    <?php if( $productItem->getRating() > 0 ) : ?>
		<?= str_repeat( '<li class="product__review--fill"><i class="fa fa-star"></i></li>', (int) round( $productItem->getRating() ) ) ?>
    <?php endif ?> 
    <?php if( $productItem->getRating() <= 0 ) : ?>
		<li class="product__review--fill"><i class="far fa-star"></i></li>
        <li class="product__review--fill"><i class="far fa-star"></i></li>
        <li class="product__review--fill"><i class="far fa-star"></i></li>
        <li class="product__review--fill"><i class="far fa-star"></i></li>
        <li class="product__review--fill"><i class="far fa-star"></i></li>
        <?php endif ?> 
    </ul>
    <a href="<?= $enc->attr( $this->url( ( $productItem->getTarget() ?: $detailTarget ), $detailController, $detailAction, $params, [], $detailConfig ) ); ?>" class="product__link"><?= $enc->html( $productItem->getName(), $enc::TRUST ); ?></a>
        <?= $this->partial(
            $this->config( 'client/html/common/partials/price', 'common/partials/price-standard' ),
            ['prices' => $productItem->getRefItems( 'price', null, 'default' )]
        ); ?>


	      
  </div>
  <!-- End Product Content --> 
</div>
<!-- End Single Default Product --> 
</div>
<?php endif;?>
<?php 
}
?>
