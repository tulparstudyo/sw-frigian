<?php
/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2012
 * @copyright Aimeos (aimeos.org), 2015-2020
 */
$enc = $this->encoder();

$data = \Aimeos\Shop\Facades\Shop::get('swordbros/slider')->addData($this);
if( $this->param( 'f_catid' ) !== null )
{
	$target = $this->config( 'client/html/catalog/tree/url/target' );
	$cntl = $this->config( 'client/html/catalog/tree/url/controller', 'catalog' );
	$action = $this->config( 'client/html/catalog/tree/url/action', 'tree' );
	$config = $this->config( 'client/html/catalog/tree/url/config', [] );
}
else
{
	$target = $this->config( 'client/html/catalog/lists/url/target' );
	$cntl = $this->config( 'client/html/catalog/lists/url/controller', 'catalog' );
	$action = $this->config( 'client/html/catalog/lists/url/action', 'list' );
	$config = $this->config( 'client/html/catalog/lists/url/config', [] );
}
$optTarget = $this->config( 'client/jsonapi/url/target' );
$optCntl = $this->config( 'client/jsonapi/url/controller', 'jsonapi' );
$optAction = $this->config( 'client/jsonapi/url/action', 'options' );
$optConfig = $this->config( 'client/jsonapi/url/config', [] );
/** client/html/catalog/lists/head/text-types
 * The list of text types that should be rendered in the catalog list head section
 *
 * The head section of the catalog list view at least consists of the category
 * name. By default, all short and long descriptions of the category are rendered
 * as well.
 *
 * You can add more text types or remove ones that should be displayed by
 * modifying these list of text types, e.g. if you've added a new text type
 * and texts of that type to some or all categories.
 *
 * @param array List of text type names
 * @since 2014.03
 * @category User
 * @category Developer
 */
$textTypes = $this->config( 'client/html/catalog/lists/head/text-types', array( 'long' ) );
/** client/html/catalog/lists/pagination/enable
 * Enables or disables pagination in list views
 *
 * Pagination is automatically hidden if there are not enough products in the
 * category or search result. But sometimes you don't want to show the pagination
 * at all, e.g. if you implement infinite scrolling by loading more results
 * dynamically using AJAX.
 *
 * @param boolean True for enabling, false for disabling pagination
 * @since 2019.04
 * @category User
 * @category Developer
 */
/** client/html/catalog/lists/partials/pagination
 * Relative path to the pagination partial template file for catalog lists
 *
 * Partials are templates which are reused in other templates and generate
 * reoccuring blocks filled with data from the assigned values. The pagination
 * partial creates an HTML block containing a page browser and sorting links
 * if necessary.
 *
 * @param string Relative path to the template file
 * @since 2017.01
 * @category Developer
 */
$products = $this->get( 'itemsProductItems', map() );
?>
        <div class="container">
            <div class="row  flex-lg-row">
                <!-- Start Leftside - Sidebar Widget -->
                <div class="col-lg-3">
					<?php if( $this->get( 'listProductTotal', 0 ) > 0 ) : ?>
				
                    <!-- ::::::  Start Sort Box Section  ::::::  -->
                    <div class="sort-box mobile">
                        <!-- Start Sort Left Side -->
                        <div class="sort-box-item">
                            <div class="sort-box__tab">
                                <ul class="sort-box__tab-list nav">
                                    <li><a class="sort-nav-link active" data-toggle="tab" href="#sort-grid"><i class="fas fa-th"></i>  </a></li>
                                    <li><a class="sort-nav-link" data-toggle="tab" href="#sort-list"><i class="fas fa-list-ul"></i></a></li>
									<button type="button" class="buttonfilter"  data-target="catalog-filter" data-toggle="tooltip" 
									data-placement="top" title="Filter" ><i class="fa fa-filter" style="font-size: 14px;"></i></button>
									<script type="text/javascript">
										$('.buttonfilter').on('click', function(){
										// $('.catalog-filter-attribute').toggleClass('show-mobile');
										$( ".catalog-filter , .catalog-filter-price" ).toggle( "slow"  );
									});
									</script>
								</ul>
                            </div>
                        </div> <!-- Start Sort Left Side -->
                        <?php if( $this->get( 'listProductTotal', 0 ) > 0 && $this->config( 'client/html/catalog/lists/pagination/enable', true ) ) : ?>
						<?= $this->partial(
							$this->config( 'client/html/catalog/lists/partials/pagination', 'catalog/lists/pagination-standard' ),
							array(
								'params' => $this->get( 'listParams', [] ),
								'size' => $this->get( 'listPageSize', 48 ),
								'total' => $this->get( 'listProductTotal', 0 ),
								'current' => $this->get( 'listPageCurr', 0 ),
								'prev' => $this->get( 'listPagePrev', 0 ),
								'next' => $this->get( 'listPageNext', 0 ),
								'last' => $this->get( 'listPageLast', 0 ),
							)
						);
						?>
						<?php endif ?>
						<div class="product-page_count"> 
						<span><?=$this->translate( 'client', 'Found' )?> <?=$this->get( 'listProductTotal', 0 )?> <?=$this->translate( 'client', 'results' )?></span>
						</div>
						</div>
					<?php endif; ?>
						<?php /* if( ( $searchText = $this->param( 'f_search', null ) ) != null ) : ?>
							<div class="list-search">
								<?php if( ( $total = $this->get( 'listProductTotal', 0 ) ) > 0 ) : ?>
									<?= $enc->html( sprintf(
										$this->translate(
											'client',
											'Search result for <span class="searchstring">"%1$s"</span> (%2$d article)',
											'Search result for <span class="searchstring">"%1$s"</span> (%2$d articles)',
											$total
										),
										$searchText,
										$total
									), $enc::TRUST ); ?>
								<?php else : ?>
									<?= $enc->html( sprintf(
										$this->translate(
											'client',
											'No articles found for <span class="searchstring">"%1$s"</span>. Please try again with a different keyword.'
										),
										$searchText
									), $enc::TRUST ); ?>
								<?php endif; ?>
							</div>
						<?php endif;  */ ?>
                       
                   
                    <div class="sidebar">
					<?=frigian_catalog_filter()?>
					<?=frigian_catalog_session()?>
					<div class="sidebar__widget">
                            <div class="row">
                                <div class="col-12">
                                    <div class="sidebar__banner">
                                        <a href="product-single-default.html" class="banner__link text-center">
                                            <img class="img-fluid" src="<?php /*asset("public/files/catalog-list/img-sidebar.jpg" )*/?>" style="margin-top:30px">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Left Sidebar Widget -->
                <!-- Start Rightside - Product Type View -->
                <div class="col-lg-9">
                <div class="img-responsive" style="margin-bottom: 30px;">
			
				<!-- ::::::  Start Hero Section  ::::::  -->
				<div class="hero slider-dot-fix slider-dot slider-dot-fix slider-dot--center slider-dot-size--medium slider-dot-circle  slider-dot-style--fill slider-dot-style--fill-white-active-green dot-gap__X--10"> 
					<?php  foreach($data->listitems as $item){ ?>
				<!-- Start Single Hero Slide -->
				<div class="hero-slider"> <img src="/<?= $item['list_banner_url']?>" alt="">
				
				</div>
				<!-- End Single Hero Slide -->
					<?php } ?>
				</div>
				<!-- ::::::  End Hero Section  ::::::  --> 
               <?php /* <img class="img-fluid" src="<?= asset("public/files/catalog-list/banner-shop-1-img-1-wide.jpg" )?>" style="margin-top:30px"> */?>

                </div>
                <?php if( isset( $this->listErrorList ) ) : ?>
				<ul class="error-list">
					<?php foreach( (array) $this->listErrorList as $errmsg ) : ?>
						<li class="error-item"><?= $enc->html( $errmsg ); ?></li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
    
				<?= $this->block()->get( 'catalog/lists/promo' ); ?>
				<?php if( $this->get( 'listProductTotal', 0 ) > 0 ) : ?>
					<?php /*<div class="catalog-list-type">
							<a class="type-item type-grid" title="<?= $enc->attr( $this->translate( 'client', 'Grid view' ) ) ?>"
								href="<?= $enc->attr( $this->url( $target, $cntl, $action, array( 'l_type' => 'grid' ) + $this->get( 'listParams', [] ), [], $config ) ); ?>"></a>
							<a class="type-item type-list" title="<?= $enc->attr( $this->translate( 'client', 'List view' ) ) ?>"
								href="<?= $enc->attr( $this->url( $target, $cntl, $action, array( 'l_type' => 'list' ) + $this->get( 'listParams', [] ), [], $config ) ); ?>"></a>
						</div>*/?>
                    <!-- ::::::  Start Sort Box Section  ::::::  -->
                    <div class="sort-box ">
                        <!-- Start Sort Left Side -->
                        <div class="sort-box-item">
                            <div class="sort-box__tab">
                                <ul class="sort-box__tab-list nav">
                                    <li><a class="sort-nav-link active" data-toggle="tab" href="#sort-grid"><i class="fas fa-th"></i>  </a></li>
                                    <li><a class="sort-nav-link" data-toggle="tab" href="#sort-list"><i class="fas fa-list-ul"></i></a></li>
									
								</ul>
                            </div>
                        </div> <!-- Start Sort Left Side -->
                        <?php if( $this->get( 'listProductTotal', 0 ) > 0 && $this->config( 'client/html/catalog/lists/pagination/enable', true ) ) : ?>
						<?= $this->partial(
							$this->config( 'client/html/catalog/lists/partials/pagination', 'catalog/lists/pagination-standard' ),
							array(
								'params' => $this->get( 'listParams', [] ),
								'size' => $this->get( 'listPageSize', 48 ),
								'total' => $this->get( 'listProductTotal', 0 ),
								'current' => $this->get( 'listPageCurr', 0 ),
								'prev' => $this->get( 'listPagePrev', 0 ),
								'next' => $this->get( 'listPageNext', 0 ),
								'last' => $this->get( 'listPageLast', 0 ),
							)
						);
						?>
						<?php endif ?>
						<div class="product-page_count">
					<span><?=$this->translate( 'client', 'Found' )?> <?=$this->get( 'listProductTotal', 0 )?> <?=$this->translate( 'client', 'results' )?></span>
					</div>
					<?php endif; ?>
						<?php if( ( $searchText = $this->param( 'f_search', null ) ) != null ) : ?>
							<div class="list-search">
								<?php if( ( $total = $this->get( 'listProductTotal', 0 ) ) > 0 ) : ?>
									<?= $enc->html( sprintf(
										$this->translate(
											'client',
											'Search result for <span class="searchstring">"%1$s"</span> (%2$d article)',
											'Search result for <span class="searchstring">"%1$s"</span> (%2$d articles)',
											$total
										),
										$searchText,
										$total
									), $enc::TRUST ); ?>
								<?php else : ?>
									<?= $enc->html( sprintf(
										$this->translate(
											'client',
											'No articles found for <span class="searchstring">"%1$s"</span>. Please try again with a different keyword.'
										),
										$searchText
									), $enc::TRUST ); ?>
								<?php endif; ?> 
							</div>
						<?php endif; ?>
                       
                    </div> <!-- ::::::  Start Sort Box Section  ::::::  -->
                    
					<?= $this->block()->get( 'catalog/lists/items' ); ?>
                    <div class="page-pagination">
                        <ul class="page-pagination__list">
                            <li class="page-pagination__item"><a class="page-pagination__link"  href="#">Prev</a>
                            <li class="page-pagination__item"><a class="page-pagination__link active"  href="#">1</a></li>
                            <li class="page-pagination__item"><a class="page-pagination__link"  href="#">2</a></li>
                            <li class="page-pagination__item"><a class="page-pagination__link"  href="#">Next</a>
                            </li>
                          </ul>
                    </div>
                </div>  <!-- Start Rightside - Product Type View -->
            </div>
        </div>
    </main>  <!-- :::::: End MainContainer Wrapper :::::: -->
