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
 <!-- ::::::  Start  Breadcrumb Section  ::::::  -->
 <div class="page-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="page-breadcrumb__menu">
                        <li class="page-breadcrumb__nav"><a href="#">Home</a></li>
                        <li class="page-breadcrumb__nav active">Single Product - Default</li>
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- ::::::  End  Breadcrumb Section  ::::::  -->
    <!-- :::::: Start Main Container Wrapper :::::: -->
    <main id="main-container" class="main-container">
    <section class="aimeos catalog-detail" itemscope="" itemtype="http://schema.org/Product" data-jsonurl="<?= $enc->attr( $this->url( $optTarget, $optCntl, $optAction, [], [], $optConfig ) ); ?>">
    
	<?php if( isset( $this->detailErrorList ) ) : ?>
		<ul class="error-list">
			<?php foreach( (array) $this->detailErrorList as $errmsg ) : ?>
				<li class="error-item"><?= $enc->html( $errmsg ); ?></li>
			<?php endforeach; ?>
		</ul>
    <?php endif; ?>
    <?php if( isset( $this->detailProductItem ) ) : ?>
        <!-- Start Product Details Gallery -->
        <div class="product-details">
            <div class="container">
                <div class="row ">
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
                    <div class="col-md-7">
                        <div class="product-details-box m-b-60 catalog-detail-basket">
                            <h4 class="font--regular ">
                            <?= $enc->html( $this->detailProductItem->getName(), $enc::TRUST ); ?>
                            </h4>
                            
                            <ul class="product__review">
                                <?php if( $this->detailProductItem->getRating() > 0 ) : ?>
                                <?= str_repeat( '<li class="product__review--fill"><i class="icon-star"></i></li>', (int) round( $this->detailProductItem->getRating() )) ?>
                                <?php endif ?>
                                         
                     
                               
                            </ul>

                            <div class="product__price ">
                                <?= $this->partial(
								$this->config( 'client/html/common/partials/price', 'common/partials/price-standard' ),
								['prices' => $this->detailProductItem->getRefItems( 'price', null, 'default' )]
							    ); ?>
                            </div>
                         
                            <div class="product__desc">
                                <?php foreach( $this->detailProductItem->getRefItems( 'text', 'short', 'default' ) as $textItem ) : ?>
						            <p class="short" itemprop="description"><?= $enc->html( $textItem->getContent(), $enc::TRUST ); ?></p>
					            <?php endforeach; ?>
                            </div>

                            <div class="product-var ">

                               

                               

                                <form method="POST" action="<?= $enc->attr( $this->url( $basketTarget, $basketController, $basketAction, ( $basketSite ? ['site' => $basketSite] : [] ), [], $basketConfig ) ); ?>">
						        <!-- catalog.detail.csrf -->
						        <?= $this->csrf()->formfield(); ?>
						        <!-- catalog.detail.csrf -->

						        <?php if( $basketSite ) : ?>
							    <input type="hidden" name="<?= $this->formparam( 'site' ) ?>" value="<?= $enc->attr( $basketSite ) ?>" />
                                <?php endif ?>
                               

                                <div class="stock-list">
							        <div class="articleitem stock-actual"
								        data-prodid="<?= $enc->attr( $this->detailProductItem->getId() ); ?>"
								        data-prodcode="<?= $enc->attr( $this->detailProductItem->getCode() ); ?>">
						    	    </div>

							        <?php foreach( $this->detailProductItem->getRefItems( 'product', null, 'default' ) as $articleId => $articleItem ) : ?>

								    <div class="articleitem"
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
                                    <div class="product-var__item button">
                                                <button type="submit" class=" m-l-15 btn--long btn--radius-tiny btn--green btn--green-hover-black btn--uppercase btn--weight m-r-20"
                                                 <?= !$this->detailProductItem->isAvailable() ? 'disabled' : '' ?>>
                                                 <?= $enc->html( $this->translate( 'client', 'Add to basket' ), $enc::TRUST ); ?>
                                                </button>
                                              
                                    </div>

                               
                                     
                                <?php endif; ?>
						

                                </form>
                               


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
                                

                                
                                <?php if( !$this->get( 'detailAttributeMap', map() )->isEmpty() || !$this->get( 'detailPropertyMap', map() )->isEmpty() ) : ?>
                                    <div class="calories-title">
                                    <?= $enc->html( $this->translate( 'client', 'Nutritional value per 100 g:' ), $enc::TRUST ); ?>      </div>  
                                   

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
                            
                            

                                
              

                                                               
                              
                               


                                <div class="frigian__item">
                                    <span class="calories-title">Guaranteed safe checkout </span>
                                    <ul class="payment-icon">
                                        <li><img src="<?=frigian_url('assets/img/icon/payment/paypal.svg') ?>" alt=""></li>
                                        <li><img src="<?=frigian_url('assets/img/icon/payment/amex.svg') ?> " alt=""></li>
                                        <li><img src="<?=frigian_url('assets/img/icon/payment/ipay.svg') ?>" alt=""></li>
                                        <li><img src="<?=frigian_url('assets/img/icon/payment/visa.svg') ?>" alt=""></li>
                                        <li><img src="<?=frigian_url('assets/img/icon/payment/shoify.svg') ?>" alt=""></li>
                                        <li><img src="<?=frigian_url('assets/img/icon/payment/mastercard.svg') ?>" alt=""></li>
                                        <li><img src="<?=frigian_url('assets/img/icon/payment/gpay.svg') ?>" alt=""></li>
                                    </ul>
                                </div>

                                    <div class="frigian-product-modal-group">
                                    <ul class="product-modal-group">
                                        <li><a href="#modalShippinginfo" data-toggle="modal"  class="link--gray link--icon-left"><i class="fal fa-truck-container"></i>Shipping</a></li>
                                        <li><a href="#modalProductAsk" data-toggle="modal"  class="link--gray link--icon-left"><i class="fal fa-envelope"></i>Ask About This product</a></li>
                                    </ul>
                                </div> 

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
                                

			                </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
        <!-- End Product Details Gallery -->


       

        <!-- Start Product Details Tab -->
        <div class="product-details-tab-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                    
                       
                        <div class="product-details-content">
                            <ul class="tablist tablist--style-black tablist--style-title tablist--style-gap-30 nav">
                                <li><a class="nav-link active" data-toggle="tab" href="#product-desc"><?= $enc->html( $this->translate( 'client', 'Description' ), $enc::TRUST ); ?></a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#product-dis">Product Details</a></li>
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
								<div class="review-items ">
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
								</div>
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
        </div>  <!-- End Product Details Tab -->

        <?php if( !( $mediaItems = $this->detailProductItem->getRefItems( 'media', 'download' ) )->isEmpty() ) : ?>

            <div class="additional-box">
                    <h2 class="header downloads"><?= $enc->html( $this->translate( 'client', 'Downloads' ), $enc::TRUST ); ?></h2>
                    <ul class="content downloads">

                    <?php foreach( $mediaItems as $id => $item ) : ?>

                        <li class="item">
                        <a href="<?= $this->content( $item->getUrl() ); ?>" title="<?= $enc->attr( $item->getName() ); ?>">
                        <img class="media-image"
                        src="<?= $this->content( $item->getPreview() ); ?>"
                        alt="<?= $enc->attr( $item->getName() ); ?>"
                         />
                         <span class="media-name"><?= $enc->html( $item->getName() ); ?></span>
                         </a>
                          </li>

                     <?php endforeach; ?>

                     </ul>
            </div>

        <?php endif; ?>

        <!-- ::::::  Start  Product Style - Default Section  ::::::  -->
        <div class="product m-t-100">
            <div class="container">
            <?php if( !( $products = $this->detailProductItem->getRefItems( 'product', null, 'suggestion' ) )->isEmpty() ) : ?>

                <div class="row">
                    <div class="col-12">
                         <!-- Start Section Title -->
                        <div class="section-content section-content--border m-b-35">
                            <h5 class="section-content__title">Related Product
                            </h5>

                            <a href="shop-sidebar-grid-left.html" class=" btn--icon-left btn--small btn--radius btn--transparent btn--border-green btn--border-green-hover-green font--regular text-capitalize">More Products<i class="fal fa-angle-right"></i></a>
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
				                      'product' => $product,)
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

                            <a href="shop-sidebar-grid-left.html" class=" btn--icon-left btn--small btn--radius btn--transparent btn--border-green btn--border-green-hover-green font--regular text-capitalize">More Products<i class="fal fa-angle-right"></i></a>
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
				                      'product' => $product,)
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

       
        
        <div class="modal fade" id="modalSizeGuide" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <div class="table-responsive size-guide-table m-t-30">
                                    <table class="table table-bordered">
                                        <thead>
                                          <tr>
                                            <th scope="col">INTERNATIONAL</th>
                                            <th scope="col">X</th>
                                            <th scope="col">S</th>
                                            <th scope="col">M</th>
                                            <th scope="col">L</th>
                                            <th scope="col">XL</th>
                                            <th scope="col">XXL</th>
                                            <th scope="col">XXXL</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <th scope="row">EUROPE</th>						
                                            <td>32</td>
                                            <td>34</td>
                                            <td>36</td>
                                            <td>38</td>
                                            <td>40</td>
                                            <td>42</td>
                                            <td>44</td>
                                          </tr>
                                          <tr>							
                                            <th scope="row">US</th>						
                                            <td>0</td>
                                            <td>2</td>
                                            <td>4</td>
                                            <td>6</td>
                                            <td>8</td>
                                            <td>10</td>
                                            <td>12</td>
                                          </tr>
                                          <tr>													
                                            <th scope="row">CHEST FIT (INCHES)</th>						
                                            <td>28"</td>
                                            <td>30"</td>
                                            <td>32"</td>
                                            <td>34"</td>
                                            <td>36"</td>
                                            <td>38"</td>
                                            <td>40"	</td>
                                          </tr>
                                          <tr>														
                                            <th scope="row">CHEST FIT (CM)</th>						
                                            <td>716</td>
                                            <td>76</td>
                                            <td>81</td>
                                            <td>86</td>
                                            <td>91.5</td>
                                            <td>96.5</td>
                                            <td>101.1</td>
                                          </tr>
                                          <tr>																					
                                            <th scope="row">WAIST FIR (INCHES)</th>						
                                            <td>21"</td>
                                            <td>23"</td>
                                            <td>25"</td>
                                            <td>27"</td>
                                            <td>29"</td>
                                            <td>31"</td>
                                            <td>33"</td>
                                          </tr>
                                          <tr>																												
                                            <th scope="row">WAIST FIR (CM)</th>						
                                            <td>53.5</td>
                                            <td>58.5</td>
                                            <td>63.5</td>
                                            <td>68.5</td>
                                            <td>74</td>
                                            <td>79</td>
                                            <td>84</td>
                                          </tr>
                                          <tr>																																		
                                            <th scope="row">HIPS FIR (INCHES)</th>						
                                            <td>33"</td>
                                            <td>34"</td>
                                            <td>36"</td>
                                            <td>38"</td>
                                            <td>40"</td>
                                            <td>42"</td>
                                            <td>44"</td>
                                          </tr>
                                          <tr>																																								
                                            <th scope="row">HIPS FIR (CM)</th>						
                                            <td>81.5</td>
                                            <td>86.5</td>
                                            <td>91.5</td>
                                            <td>96.5</td>
                                            <td>101</td>
                                            <td>106.5</td>
                                            <td>111.5</td>
                                          </tr>
                                          <tr>																																														
                                            <th scope="row">SKORT LENGTHS (SM)</th>						
                                            <td>36.5</td>
                                            <td>38</td>
                                            <td>39.5</td>
                                            <td>41</td>
                                            <td>42.5</td>
                                            <td>44</td>
                                            <td>45.5</td>
                                          </tr>
                                        </tbody>
                                      </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Modal Size Guide -->

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
    <?php endif ?> 
      





</section>


