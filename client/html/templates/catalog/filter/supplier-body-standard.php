<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2018-2020
 */

$enc = $this->encoder();


$listTarget = $this->config( 'client/html/catalog/lists/url/target' );
$listController = $this->config( 'client/html/catalog/lists/url/controller', 'catalog' );
$listAction = $this->config( 'client/html/catalog/lists/url/action', 'list' );
$listConfig = $this->config( 'client/html/catalog/lists/url/config', [] );


?>
<?php $this->block()->start( 'catalog/filter/supplier' ); ?>
<?php if( !$this->get( 'supplierList', map() )->isEmpty() ) : ?>
	<section class="catalog-filter-supplier m-t-40">

    
    <div class="sidebar__box">
                                <h5 class="sidebar__title">
                                
                                <?= $enc->html( $this->translate( 'client', 'Suppliers' ), $enc::TRUST ); ?>
                              </h5>
                            </div>


		<div class="supplier-lists">
			<?php /*<?php if( $this->param( 'f_supid' ) ) : ?>
				<a class="btn btn  btn--black  font--semi-bold supplier-selected" href="<?= $enc->attr( $this->url( $listTarget, $listController, $listAction, $this->get( 'supplierResetParams', [] ), [], $listConfig ) ); ?>">
					<?= $enc->html( $this->translate( 'client', 'Reset' ), $enc::TRUST ); ?>
				</a>
			<?php endif; ?>*/?>

			<fieldset>
				<ul class="attr-list"><!--

					<?php foreach( $this->get( 'supplierList', [] ) as $id => $supplier ) : ?>
						--><li class="attr-item" data-id="<?= $enc->attr( $id ); ?>">

							<input class="attr-item" type="checkbox"
								id="sup-<?= $enc->attr( $id ); ?>"
								name="<?= $enc->attr( $this->formparam( ['f_supid', ''] ) ); ?>"
								value="<?= $enc->attr( $id ); ?>"
								<?= ( in_array( $id, $this->param( 'f_supid', [] ) ) ? 'checked="checked"' : '' ); ?>
							/>

							<label class="attr-name" for="sup-<?= $enc->attr( $id ); ?>"><!--
								--><div class="media-list"><!--

									<?php foreach( $supplier->getRefItems( 'media', 'icon', 'default' ) as $mediaItem ) : ?>
										<?= '-->' . $this->partial(
											$this->config( 'client/html/common/partials/media', 'common/partials/media-standard' ),
											array( 'item' => $mediaItem, 'boxAttributes' => array( 'class' => 'media-item' ) )
										) . '<!--'; ?>
									<?php endforeach; ?>

								--></div>
								<span><?= $enc->html( $supplier->getName(), $enc::TRUST ); ?></span><!--
							--></label>
						</li><!--
					<?php endforeach; ?>

				--></ul>
			</fieldset>
		</div>

		<?php if( $this->config( 'client/html/catalog/filter/standard/button', true ) ) : ?>
			<noscript>
				<button class="filter btn btn-primary" type="submit">
					<?= $enc->html( $this->translate( 'client', 'Show' ), $enc::TRUST ); ?>
				</button>
			</noscript>
		<?php endif; ?>

	</section>
<?php endif; ?>
<?php $this->block()->stop(); ?>
<?= $this->block()->get( 'catalog/filter/supplier' ); ?>
