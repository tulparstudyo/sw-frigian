<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2012
 * @copyright Aimeos (aimeos.org), 2015-2020 
 */

$enc = $this->encoder();

$basketTarget = $this->config( 'client/html/basket/standard/url/target' );
$basketController = $this->config( 'client/html/basket/standard/url/controller', 'basket' );
$basketAction = $this->config( 'client/html/basket/standard/url/action', 'index' );
$basketConfig = $this->config( 'client/html/basket/standard/url/config', [] );

$checkoutTarget = $this->config( 'client/html/checkout/standard/url/target' );
$checkoutController = $this->config( 'client/html/checkout/standard/url/controller', 'checkout' );
$checkoutAction = $this->config( 'client/html/checkout/standard/url/action', 'index' );
$checkoutConfig = $this->config( 'client/html/checkout/standard/url/config', [] );

$optTarget = $this->config( 'client/jsonapi/url/target' );
$optCntl = $this->config( 'client/jsonapi/url/controller', 'jsonapi' );
$optAction = $this->config( 'client/jsonapi/url/action', 'options' );
$optConfig = $this->config( 'client/jsonapi/url/config', [] );


?>
<section class="aimeos basket-standard" data-jsonurl="<?= $enc->attr( $this->url( $optTarget, $optCntl, $optAction, [], [], $optConfig ) ); ?>">

	<?php if( isset( $this->standardErrorList ) ) : ?>

		<main id="main-container" class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-content">
                        <h5 class="section-content__title"><?= $enc->html( $this->translate( 'client', 'Your Cart Items' ), $enc::TRUST ); ?></h5>
                    </div>
                    <div class="error-list empty-cart m-t-40 text-center">
                        <div class="empty-cart-icon title--large"><i class="fal fa-shopping-cart"></i></div>

						<?php foreach( (array) $this->standardErrorList as $errmsg ) : ?>
                        <h3 class="error-item title title--normal title--thin m-tb-30"><?= $enc->html( $errmsg ); ?></h3>
						<?php endforeach; ?>
                       
                    </div>
                </div>
            </div>
        </div>
    </main>

	<?php endif; ?>




	<?php if( isset( $this->standardBasket ) ) : ?>
		

		<form method="POST" action="<?= $enc->attr( $this->url( $basketTarget, $basketController, $basketAction, [], [], $basketConfig ) ); ?>">
			<?= $this->csrf()->formfield(); ?>


			<div class="common-summary-detail">
				<div class="header">
					<h4><?= $enc->html( $this->translate( 'client', 'Your Cart Items' ), $enc::TRUST ); ?></h4>
				</div>

				<div class="basket table-responsive">
					<?= $this->partial(
						/** client/html/basket/standard/summary/detail
						 * Location of the detail partial template for the basket standard component
						 *
						 * To configure an alternative template for the detail partial, you
						 * have to configure its path relative to the template directory
						 * (usually client/html/templates/). It's then used to display the
						 * product detail block in the basket standard component.
						 *
						 * @param string Relative path to the detail partial
						 * @since 2017.01
						 * @category Developer
						 */
						$this->config( 'client/html/basket/standard/summary/detail', 'common/summary/detail-standard' ),
						array(
							'summaryEnableModify' => true,
							'summaryBasket' => $this->standardBasket,
							'summaryTaxRates' => $this->get( 'standardTaxRates', [] ),
							'summaryNamedTaxes' => $this->get( 'standardNamedTaxes', [] ),
							'summaryErrorCodes' => $this->get( 'standardErrorCodes', [] ),
							'summaryCostsPayment' => $this->get( 'standardCostsPayment', 0 ),
							'summaryCostsDelivery' => $this->get( 'standardCostsDelivery', 0 ),
						)
					); ?>
				</div>
			</div>

		<?php if(!isset( $this->standardErrorList ) ) : ?>
	
        <div class="sidebar__widget m-t-20">	
			<div class="basket-standard-coupon">
				<div class="header">
				
				</div>
				
				<div class="content">
					<?php $coupons = $this->standardBasket->getCoupons(); ?>
					<span><?= $enc->html( $this->translate( 'client', '*Enter your coupon code if you have one.' ), $enc::TRUST ); ?></span>
					<div class="form-box__single-group coupon-new">
				
						<input class="form-control coupon-code" name="<?= $enc->attr( $this->formparam( 'b_coupon' ) ); ?>" type="text" maxlength="255" /><!--
						-->
						<div class="from-box__buttons">
						<button class=" btn--box btn--small btn--green btn--green-hover-black btn--uppercase font--semi-bold" type="submit"><?= $enc->html( $this->translate( 'client', '+' ) ); ?></button>
					</div>
				</div>

					<?php if( !$coupons->isEmpty() ) : ?>
						<ul class="attr-list">
							<?php foreach( $coupons as $code => $products ) : $params = array( 'b_action' => 'coupon-delete', 'b_coupon' => $code ); ?>
							<li class="attr-item">
								<span class="coupon-code"><?= $enc->html( $code ); ?></span>
								<a class="minibutton delete" href="<?= $enc->attr( $this->url( $basketTarget, $basketController, $basketAction, $params, [], $basketConfig ) ); ?>"><i class="fa fa-times"></i></a>
							</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					
			</div>
		</div>
	</div>
	<?php endif; ?>


			<div class="button-group m-tb-25">

				<?php if( isset( $this->standardBackUrl ) ) : ?>
					<a style= "color:white!important;" class=" btn-back btn--box btn--small btn--radius btn--black btn--green-hover-black btn--uppercase font--semi-bold" href="<?= $enc->attr( $this->standardBackUrl ); ?>">
						<?= $enc->html( $this->translate( 'client', 'Continue Shopping' ), $enc::TRUST ); ?>
					</a>

					<?php else : ?>
					<a style= "color:white!important;" class=" btn-back btn--box btn--small btn--radius btn--black btn--green-hover-black btn--uppercase font--semi-bold" href="/">
						<?= $enc->html( $this->translate( 'client', 'Continue Shopping' ), $enc::TRUST ); ?>
					</a>
					
				<?php endif; ?>

				<?php /*<button class="btn btn--box btn--small btn--radius btn--black btn--green-hover-black btn--uppercase font--semi-bold" type="submit">
					<?= $enc->html( $this->translate( 'client', 'Update' ), $enc::TRUST ); ?>
				</button> */?>

				<?php if( $this->get( 'standardCheckout', false ) === true ) : ?>
					<a  style= "color:white!important;" class=" btn--box btn--small btn--radius btn--green btn--black-hover-green btn--uppercase font--semi-bold"
						href="<?= $enc->attr( $this->url( $checkoutTarget, $checkoutController, $checkoutAction, [], [], $checkoutConfig ) ); ?>">
						<?= $enc->html( $this->translate( 'client', 'Checkout' ), $enc::TRUST ); ?>
					</a>

					<?php else : ?>
					<input type="hidden" name="<?= $enc->attr( $this->formparam( 'b_action' ) ) ?>" value="1" />
					<button class="btn--box btn--small btn--radius btn--green btn--black-hover-green btn--uppercase font--semi-bold" type="submit">
						<?= $enc->html( $this->translate( 'client', 'Check' ), $enc::TRUST ); ?>
					</button>
				<?php endif; ?>

			
			

			</div>
		</form>

	<?php endif; ?>


</section>
