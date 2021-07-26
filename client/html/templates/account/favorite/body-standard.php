<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2014
 * @copyright Aimeos (aimeos.org), 2015-2020
 */

$enc = $this->encoder();

/** client/html/account/favorite/url/target
 * Destination of the URL where the controller specified in the URL is known
 *
 * The destination can be a page ID like in a content management system or the
 * module of a software development framework. This "target" must contain or know
 * the controller that should be called by the generated URL.
 *
 * @param string Destination of the URL
 * @since 2014.09
 * @category Developer
 * @see client/html/account/favorite/url/controller
 * @see client/html/account/favorite/url/action
 * @see client/html/account/favorite/url/config
 */
$favTarget = $this->config( 'client/html/account/favorite/url/target' );

/** client/html/account/favorite/url/controller
 * Name of the controller whose action should be called
 *
 * In Model-View-Controller (MVC) applications, the controller contains the methods
 * that create parts of the output displayed in the generated HTML page. Controller
 * names are usually alpha-numeric.
 *
 * @param string Name of the controller
 * @since 2014.09
 * @category Developer
 * @see client/html/account/favorite/url/target
 * @see client/html/account/favorite/url/action
 * @see client/html/account/favorite/url/config
 */
$favController = $this->config( 'client/html/account/favorite/url/controller', 'account' );

/** client/html/account/favorite/url/action
 * Name of the action that should create the output
 *
 * In Model-View-Controller (MVC) applications, actions are the methods of a
 * controller that create parts of the output displayed in the generated HTML page.
 * Action names are usually alpha-numeric.
 *
 * @param string Name of the action
 * @since 2014.09
 * @category Developer
 * @see client/html/account/favorite/url/target
 * @see client/html/account/favorite/url/controller
 * @see client/html/account/favorite/url/config
 */
$favAction = $this->config( 'client/html/account/favorite/url/action', 'favorite' );

/** client/html/account/favorite/url/config
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
 * @see client/html/account/favorite/url/target
 * @see client/html/account/favorite/url/controller
 * @see client/html/account/favorite/url/action
 * @see client/html/url/config
 */
$favConfig = $this->config( 'client/html/account/favorite/url/config', [] );

$detailTarget = $this->config( 'client/html/catalog/detail/url/target' );
$detailController = $this->config( 'client/html/catalog/detail/url/controller', 'catalog' );
$detailAction = $this->config( 'client/html/catalog/detail/url/action', 'detail' );
$detailConfig = $this->config( 'client/html/catalog/detail/url/config', [] );
$detailFilter = array_flip( $this->config( 'client/html/catalog/detail/url/filter', ['d_prodid'] ) );

$optTarget = $this->config( 'client/jsonapi/url/target' );
$optCntl = $this->config( 'client/jsonapi/url/controller', 'jsonapi' );
$optAction = $this->config( 'client/jsonapi/url/action', 'options' );
$optConfig = $this->config( 'client/jsonapi/url/config', [] );

$basketTarget = $this->config( 'client/html/basket/standard/url/target' );
$basketController = $this->config( 'client/html/basket/standard/url/controller', 'basket' );
$basketAction = $this->config( 'client/html/basket/standard/url/action', 'index' );
$basketConfig = $this->config( 'client/html/basket/standard/url/config', [] );
$basketSite = $this->config( 'client/html/basket/standard/url/site' );


?>
<section class="aimeos account-favorite account-wrapper" data-jsonurl="<?= $enc->attr( $this->url( $optTarget, $optCntl, $optAction, [], [], $optConfig ) ); ?>">

	<?php if( ( $errors = $this->get( 'favoriteErrorList', [] ) ) !== [] ) : ?>
		<ul class="error-list">
			<?php foreach( $errors as $error ) : ?>
				<li class="error-item"><?= $enc->html( $error ); ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

	<h4 class="account-title"><?= $this->translate( 'client', 'Favorite products' ); ?></h4>


	<?php if( !$this->get( 'favoriteItems', map() )->isEmpty() ) : ?>
	
		

		<ul class="favorite-items m-t-30">

			<?php foreach( $this->get( 'favoriteItems', map() )->reverse() as $listItem ) : ?>
				<?php if( ( $productItem = $listItem->getRefItem() ) !== null ) : ?>

					<li class="favorite-item product__box">
						<?php $params = ['fav_action' => 'delete', 'fav_id' => $listItem->getRefId()] + $this->get( 'favoriteParams', [] );?>
						<a class="modify" href="<?= $enc->attr( $this->url( $favTarget, $favController, $favAction, $params, [], $favConfig ) ); ?>">
						<i class="fa fa-trash"></i>
						</a>

						<?php $params = array_diff_key( ['d_name' => $productItem->getName( 'url' ), 'd_prodid' => $productItem->getId(), 'd_pos' => ''], $detailFilter ); ?>
						<a href="<?= $enc->attr( $this->url( $detailTarget, $detailController, $detailAction, $params, [], $detailConfig ) ); ?>">
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



				<?php endif; ?>

				
			<?php endforeach; ?>

		</ul>

		<?php if( $this->get( 'favoritePageLast', 1 ) > 1 ) : ?>

			<nav class="pagination">
				<div class="sort">
					<span>&nbsp;</span>
				</div>
				<div class="browser">

					<?php $params = array( 'fav_page' => $this->favoritePageFirst ) + $this->get( 'favoriteParams', [] ); ?>
					<a class="first" href="<?= $enc->attr( $this->url( $favTarget, $favController, $favAction, $params, [], $favConfig ) ); ?>">
						<?= $enc->html( $this->translate( 'client', '◀◀' ), $enc::TRUST ); ?>
					</a>

					<?php $params = array( 'fav_page' => $this->favoritePagePrev ) + $this->get( 'favoriteParams', [] ); ?>
					<a class="prev" href="<?= $enc->attr( $this->url( $favTarget, $favController, $favAction, $params, [], $favConfig ) ); ?>" rel="prev">
						<?= $enc->html( $this->translate( 'client', '◀' ), $enc::TRUST ); ?>
					</a>

					<span>
						<?= $enc->html( sprintf(
							$this->translate( 'client', 'Page %1$d of %2$d' ),
							$this->get( 'favoritePageCurr', 1 ),
							$this->get( 'favoritePageLast', 1 )
						) ); ?>
					</span>

					<?php $params = array( 'fav_page' => $this->favoritePageNext ) + $this->get( 'favoriteParams', [] ); ?>
					<a class="next" href="<?= $enc->attr( $this->url( $favTarget, $favController, $favAction, $params, [], $favConfig ) ); ?>" rel="next">
						<?= $enc->html( $this->translate( 'client', '▶' ), $enc::TRUST ); ?>
					</a>

					<?php $params = array( 'fav_page' => $this->favoritePageLast ) + $this->get( 'favoriteParams', [] ); ?>
					<a class="last" href="<?= $enc->attr( $this->url( $favTarget, $favController, $favAction, $params, [], $favConfig ) ); ?>">
						<?= $enc->html( $this->translate( 'client', '▶▶' ), $enc::TRUST ); ?>
					</a>

				</div>
			</nav>

		<?php endif; ?>




		<?php else: ?>
			<div class="account-info">
				<p> <?php echo $enc->html( $this->translate( 'client', 'You have not added a favorite product to yet.' ), $enc::TRUST ); ?> </p>
			</div>
	
       
			<div class="cont-shop">
				<a  class=" btn--box profile-button btn--radius btn--green btn--black-hover-green btn--uppercase font--semi-bold" href="/" >
				<?php echo $enc->html( $this->translate( 'client', 'Continue Shopping' ), $enc::TRUST ); ?> 

				</a>      
			</div>          

	<?php endif; ?> 




	
</section>
