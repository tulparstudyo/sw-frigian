<?php
/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2020
 */
$enc = $this->encoder();
$target = $this->config( 'client/html/catalog/lists/url/target' );
$cntl = $this->config( 'client/html/catalog/lists/url/controller', 'catalog' );
$action = $this->config( 'client/html/catalog/lists/url/action', 'list' );
$config = $this->config( 'client/html/catalog/lists/url/config', [] );
?>
<?php $this->block()->start( 'catalog/filter/price' ); ?>
<?php if( $this->get( 'propertyHigh', 0 ) ) : ?>
	<section class="catalog-filter-price col">
    <div class="sidebar__box">
                                <h5 class="sidebar__title">
                                
                                <?= $enc->html( $this->translate( 'client', '  Filter by Price' ), $enc::TRUST ); ?>
                              </h5>
                            </div>
		<div class="price-lists">
			
			<fieldset>
				<div class="price-input">
					<input type="number" class="price-low" name="<?= $this->formparam( ['f_price', 0] )?>"
						min="0" max="<?= $enc->html( $this->get( 'propertyHigh', 0 ) ) ?>" step="1"
						value="<?= $enc->html( $this->param( 'f_price/0', 0 ) ) ?>">
					<input type="range" class="price-slider" name="<?= $this->formparam( ['f_price', 1] )?>"
						min="0" max="<?= $enc->html( $this->get( 'propertyHigh', $this->param( 'f_price/1', 0 ) ) ) ?>" step="1"
						value="<?= $enc->html( $this->param( 'f_price/1', $this->get( 'propertyHigh', 0 ) ) ) ?>">
					<input type="number" class="price-high" name="<?= $this->formparam( ['f_price', 1] )?>"
						min="0" max="<?= $enc->html( $this->get( 'propertyHigh', 0 ) ) ?>" step="1"
						value="<?= $enc->html( $this->param( 'f_price/1', $this->get( 'propertyHigh', 0 ) ) ) ?>">
				
				</div>
				<button style="padding:5px" type="submit" class="btn   btn--green btn--black-hover-green font--semi-bold"><?= $enc->html( $this->translate( 'client', 'Save' ) ) ?></button>
				<?php if( $this->param( 'f_price' ) ) : ?>
				<a style="padding:5px; color:white;" class="btn  btn--black font--semi-bold" href="<?= $enc->attr( $this->url( $target, $cntl, $action, $this->get( 'priceResetParams', [] ), [], $config ) ); ?>">
					<?= $enc->html( $this->translate( 'client', 'Reset' ) ) ?>
				</a>
				<?php endif ?>
			</fieldset>
    
		</div>
	</section>
<?php endif ?>
<?php $this->block()->stop(); ?>
<?= $this->block()->get( 'catalog/filter/price' ); ?>
