<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2012
 * @copyright Aimeos (aimeos.org), 2015-2020
 */

/* Available data:
 * - detailProductItem : Product item incl. referenced items
 */


$enc = $this->encoder();

$optTarget = $this->config( 'client/jsonapi/url/target' );
$optCntl = $this->config( 'client/jsonapi/url/controller', 'jsonapi' );
$optAction = $this->config( 'client/jsonapi/url/action', 'options' );
$optConfig = $this->config( 'client/jsonapi/url/config', [] );

$basketTarget = $this->config( 'client/html/basket/standard/url/target' );
$basketController = $this->config( 'client/html/basket/standard/url/controller', 'basket' );
$basketAction = $this->config( 'client/html/basket/standard/url/action', 'index' );
$basketConfig = $this->config( 'client/html/basket/standard/url/config', [] );
$basketSite = $this->config( 'client/html/basket/standard/url/site' );


/** client/html/basket/require-stock
 * Customers can order products only if there are enough products in stock
 *
 * Checks that the requested product quantity is in stock before
 * the customer can add them to his basket and order them. If there
 * are not enough products available, the customer will get a notice.
 *
 * @param boolean True if products must be in stock, false if products can be sold without stock
 * @since 2014.03
 * @category Developer
 * @category User
 */
$reqstock = (int) $this->config( 'client/html/basket/require-stock', true );


?>
<section class="aimeos catalog-detail container" itemscope="" itemtype="http://schema.org/Product" data-jsonurl="<?= $enc->attr( $this->url( $optTarget, $optCntl, $optAction, [], [], $optConfig ) ); ?>">

	<?php if( isset( $this->detailErrorList ) ) : ?>
		<ul class="error-list">
			<?php foreach( (array) $this->detailErrorList as $errmsg ) : ?>
				<li class="error-item"><?= $enc->html( $errmsg ); ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>


	<?php if( isset( $this->detailProductItem ) ) : ?>

		<article class="product  product-details row <?= $this->detailProductItem->getConfigValue( 'css-class' ) ?>" data-id="<?= $this->detailProductItem->getId(); ?>">

			<div class="col-md-5">
				<?= $this->partial(
					/** client/html/catalog/detail/partials/image
					 * Relative path to the detail image partial template file
					 *
					 * Partials are templates which are reused in other templates and generate
					 * reoccuring blocks filled with data from the assigned values. The image
					 * partial creates an HTML block for the catalog detail images.
					 *
					 * @param string Relative path to the template file
					 * @since 2017.01
					 * @category Developer
					 */
					$this->config( 'client/html/catalog/detail/partials/image', 'catalog/detail/image-partial-standard' ),
					['mediaItems' => $this->get( 'detailMediaItems', map() ), 'params' => $this->param()]
				); ?>

			</div>

			<div class="col-sm-7">

				<div class="catalog-detail-basic">
					<?php if( !( $suppliers = $this->detailProductItem->getSupplierItems() )->isEmpty() ) : ?>
						<h2 class="supplier"><?= $enc->html( $suppliers->getName()->first(), $enc::TRUST ); ?></h2>
					<?php endif ?>

					<h4 class="font--regular" itemprop="name"><?= $enc->html( $this->detailProductItem->getName(), $enc::TRUST ); ?></h4>

					<p class="code" style="display:none;">
						<span class="name"><?= $enc->html( $this->translate( 'client', 'Article no.' ), $enc::TRUST ); ?>: </span>
						<span class="value" itemprop="sku"><?= $enc->html( $this->detailProductItem->getCode() ); ?></span>
					</p>

					<?php if( $this->detailProductItem->getRating() > 0 ) : ?>
                        <ul class="product__review">
                            <div class="rating" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
                            <?= str_repeat( '<li class="product__review--fill"><i class="fa fa-star"></i></li>', (int) round( $this->detailProductItem->getRating() )) ?>
                            </div>
                        </ul>
					<?php endif ?> 


                    <div class="price-list product__price">
						<div class="articleitem price price-actual"
							data-prodid="<?= $enc->attr( $this->detailProductItem->getId() ); ?>"
							data-prodcode="<?= $enc->attr( $this->detailProductItem->getCode() ); ?>">

							<?= $this->partial(
								$this->config( 'client/html/common/partials/price', 'common/partials/price-standard' ),
								['prices' => $this->detailProductItem->getRefItems( 'price', null, 'default' )]
							); ?>

						</div>

						<?php if( $this->detailProductItem->getType() === 'select' ) : ?>
							<?php foreach( $this->detailProductItem->getRefItems( 'product', 'default', 'default' ) as $prodid => $product ) : ?>
								<?php if( !( $prices = $product->getRefItems( 'price', null, 'default' ) )->isEmpty() ) : ?>

									<div class="articleitem price"
										data-prodid="<?= $enc->attr( $prodid ); ?>"
										data-prodcode="<?= $enc->attr( $product->getCode() ); ?>">

										<?= $this->partial(
											$this->config( 'client/html/common/partials/price', 'common/partials/price-standard' ),
											['prices' => $prices]
										); ?>

									</div>

								<?php endif; ?>
							<?php endforeach; ?>
						<?php endif; ?>

					</div>


					<?php foreach( $this->detailProductItem->getRefItems( 'text', 'short', 'default' ) as $textItem ) : ?>
						<p class="short" itemprop="description"><?= $enc->html( $textItem->getContent(), $enc::TRUST ); ?></p>
					<?php endforeach; ?>

				</div>


				<div class="catalog-detail-basket" data-reqstock="<?= $reqstock; ?>" itemprop="offers" itemscope itemtype="http://schema.org/Offer">

					<form method="POST" action="<?= $enc->attr( $this->url( $basketTarget, $basketController, $basketAction, ( $basketSite ? ['site' => $basketSite] : [] ), [], $basketConfig ) ); ?>">
						<!-- catalog.detail.csrf -->
						<?= $this->csrf()->formfield(); ?>
						<!-- catalog.detail.csrf -->

						<?php if( $basketSite ) : ?>
							<input type="hidden" name="<?= $this->formparam( 'site' ) ?>" value="<?= $enc->attr( $basketSite ) ?>" />
						<?php endif ?>

						<?php if( $this->detailProductItem->getType() === 'select' ) : ?>

							<div class="catalog-detail-basket-selection">

								<?= $this->partial(
									/** client/html/common/partials/selection
									 * Relative path to the variant attribute partial template file
									 *
									 * Partials are templates which are reused in other templates and generate
									 * reoccuring blocks filled with data from the assigned values. The selection
									 * partial creates an HTML block for a list of variant product attributes
									 * assigned to a selection product a customer must select from.
									 *
									 * The partial template files are usually stored in the templates/partials/ folder
									 * of the core or the extensions. The configured path to the partial file must
									 * be relative to the templates/ folder, e.g. "partials/selection-standard.php".
									 *
									 * @param string Relative path to the template file
									 * @since 2015.04
									 * @category Developer
									 * @see client/html/common/partials/attribute
									 */
									$this->config( 'client/html/common/partials/selection', 'common/partials/selection-standard' ),
									['productItems' => $this->detailProductItem->getRefItems( 'product', 'default', 'default' )]
								); ?>

							</div>

						<?php endif; ?>

						<div class="catalog-detail-basket-attribute">

							<?= $this->partial(
								/** client/html/common/partials/attribute
								 * Relative path to the product attribute partial template file
								 *
								 * Partials are templates which are reused in other templates and generate
								 * reoccuring blocks filled with data from the assigned values. The attribute
								 * partial creates an HTML block for a list of optional product attributes a
								 * customer can select from.
								 *
								 * The partial template files are usually stored in the templates/partials/ folder
								 * of the core or the extensions. The configured path to the partial file must
								 * be relative to the templates/ folder, e.g. "partials/attribute-standard.php".
								 *
								 * @param string Relative path to the template file
								 * @since 2016.01
								 * @category Developer
								 * @see client/html/common/partials/selection
								 */
								$this->config( 'client/html/common/partials/attribute', 'common/partials/attribute-standard' ),
								['productItem' => $this->detailProductItem]
							); ?>
 
						</div>


						<div class="stock-list">
							<div class="articleitem stock-actual"
								data-prodid="<?= $enc->attr( $this->detailProductItem->getId() ); ?>"
								data-prodcode="<?= $enc->attr( $this->detailProductItem->getCode() ); ?>">
							</div>

							<?php foreach( $this->detailProductItem->getRefItems( 'product', null, 'default' ) as $articleId => $articleItem ) : ?>

								<div class="articleitem **"
									data-prodid="<?= $enc->attr( $articleId ); ?>"
									data-prodcode="<?= $enc->attr( $articleItem->getCode() ); ?>">
								</div>

							<?php endforeach; ?>

						</div>
                        
                               

                        <?php if( !$this->detailProductItem->getRefItems( 'price', 'default', 'default' )->empty() ) : ?>
                                    <div class="product-quantity product-var__item d-flex align-items-center">
                                        <span class="product-var__text"></span>
                                        <input type="hidden" value="add" name="<?= $enc->attr( $this->formparam( 'b_action' ) ); ?>" />
								    	<input type="hidden"
								    		name="<?= $enc->attr( $this->formparam( ['b_prod', 0, 'prodid'] ) ); ?>"
								    		value="<?= $enc->attr( $this->detailProductItem->getId() ); ?>"
								    	/>   
                                        <div class="quantity-scale ">
                                            <div class="value-button" id="decrease" onclick="decreaseValue()">-</div>
                                            <input type="number" id="number" <?= !$this->detailProductItem->isAvailable() ? 'disabled' : '' ?>
                                            name="<?= $enc->attr( $this->formparam( ['b_prod', 0, 'quantity'] ) ); ?>"
								    		min="<?= $this->detailProductItem->getScale() ?>" max="2147483647"
								    		step="<?= $this->detailProductItem->getScale() ?>" maxlength="10"
								    		value="<?= $this->detailProductItem->getScale() ?>" required="required" />
                                            <div class="value-button" id="increase" onclick="increaseValue()">+</div>

                                        </div>

                                    </div>


                                    <?php 
                                    $watchTarget = $this->config( 'client/html/account/watch/url/target' );
                                    $watchController = $this->config( 'client/html/account/watch/url/controller', 'account' );
                                    $watchAction = $this->config( 'client/html/account/watch/url/action', 'watch' );
                                    $watchConfig = $this->config( 'client/html/account/watch/url/config', [] );
                                    $urls = array(
                                        'watch' => $this->url( $watchTarget, $watchController, $watchAction, ['wat_action' => 'add', 'wat_id' => $this->detailProductItem->getId(), 'd_name' => $this->detailProductItem->getName( 'url' )], $watchConfig ),
                                        );
                                    
                                    
                                    $stockItems = $this->detailProductItem->getStockItems()->getStockLevel()->first();?>
                                  
                                    <div class="product-var__item button">
                                    <?php if(!$stockItems  <=0 ) { ?>
                                                <button type="submit" class=" m-l-15 btn--long btn--radius-tiny btn--green btn--green-hover-black btn--uppercase btn--weight m-r-20"
                                                 <?= !$this->detailProductItem->isAvailable()  ? 'disabled' : '' ?>>
                                                 <?= $enc->html( $this->translate( 'client', 'Add to basket' ), $enc::TRUST ); ?>
                                                </button>


                                                <?php } else{


                                                if( isset( $urls['watch'] ) ){  ?>
                                                   <a style="text-align: center; color:white;"class="m-l-15 btn--long btn--radius-tiny btn--green btn--green-hover-black btn--uppercase btn--weight m-r-20" href="<?= $enc->attr( $urls['watch'] );  ?> " title="<?= $enc->attr( $this->translate( 'client/code', 'watch' ) ); ?>" data-toggle="tooltip" target="_blank" title="" data-original-title="<?= $enc->attr( 'watch' ); ?>">
                                                    <?= $enc->html( $this->translate( 'client', 'Watch Product' ), $enc::TRUST ); ?>
                                                        </a>
                                                    
                                                <?php }

                                                } ?>
                                              
                                    </div>
                                    

                                   






                        <?php endif; ?>

					</form>
                
                    <?php if( !$this->get( 'detailAttributeMap', map() )->isEmpty() || !$this->get( 'detailPropertyMap', map() )->isEmpty() ) : ?>
                        
         
                        <div class="calories-title">
                            
                            <?= $enc->html( $this->translate( 'client', 'Nutritional value per 100 g' ), $enc::TRUST ); ?>      </div>  
                            <div class="calories-title mobile">
                            
                            <?= $enc->html( $this->translate( 'client', 'Click to see nutritional value per 100 g' ), $enc::TRUST ); ?>  <i class="fal fa-chevron-down" ></i>     </div>  
                                <script>
                            

                                $(".calories-title.mobile").click(function()
                                {
                                   $(".calories").toggle();
                                });

                                </script>
                                   
                                <div class="calories">
       
                                    <div class="calories-values">

                                        <?php foreach( $this->get( 'detailPropertyMap', map() ) as $type => $propItems ) : ?>
										<?php foreach( $propItems as $propItem ) : ?>

                                            <?php if (strcmp ($propItem->getType(), "package-calorie" ) == 0 || strcmp ($propItem->getType(), "package-protein" ) == 0  || strcmp ($propItem->getType(), "package-total-fat" ) == 0) :
                                            ?>
                                                <div class="calories-item">
                                                    <div class="calories-unit">
                                    
                                                        <div class="calories-key">
                    
                                                            <?= $enc->html( $this->translate( 'client', $propItem->getType() ), $enc::TRUST ); ?>
                                                
                                                        </div>
                    
                                                    </div>
                                                        <div class="calories-percent">
                                                            <?= $enc->html( $propItem->getValue() ); ?> 
                                                        </div>
                                                </div>
                    
                                            <?php endif; ?>


                                        <?php endforeach; ?>
							            <?php endforeach; ?>
                               
                                </div>
                        </div>
                    <?php endif; ?>
                                       

				</div>


				

                
                    <?php /* <div class="frigian-product-modal-group">
                        <ul class="product-modal-group">
                            <li><a href="#modalShippinginfo" data-toggle="modal"  class=" link--icon-left"><i class="fal fa-truck-container"></i><?= $enc->html( $this->translate( 'client', 'Shipping' ), $enc::TRUST ); ?></a></li>
                            <li><a href="#modalProductAsk" data-toggle="modal"  class=" link--icon-left"><i class="fal fa-envelope"></i><?= $enc->html( $this->translate( 'client', 'Ask About This product' ), $enc::TRUST ); ?> </a></li>
                        </ul>
                    </div>  */ ?>

                  
                   
                

                    <?= $this->partial(
					/** client/html/catalog/partials/actions
					 * Relative path to the catalog actions partial template file
					 *
					 * Partials are templates which are reused in other templates and generate
					 * reoccuring blocks filled with data from the assigned values. The actions
					 * partial creates an HTML block for the product actions (pin, like and watch
					 * products).
					 *
					 * @param string Relative path to the template file
					 * @since 2017.04
					 * @category Developer
					 */
					$this->config( 'client/html/catalog/partials/actions', 'catalog/actions-partial-standard' ),
					['productItem' => $this->detailProductItem]
				    ); ?>
                    <?= $this->partial(
					/** client/html/catalog/partials/social
					 * Relative path to the social partial template file
					 *
					 * Partials are templates which are reused in other templates and generate
					 * reoccuring blocks filled with data from the assigned values. The social
					 * partial creates an HTML block for links to social platforms in the
					 * catalog components.
					 *
					 * @param string Relative path to the template file
					 * @since 2017.04
					 * @category Developer
					 */
					$this->config( 'client/html/catalog/partials/social', 'catalog/social-partial-standard' ),
					['productItem' => $this->detailProductItem]
				); ?>

                <?php if( !$this->get( 'detailAttributeMap', map() )->isEmpty() || !$this->get( 'detailPropertyMap', map() )->isEmpty() ) : ?>
                        
                        <?php foreach( $this->get( 'detailPropertyMap', map() ) as $type => $propItems ) : ?>
							<?php foreach( $propItems as $propItem ) : ?>

                                <?php if (strcmp ($propItem->getType(), "package-kg" ) == 0 ) :?>
                                    <div class="b1t-o-shm infotext">
                                        <div class="bk"></div>
                                                
                                            <div class="front">
                                                <div class="display-table">
                                                    <div class="display-row">
                                                        <div class="display-cell">
                                                        <?= $enc->html( $this->translate( 'client', 'Стоимость за кг: ' ), $enc::TRUST ); ?>
                                                            <?= $enc->html( $propItem->getValue() ); ?> 
                                                            <?= $enc->html( $this->translate( 'client', 'руб.' ), $enc::TRUST ); ?>
                                                            <br> 
                                                            <?= $enc->html( $this->translate( 'client', 'Внимание! Цена за фасованный товар указана с учетом максимально возможного веса фасовки. Итоговая стоимость может отличаться в меньшую сторону и указывается в товарной накладной.' ), $enc::TRUST ); ?>
                                                             
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>
                                               
                    
                                <?php endif; ?>


                            <?php endforeach; ?>
						<?php endforeach; ?>
                    <?php endif; ?>



                   
                  
			</div>
       
                        

            <!-- Start Product Details Tab -->
            <div class="product-details-tab-area container">
                    <div class=" row">
                        <div class="col-12">
                            <div class="product-details-content">

                                <ul class="tablist tablist--style-black tablist--style-title tablist--style-gap-30 nav">
                                    <li><a class="nav-link active" data-toggle="tab" href="#product-desc"><?= $enc->html( $this->translate( 'client', 'Description' ), $enc::TRUST ); ?></a></li>
                                    <li><a class="nav-link" data-toggle="tab" href="#product-dis"><?= $enc->html( $this->translate( 'client', 'Product Details' ), $enc::TRUST ); ?></a></li>
                                    <li><a class="nav-link" data-toggle="tab" href="#product-review"><?= $enc->html( $this->translate( 'client', 'Reviews' ), $enc::TRUST ) ?></a></li>
                                </ul>


                                <div class="product-details-tab-box">
                                    <div class="tab-content">
                                        <!-- Start Tab - Product Description -->
                                    
                                        <div class="tab-pane show active" id="product-desc">
                                            <div class="para__content">
                                                <?php if( !( $textItems = $this->detailProductItem->getRefItems( 'text', 'long' ) )->isEmpty() ) : ?>
                                                    <?php foreach( $textItems as $textItem ) : ?>
                                                    <div class="long item">
                                                    <?= $enc->html( $textItem->getContent(), $enc::TRUST ); ?></div>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>    
                                        </div>  
                                                                
                                        <!-- End Tab - Product Description -->

                                    
                                        <!-- Start Tab - Product Details -->
                                        <div class="tab-pane" id="product-dis">
                                            <div class="product-dis__content">
            
                                                <div class="table-responsive-md">
                                                <?php if( !$this->get( 'detailAttributeMap', map() )->isEmpty() || !$this->get( 'detailPropertyMap', map() )->isEmpty() ) : ?>
                                                    <table class="product-dis__list table table-bordered">
                                                        <tbody>
                                                        <?php foreach( $this->get( 'detailAttributeMap', map() ) as $type => $attrItems ) : ?>
                                                        <?php foreach( $attrItems as $attrItem ) : ?>

                                                        <tr class="item <?= ( $id = $attrItem->get( 'parent' ) ) ? 'subproduct subproduct-' . $id : '' ?>">
                                                        <td class="product-dis__title"><?= $enc->html( $this->translate( 'client/code', $type ), $enc::TRUST ); ?></td>
                                                        <td class="product-dis__text">
                                                            <div class="media-list">

                                                                <?php foreach( $attrItem->getListItems( 'media', 'icon' ) as $listItem ) : ?>
                                                                    <?php if( ( $refitem = $listItem->getRefItem() ) !== null ) : ?>
                                                                        <?= $this->partial(
                                                                            $this->config( 'client/html/common/partials/media', 'common/partials/media-standard' ),
                                                                            ['item' => $refitem, 'boxAttributes' => ['class' => 'media-item']]
                                                                        ); ?>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>

                                                            </div><!--
                                                            --><span class="attr-name"><?= $enc->html( $attrItem->getName() ); ?></span>

                                                            <?php foreach( $attrItem->getRefItems( 'text', 'short' ) as $textItem ) : ?>
                                                                <div class="attr-short"><?= $enc->html( $textItem->getContent() ); ?></div>
                                                            <?php endforeach ?>

                                                            <?php foreach( $attrItem->getRefItems( 'text', 'long' ) as $textItem ) : ?>
                                                                <div class="attr-long"><?= $enc->html( $textItem->getContent() ); ?></div>
                                                            <?php endforeach ?>

                                                        </td>
                                                        <?php endforeach; ?>
                                                        <?php endforeach; ?>
                                                        
                                                        <?php foreach( $this->get( 'detailPropertyMap', map() ) as $type => $propItems ) : ?>
                                                        <?php foreach( $propItems as $propItem ) : ?>

                                        
                                                            <tr class="item <?= ( $id = $propItem->get( 'parent' ) ) ? 'subproduct subproduct-' . $id : '' ?>">
                                                                <td class="name"><?= $enc->html( $this->translate( 'client', $propItem->getType() ), $enc::TRUST ); ?></td>
                                                                <td class="value"><?= $enc->html( $propItem->getValue() ); ?></td>
                                                            </tr>

                                                        <?php endforeach; ?>
                                                        <?php endforeach; ?>
                                                        <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>  <!-- End Tab - Product Details -->

                                    
                                    
    
                                        <!-- Start Tab - Product Review -->
                                        <div class="tab-pane " id="product-review">
                                            <!-- Start - Review Comment -->
                                            <ul class="comment">
                                                <!-- Start - Review Comment list-->
                                                <div class="additional-box">
                                                <?php /*<h2 class="header reviews">
                                <?= $enc->html( $this->translate( 'client', 'Reviews' ), $enc::TRUST ) ?>
                                <span class="ratings"><?= $enc->html( $this->detailProductItem->getRatings() ) ?></span>
                            </h2>*/?>
                            <div class="content reviews row" data-productid="<?= $enc->attr( $this->detailProductItem->getId() ) ?>">
                            <?php /* <div class="col-md-4 rating-list">
                                    <div class="rating-numbers">
                                        <div class="rating-num"><?= number_format( $this->detailProductItem->getRating(), 1 ) ?>/5</div>
                                        <div class="rating-total"><?= $enc->html( sprintf( $this->translate( 'client', '%1$d review', '%1$d reviews', $this->detailProductItem->getRatings() ), $this->detailProductItem->getRatings() ) ) ?></div>
                                        <div class="rating-stars">
                                        <?= str_repeat( '<li class="product__review--fill"><i class="icon-star "></i></li>', (int) round( $this->detailProductItem->getRating() )) ?>
                                        </div>
                                    </div>
                                    
                                </div> 
                                <div class="col-md-12 review-list">
                                    <div class="sort">
                                        <span><?= $enc->html( $this->translate( 'client', 'Sort by:' ), $enc::TRUST ); ?></span>
                                        <ul>
                                            <li>
                                                <a class="sort-option option-ctime active" href="<?= $enc->attr( $this->url( $optTarget, $optCntl, $optAction, ['resource' => 'review', 'filter' => ['f_refid' => $this->detailProductItem->getId()], 'sort' => '-ctime'], [], $optConfig ) ); ?>" >
                                                    <?= $enc->html( $this->translate( 'client', 'Latest' ), $enc::TRUST ); ?>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="sort-option option-rating" href="<?= $enc->attr( $this->url( $optTarget, $optCntl, $optAction, ['resource' => 'review', 'filter' => ['f_refid' => $this->detailProductItem->getId()], 'sort' => '-rating,-ctime'], [], $optConfig ) ); ?>" >
                                                    <?= $enc->html( $this->translate( 'client', 'Rating' ), $enc::TRUST ); ?>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>*/?>


                                    <div class="review-items">
                                        <div class="review-item prototype">
                                        <label class="review-head">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                            <div class="review-name"></div>
                                            <div class="review-ctime"></div>
                                        </label>
                                        <label class="review-body">
                                            
                                            <div class="review-comment"></div>
                                            <div class="review-rating product__review--fill">★</div>
                                            <div class="review-response">
                                            <i class="fa fa-reply" aria-hidden="true"></i>
                                                <div class="review-vendor"><?= $enc->html( $this->translate( 'client', 'Vendor response' ) ) ?></div>
                                            </div>
                                        </label>
                                            <div class="review-show"><a href="#"><?= $enc->html( $this->translate( 'client', 'Show' ) ) ?></a></div><!--
                                        --></div>
                                    </div>
                                    
                                    <?php /*<div class="review-items ">
                                        <div class="review-item prototype comment__list">
                                            <div class="review-name comment__name"></div>
                                            <!--<div class="review-ctime"></div>-->
                                            <div class="review-rating product__review--fill ">★</div>
                                            <div class="review-comment para__text"></div>
                                            <div class="review-response comment__reply comment__reply-list">
                                                <li class="review-vendor comment__name para__text"><?= $enc->html( $this->translate( 'client', 'Vendor response' ) ) ?></li>
                                            </div>
                                            <div class="review-show"><a href="#"><?= $enc->html( $this->translate( 'client', 'Show' ) ) ?></a></div><!--
                                        --></div>
                                    </div>*/?>
                                    <a class=" btn-primary more" href="#"><?= $enc->html( $this->translate( 'client', 'More reviews' ), $enc::TRUST ) ?></a>
                                </div>
                            </div>
                        </div>
                        <!-- End - Review Comment list-->
                                            
                                        </ul>  <!-- End - Review Comment -->

                                       
                                    </div>  <!-- Start Tab - Product Review -->
                                </div>
                            </div>
                        </div>
                    </div>
               
            </div>
        </div>  
        <!-- End Product Details Tab -->

        <!-- ::::::  Start  Product Style - Default Section  ::::::  -->
        <div class="product m-t-100 related">
            <div class="container">
            <?php if( !( $products = $this->detailProductItem->getRefItems( 'product', null, 'suggestion' ) )->isEmpty() ) : ?>

                <div class="row">
                    <div class="col-12">
                         <!-- Start Section Title -->
                        <div class="section-content section-content--border m-b-35">
                            <h5 class="section-content__title"><?= $this->translate( 'client', 'Related Product' ); ?>
                            </h5>

                            <a href="/shop" class=" btn--icon-left btn--small btn--radius btn--transparent btn--border-green btn--border-green-hover-green font--regular text-capitalize"><?= $this->translate( 'client', 'More Products' ); ?><i class="fal fa-angle-right"></i></a>
                        </div>  <!-- End Section Title -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="default-slider default-slider--hover-bg-red product-default-slider">
                            <div class="product-default-slider-4grid-1rows gap__col--30 gap__row--40">
                                <?php foreach($products  as $product ){ 
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
                <?php endif; ?>


                
                <?php if( !( $products = $this->detailProductItem->getRefItems( 'product', null, 'bought-together' ) )->isEmpty() ) : ?>                
                <div class="row">
                    <div class="col-12">
                         <!-- Start Section Title -->
                        <div class="section-content section-content--border m-b-35">
                            <h5 class="section-content__title"><?= $this->translate( 'client', 'Other customers also bought' ); ?>
                            </h5>

                        </div>  <!-- End Section Title -->
                    </div>
                </div>
                <div class="row bought-together">
                    <div class="col-12">
                        <div class="default-slider default-slider--hover-bg-red product-default-slider">
                            <div class="product-default-slider-4grid-1rows gap__col--30 gap__row--40">
                           
                            <?php foreach($products  as $product ){ 
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
                <?php endif; ?>

                <?php if( $this->detailProductItem->getType() === 'bundle' && !( $products = $this->detailProductItem->getRefItems( 'product', null, 'default' ) )->isEmpty() ) : ?>
                <div class="row">
                    <div class="col-12"> 
                        <!-- Start Section Title -->
                        <div class="section-content section-content--border m-b-35">
                        <h5 class="section-content__title"><?= $this->translate( 'client', 'Bundled products' ); ?></h5>
                        <a href="shop-sidebar-grid-left.html" class=" btn--icon-left btn--small btn--radius btn--transparent btn--border-green btn--border-green-hover-green font--regular text-capitalize"><?= $this->translate( 'client', 'More Products' ); ?><i class="fal fa-angle-right"></i></a> </div>
                         <!-- End Section Title --> 
                   </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="default-slider default-slider--hover-bg-red product-default-slider">
                            <div class="product-default-slider-4grid-1rows gap__col--30 gap__row--40"> 
                                <?php foreach($products  as $product ){ 
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
                <?php endif; ?>
            </div>
        </div> <!-- ::::::  End  Product Style - Default Section  ::::::  -->          

		</article>

    <!-- Start Modal Shipping Info -->
    <div class="modal fade" id="modalShippinginfo" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-right">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"> <i class="fal fa-times"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                            <?= $this->block()->get( 'catalog/detail/service' ); ?>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Modal Shipping Info -->
    <!-- Start Modal Product Ask -->
    <div class="modal fade" id="modalProductAsk" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-right">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"> <i class="fal fa-times"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <!-- Start Add Review Form-->
                                <div class="review-form m-t-30">
                                    <div class="section-content">
                                        <h6 class="font--bold text-uppercase">Have a question?</h6>
                                        <p class="section-content__desc">Your email address will not be published. Required fields are marked *</p>
                                    </div>
                                    <form class="form-box" action="#" method="post">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-box__single-group">
                                                    <input type="text" id="modal-ask-name" placeholder="Your name">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-box__single-group">
                                                    <input type="email" id="modal-ask-email" placeholder="Your email" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-box__single-group">
                                                    <input type="text" id="modal-ask-phone" placeholder="Your phone number" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-box__single-group">
                                                    <textarea id="modal-ask-message" rows="8" placeholder="Your message"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button class=" btn--box btn--small btn--black btn--black-hover-green btn--uppercase font--bold m-t-30" type="submit">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div> <!-- End Add Review Form- -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Modal Product Ask -->



	<?php endif; ?>

</section>
