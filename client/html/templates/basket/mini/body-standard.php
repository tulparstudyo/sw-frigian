<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2013
 * @copyright Aimeos (aimeos.org), 2015-2020
 */

$enc = $this->encoder();


/** client/html/basket/standard/url/target
 * Destination of the URL where the controller specified in the URL is known
 *
 * The destination can be a page ID like in a content management system or the
 * module of a software development framework. This "target" must contain or know
 * the controller that should be called by the generated URL.
 *
 * @param string Destination of the URL
 * @since 2014.03
 * @category Developer
 * @see client/html/basket/standard/url/controller
 * @see client/html/basket/standard/url/action
 * @see client/html/basket/standard/url/config
 * @see client/html/basket/standard/url/site
 */
$basketTarget = $this->config( 'client/html/basket/standard/url/target' );

/** client/html/basket/standard/url/controller
 * Name of the controller whose action should be called
 *
 * In Model-View-Controller (MVC) applications, the controller contains the methods
 * that create parts of the output displayed in the generated HTML page. Controller
 * names are usually alpha-numeric.
 *
 * @param string Name of the controller
 * @since 2014.03
 * @category Developer
 * @see client/html/basket/standard/url/target
 * @see client/html/basket/standard/url/action
 * @see client/html/basket/standard/url/config
 * @see client/html/basket/standard/url/site
 */
$basketController = $this->config( 'client/html/basket/standard/url/controller', 'basket' );

$checkoutTarget = $this->config( 'client/html/checkout/standard/url/target' );
$checkoutController = $this->config( 'client/html/checkout/standard/url/controller', 'checkout' );
$checkoutAction = $this->config( 'client/html/checkout/standard/url/action', 'index' );
$checkoutConfig = $this->config( 'client/html/checkout/standard/url/config', [] );


/** client/html/basket/standard/url/action
 * Name of the action that should create the output
 *
 * In Model-View-Controller (MVC) applications, actions are the methods of a
 * controller that create parts of the output displayed in the generated HTML page.
 * Action names are usually alpha-numeric.
 *
 * @param string Name of the action
 * @since 2014.03
 * @category Developer
 * @see client/html/basket/standard/url/target
 * @see client/html/basket/standard/url/controller
 * @see client/html/basket/standard/url/config
 * @see client/html/basket/standard/url/site
 */
$basketAction = $this->config( 'client/html/basket/standard/url/action', 'index' );

/** client/html/basket/standard/url/config
 * Associative list of configuration options used for generating the URL
 *
 * You can specify additional options as key/value pairs used when generating
 * the URLs, like
 *
 *  client/html/<clientname>/url/config = array( 'absoluteUri' => true )
 *
 * The available key/value pairs depend on the application that embeds the e-commerce
 * framework. This is because the infrastructure of the application is used for
 * generating the URLs. The full list of available config options is referenced
 * in the "see also" section of this page.
 *
 * @param string Associative list of configuration options
 * @since 2014.03
 * @category Developer
 * @see client/html/basket/standard/url/target
 * @see client/html/basket/standard/url/controller
 * @see client/html/basket/standard/url/action
 * @see client/html/basket/standard/url/site
 * @see client/html/url/config
 */
$basketConfig = $this->config( 'client/html/basket/standard/url/config', [] );

/** client/html/basket/standard/url/site
 * Locale site code where products will be added to the basket
 *
 * In more complex setups with several shop sites, this setting allows to to
 * define the shop site that will manage the basket of the customer. For example
 * in market place setups where all vendors have there own shop sites, the basket
 * site should be the site code of the market place ("default" by default).
 *
 * @param string Code of the locale site
 * @since 2018.04
 * @category Developer
 * @see client/html/basket/standard/url/target
 * @see client/html/basket/standard/url/controller
 * @see client/html/basket/standard/url/config
 */
$basketSite = $this->config( 'client/html/basket/standard/url/site' );

$detailTarget = $this->config( 'client/html/catalog/detail/url/target' );


$jsonTarget = $this->config( 'client/jsonapi/url/target' );
$jsonController = $this->config( 'client/jsonapi/url/controller', 'jsonapi' );
$jsonAction = $this->config( 'client/jsonapi/url/action', 'options' );
$jsonConfig = $this->config( 'client/jsonapi/url/config', [] );
$totalQuantity =0;

$pricefmt = $this->translate( 'client/code', 'price:default' );
/// Price format with price value (%1$s) and currency (%2$s)
$priceFormat = $pricefmt !== 'price:default' ? $pricefmt : $this->translate( 'client', '%1$s %2$s' );


?>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<div class="aimeos basket-mini" data-jsonurl="<?= $enc->attr( $this->url( $jsonTarget, $jsonController, $jsonAction, ( $basketSite ? ['site' => $basketSite] : [] ), [], $jsonConfig ) ); ?>">
<div  id="offcanvas-add-cart__box" class="basket-mini-product offcanvas offcanvas-cart offcanvas-add-cart">
            <div class="offcanvas__top">
                <span class="offcanvas__top-text"><i class="icon-shopping-cart"></i><?= $this->translate('client','My Cart') ?></span>
                <button class="offcanvas-close"><i class="fal fa-times"></i></button>
            </div>
            <!-- Start Add Cart Item Box-->
            <?php if( ( $errors = $this->get( 'miniErrorList', [] ) ) !== [] ) : ?>
		<ul class="error-list">
			<?php foreach( $errors as $error ) : ?>
				<li class="error-item"><?= $enc->html( $error ); ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
            <?php if( isset( $this->miniBasket ) ) : ?>
		<?php
			$quantity = 0;
			$priceItem = $this->miniBasket->getPrice();
			$priceCurrency = $this->translate( 'currency', $priceItem->getCurrencyId() );

			foreach( $this->miniBasket->getProducts() as $product ) {
				$quantity += $product->getQuantity();
			}
        ?>

     


       
            <ul class="offcanvas-add-cart__menu basket-body">
                <!-- Start Single Add Cart Item-->
                <li data-url="#" data-urldata="#" class="product prototype offcanvas-add-cart__list pos-relative d-flex align-items-center justify-content-between ">
<div class="offcanvas-add-cart__content d-flex align-items-start m-r-10">
<div class="offcanvas-add-cart__img-box pos-relative">
<a href="#" class="offcanvas-add-cart__img-link img-responsive">

<img class="product-image add-cart__img" src="#">


 
<span class="quantity offcanvas-add-cart__item-count pos-absolute"></span>
</a></div><a href="#" class="offcanvas-add-cart__img-link img-responsive">
</a><div class=" offcanvas-add-cart__detail"><a href="#" class="offcanvas-add-cart__img-link img-responsive">
</a><a href="#" class="name offcanvas-add-cart__link"></a>
<span class="price offcanvas-add-cart__price"></span>
   
</div>
</div>
<button class="offcanvas-add-cart__item-dismiss"><a class="delete" href="#"><i class="fal fa-times"></i></a>
</button>
</li>
                <?php foreach( $this->miniBasket->getProducts() as $pos => $product ) :  $totalQuantity += $product->getQuantity();?>
                    <?php
							$param = ['resource' => 'basket', 'id' => 'default', 'related' => 'product', 'relatedid' => $pos];
                            if( $basketSite ) { $param['site'] = $basketSite; }
                            
                            $params =  ['d_name' => $product->getName( 'url' ), 'd_prodid' => $product->getId()]; 
                        ?>
                        

                        <li 
							data-url="<?= $enc->attr( $this->url( $jsonTarget, $jsonController, $jsonAction, $param, [], $jsonConfig ) ); ?>"
                            data-urldata="<?= $enc->attr( $this->csrf()->name() . '=' . $this->csrf()->value() ); ?>" 
                            class="product  offcanvas-add-cart__list pos-relative d-flex align-items-center justify-content-between ">
                    <div class="offcanvas-add-cart__content d-flex align-items-start m-r-10">
                        <div class="offcanvas-add-cart__img-box pos-relative">
                            <a href="<?= $enc->attr( $this->url( ( $product->getTarget() ?: $detailTarget ), null, null, $params, [], [] ) ); ?>" class="offcanvas-add-cart__img-link img-responsive">
                                
                            <?php if( ( $url = $product->getMediaUrl() ) != '' ) : ?>
						<img class="product-image add-cart__img" src="<?= $enc->attr( $this->content( $url ) ); ?>" />
					<?php endif; ?>
                            
                            
                         
                            <span class="quantity offcanvas-add-cart__item-count pos-absolute">	<?= $enc->html( $product->getQuantity() ) ?>x</span>
                        </div>
                        <div class=" offcanvas-add-cart__detail">
                            <a href="<?= $enc->attr( $this->url( ( $product->getTarget() ?: $detailTarget ), null, null, $params, [], [] ) ); ?>" class="name offcanvas-add-cart__link">	<?= $enc->html( $product->getName(), $enc::TRUST ) ?></a>
                            <span class="price offcanvas-add-cart__price">	<?= $enc->html( sprintf( $priceFormat, $this->number( $product->getPrice()->getValue(), $product->getPrice()->getPrecision() ), $priceCurrency ) ); ?></span>
                           
                        </div>
                    </div>
                    <button class="offcanvas-add-cart__item-dismiss"><?php if( ( $product->getFlags() & \Aimeos\MShop\Order\Item\Base\Product\Base::FLAG_IMMUTABLE ) == 0 ) : ?>
									<a class="delete" href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
								<?php endif; ?></button>
                </li> <!-- Start Single Add Cart Item-->
        
                
				<?php endforeach; ?>
            </ul> <!-- Start Add Cart Item Box-->
            <!-- Start Add Cart Checkout Box-->
            <div class="offcanvas-add-cart__checkout-box-bottom">
                <!-- Start offcanvas Add Cart Checkout Info-->
                <ul class="offcanvas-add-cart__checkout-info">
                 
                    <!-- Start Single Add Cart Checkout Info-->
                    <li class="delivery offcanvas-add-cart__checkout-list">
                        <span class="offcanvas-add-cart__checkout-left-info">							
                        <?= $enc->html( $this->translate( 'client', 'Shipping' ), $enc::TRUST ); ?>
                        </span>
                        <span class="price offcanvas-add-cart__checkout-right-info">							
                        <?= $enc->html( sprintf( $priceFormat, $this->number( $priceItem->getCosts(), $priceItem->getPrecision() ), $priceCurrency ) ); ?>
                        </span>
                    </li> <!-- End Single Add Cart Checkout Info-->
              
                    <!-- Start Single Add Cart Checkout Info-->
                    <li class="total offcanvas-add-cart__checkout-list">
                        <span class="offcanvas-add-cart__checkout-left-info">							
                        <?= $enc->html( $this->translate( 'client', 'Total' ), $enc::TRUST ); ?>
                        </span>
                        <span class="price offcanvas-add-cart__checkout-right-info">
                        <?= $enc->html( sprintf( $priceFormat, $this->number( $priceItem->getValue() + $priceItem->getCosts(), $priceItem->getPrecision() ), $priceCurrency ) ); ?></span>
                    </li> <!-- End Single Add Cart Checkout Info-->
                </ul> <!-- End offcanvas Add Cart Checkout Info-->

      

                <div class="offcanvas-add-cart__btn-checkout">
                    <a href="<?= $enc->attr( $this->url( $checkoutTarget, $checkoutController, $checkoutAction, [], [], $checkoutConfig ) ); ?>" class="btn btn--block btn--radius btn--box btn--green btn--green-hover-black btn--large btn--uppercase font--bold">
                    <?= $enc->html( $this->translate( 'client', 'Checkout' ), $enc::TRUST ); ?></a>
                        
                
                </div>

                
                <div class="offcanvas-add-cart__btn-basket">
                    <a href="<?= $enc->attr( $this->url( $basketTarget, $basketController, $basketAction, ( $basketSite ? ['site' => $basketSite] : [] ), [], $basketConfig ) ); ?>" class="btn btn--block btn--radius btn--box btn--black btn--black-hover-green btn--large btn--uppercase font--bold">
                    <?= $enc->html( $this->translate( 'client', 'Go To Basket' ), $enc::TRUST ); ?></a>
                        
                
                </div>

                <?php endif; ?> 
            </div> <!-- End Add Cart Checkout Box-->
        </div> <!-- End Popup Add Cart -->


 
        <script>

        var quantity = "<?= $totalQuantity ?>";
        $(".pos-absolute-main.quantity").html(quantity);

        </script>


        </div>

