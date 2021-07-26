<?php
/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2014
 * @copyright Aimeos (aimeos.org), 2015-2020
 */
$enc = $this->encoder();
/** client/html/catalog/session/pinned/url/target
 * Destination of the URL where the controller specified in the URL is known
 *
 * The destination can be a page ID like in a content management system or the
 * module of a software development framework. This "target" must contain or know
 * the controller that should be called by the generated URL.
 *
 * @param string Destination of the URL
 * @since 2014.09
 * @category Developer
 * @see client/html/catalog/session/pinned/url/controller
 * @see client/html/catalog/session/pinned/url/action
 * @see client/html/catalog/session/pinned/url/config
 */
$pinTarget = $this->config( 'client/html/catalog/session/pinned/url/target' );
/** client/html/catalog/session/pinned/url/controller
 * Name of the controller whose action should be called
 *
 * In Model-View-Controller (MVC) applications, the controller contains the methods
 * that create parts of the output displayed in the generated HTML page. Controller
 * names are usually alpha-numeric.
 *
 * @param string Name of the controller
 * @since 2014.09
 * @category Developer
 * @see client/html/catalog/session/pinned/url/target
 * @see client/html/catalog/session/pinned/url/action
 * @see client/html/catalog/session/pinned/url/config
 */
$pinController = $this->config( 'client/html/catalog/session/pinned/url/controller', 'catalog' );
/** client/html/catalog/session/pinned/url/action
 * Name of the action that should create the output
 *
 * In Model-View-Controller (MVC) applications, actions are the methods of a
 * controller that create parts of the output displayed in the generated HTML page.
 * Action names are usually alpha-numeric.
 *
 * @param string Name of the action
 * @since 2014.09
 * @category Developer
 * @see client/html/catalog/session/pinned/url/target
 * @see client/html/catalog/session/pinned/url/controller
 * @see client/html/catalog/session/pinned/url/config
 */
$pinAction = $this->config( 'client/html/catalog/session/pinned/url/action', 'detail' );
/** client/html/catalog/session/pinned/url/config
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
 * @since 2014.09
 * @category Developer
 * @see client/html/catalog/session/pinned/url/target
 * @see client/html/catalog/session/pinned/url/controller
 * @see client/html/catalog/session/pinned/url/action
 * @see client/html/url/config
 */
$pinConfig = $this->config( 'client/html/catalog/session/pinned/url/config', [] );
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

/** client/html/catalog/session/pinned/count/enable
 * Displays the number of pinned products in the header of the pinned list
 *
 * This configuration option enables or disables displaying the total number
 * of pinned products in the header of section. This increases the usability if
 * more than the shown products are available in the list but this depends on
 * the design of the site.
 *
 * @param integer Zero to disable the counter, one to enable it 
 * @since 2014.09
 * @category Developer
 * @see client/html/catalog/session/seen/count/enable
 */
  
?>
<?php $this->block()->start( 'catalog/session/pinned' ); ?>
<section class="catalog-session-pinned">
<?php  if($this->get( 'pinnedProductItems', [] ) ) : ?>
	<h1 class="header">
		<?= $this->translate( 'client', 'Pinned products' ); ?>
		<?php if( $this->config( 'client/html/catalog/session/pinned/count/enable', true ) ) : ?>
			<span class="count">(<?= count( $this->get( 'pinnedProductItems', [] ) ); ?>)</span>
		<?php endif; ?>
	</h1>
<?php endif; ?>
	<ul class="pinned-items row">
		<?php foreach( $this->get( 'pinnedProductItems', [] ) as $id => $productItem ) : ?>
			<?php $pinParams = ['pin_action' => 'delete', 'pin_id' => $id] + $this->get( 'pinnedParams', [] ); ?>
			<?php $detailParams = array_diff_key( ['d_name' => $productItem->getName( 'url' ), 'd_prodid' => $id, 'd_pos' => ''], $detailFilter ); ?>
			<li class="pinned-item">
				<a class="modify" href="<?= $this->url( $pinTarget, $pinController, $pinAction, $pinParams, [], $pinConfig ); ?>"><i class="fa fa-trash"></i></a>
				<a href="<?= $enc->attr( $this->url( $detailTarget, $detailController, $detailAction, $detailParams, [], $detailConfig ) ); ?>">
					<?php $mediaItems = $productItem->getRefItems( 'media', 'default', 'default' ); ?>
					<?php if( ( $mediaItem = $mediaItems->first() ) !== null ) : ?>
						<div class="media-item" style="background-image: url('<?= $this->content( $mediaItem->getPreview() ); ?>')"></div>
					<?php else : ?>
						<div class="media-item"></div>
					<?php endif; ?>
					<h3 class="product__link"><?= $enc->html( $productItem->getName(), $enc::TRUST ); ?></h3>
					<div class="price-list"> 
						<?= $this->partial(
							$this->config( 'client/html/common/partials/price', 'common/partials/price-standard' ),
							array( 'prices' => $productItem->getRefItems( 'price', null, 'default' ) )
						); ?>
					</div>


				
			<table>
			<?php if ( $productItem->getProperties( 'package-protein' )->first()){ ?>
				<tr class="compare-data" style="display: table-row;">
				<td class="compare-data-header" ><?= $this->translate( 'client', 'Protein' ); ?> </td>
				<td class="compare-data-text">
					<a> <?=  $productItem->getProperties( 'package-protein' )->first();?> </a>
				</td>
				</tr>
				<?php } ?>
				<?php if ( $productItem->getProperties( 'package-calorie' )->first()){ ?>
				<tr class="compare-data" style="display: table-row;">
				<td class="compare-data-header" ><?= $this->translate( 'client', 'Calorie' ); ?> </td>
				<td>
					<a> <?= $productItem->getProperties( 'package-calorie' )->first();?> </a>
				</td>
				</tr>
				<?php } ?>

				<?php if ( $productItem->getProperties( 'package-total-fat' )->first()){ ?>
				<tr class="compare-data" style="display: table-row;">
				<td class="compare-data-header"  ><?= $this->translate( 'client', 'Total Fat' ); ?> </td>
				<td class="compare-data-text">
					<a> <?=  $productItem->getProperties( 'package-total-fat' )->first();?> </a>
				</td>
				</tr>
				<?php } ?>
				<?php if ( $productItem->getProperties( 'package-weight' )->first()){ ?>
				<tr class="compare-data" style="display: table-row;">
				<td class="compare-data-header" ><?= $this->translate( 'client', 'Weight' ); ?> </td>
				<td class="compare-data-text">
					<a> <?=  $productItem->getProperties( 'package-weight' )->first();?> </a>
				</td>
				</tr>
				<?php } ?>
				<?php if ( $productItem->getProperties( 'package-length' )->first()){ ?>
				<tr class="compare-data" style="display: table-row;">
				<td class="compare-data-header"  ><?= $this->translate( 'client', 'Length' ); ?> </td>
				<td>
					<a>  <?=  $productItem->getProperties( 'package-length' )->first();
					?> 
					 </a>
				</td>
				</tr>
				<?php } ?>
				<?php if ( $productItem->getProperties( 'package-width' )->first()){ ?>
				<tr class="compare-data" style="display: table-row;">
				<td class="compare-data-header" ><?= $this->translate( 'client', 'Width' ); ?> </td>
				<td class="compare-data-text">
					<a>  <?=  $productItem->getProperties( 'package-width' )->first();
					?> 
					 </a>
				</td>
				</tr>
				<?php } ?>
				<?php if ( $productItem->getProperties( 'package-height' )->first()){ ?>
				<tr class="compare-data" style="display: table-row;">
				<td class="compare-data-header" ><?= $this->translate( 'client', 'Height' ); ?> </td>
				<td class="compare-data-text">
					<a>  <?=  $productItem->getProperties( 'package-height' )->first();
					?> 
					 </a>
				</td>
				</tr>
				<?php } ?>
				<?php if ( $productItem->getProperties( 'package-shelf-life' )->first()){ ?>
				<tr class="compare-data" style="display: table-row;">
				<td class="compare-data-header" ><?= $this->translate( 'client', 'Shelf life' ); ?> </td>
				<td class="compare-data-text">
					<a> <?=  $productItem->getProperties( 'package-shelf-life' )->first();?> </a>
				</td>
				</tr>
				<?php } ?>
	
				
				<?php if ( $productItem->getProperties( 'package-packaging' )->first()){ ?>
				<tr class="compare-data" style="display: table-row;">
				<td class="compare-data-header" ><?= $this->translate( 'client', 'Packaging' ); ?> </td>
				<td class="compare-data-text">
					<a> <?=  $productItem->getProperties( 'package-packaging' )->first();?> </a>
				</td>
				</tr>					
				<?php } ?>
				<?php if ( $productItem->getProperties( 'package-kg' )->first()){ ?>
				<tr class="compare-data" style="display: table-row;">
				<td class="compare-data-header"  ><?= $this->translate( 'client', 'Cost per kg' ); ?> </td>
				<td class="compare-data-text">
					<a> <?=  $productItem->getProperties( 'package-kg' )->first();?> </a>
				</td>
				</tr>
				<?php } ?>

				<?php if ( $productItem->getProperties( 'package-storage-temperature' )->first()){ ?>
				<tr class="compare-data" style="display: table-row;">
				<td class="compare-data-header" ><?= $this->translate( 'client', 'Storage Temperature' ); ?> </td>
				<td class="compare-data-text">
					<a> <?=  $productItem->getProperties( 'package-storage-temperature' )->first();?> </a>
				</td>
				</tr>
				<?php } ?>

			</table>


			
		
 
	
				</a>

				<div class="product__action--link ">
   

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
				   
					   <?= $this->translate( 'client', 'Add to Basket' ); ?>
					   
				   
				   </a>
			   </li>
			   </button>         
		   </div>     
	   <?php endif; ?>			
   </form> 

  </div>
			</li>

		
		
		<?php endforeach; ?>
	</ul>
	
</section>
<?php $this->block()->stop(); ?>
<?= $this->block()->get( 'catalog/session/pinned' ); ?>
