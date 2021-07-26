<?php
$nav = $this->get('nav', []);
?>
<!--  Start Large Header Section   -->
<div class="header d-none d-lg-block">
            <!-- Start Header Top area --> 
            <div class="header__top">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="header__top-content d-flex justify-content-between align-items-center">
                                <div class="header__top-content--left">
                                    <span><?= frigian_option('topbar_text'); ?></span>
                                </div>
<?=$nav['locale']?>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
			<!-- Start Header Top area -->

            <!-- Start Header Center area -->
            <!-- End Header Center area -->
            <!-- Start Header bottom area -->
            <div class="header__bottom p-tb-30">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-xl-3 col-lg-3">
                            <div class="header-menu-vertical pos-relative">
                                <h4 class="menu-title link--icon-left"><i class="far fa-align-left"></i><?=$this->translate('client', 'Categories')?></h4>
                                <?=$this->partial( $this->config( 'client/html/common/partials/category_nav', 'common/partials/category_nav-standard' ),
			                        array(
				                    'nav' => $nav,
			                        )
		                            );?>
                                </div>
                        </div>
                        <div class="col-xl-7 col-lg-6">
                            <form class="header-search" action="#" method="post">
                                <div class="header-search__content pos-relative">
                                    <input type="search" name="header-search" placeholder="<?= $this->translate( 'client', 'Search our store' ); ?>" required>
                                    <button class="pos-absolute" type="submit"><i class="icon-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-xl-2 col-lg-3" style="padding-left: 0; padding-right: 0;">
                            <div class="header-phone text-right"><span><?= $this->translate( 'client', 'Call Us:' ); echo frigian_option('store_phone');?> </span></div>
                        </div>
                    </div>
                </div>
            </div> 
			<!-- End Header bottom area -->

        </div> 
<!--  End Large Header Section  -->

<!--  Start Mobile Header Section   -->
        <div class="header__mobile mobile-header--1 d-block d-lg-none p-tb-20">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-12 d-flex align-items-center justify-content-between">
                        <ul class="header__mobile--leftside d-flex align-items-center justify-content-start">
                            <li>
                                <div class="header__mobile-logo">
                                    <a href="index.html" class="header__mobile-logo-link">
                                        <img src="<?=frigian_url('assets/img/logo/logo.png')?>" alt="" class="header__mobile-logo-img">
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <!-- Start User Action -->
                        <ul class="header__mobile--rightside header__user-action-icon  d-flex align-items-center justify-content-end"> 
                            <!-- Start Header Add Cart Box -->
                            <li>

                            <div class="aimeos">

                                <a href="#offcanvas-add-cart__box" class="offcanvas-toggle basket-mini-main" >
                                <i class="icon-shopping-cart"></i>
                                <span class="wishlist-item-count pos-absolute-main quantity">0</span>
                                    </a>

                            </div>

                            </li> <!-- End Header Add Cart Box -->
                            <li><a href="#offcanvas-mobile-menu" class="offcanvas-toggle"><i class="far fa-bars"></i></a></li>

                        </ul>   <!-- End User Action -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="header-menu-vertical pos-relative m-t-30">
                            <h4 class="menu-title link--icon-left"><i class="far fa-align-left"></i><?=$this->translate('client', 'Categories')?></h4>						
<?=$this->partial( $this->config( 'client/html/common/partials/category_nav', 'common/partials/category_nav-standard' ),
			array(
				'nav' => $nav,
			)
		);?>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
<!--  Start Mobile Header Section   -->
<?=$this->partial( $this->config( 'client/html/common/partials/desktop_nav', 'common/partials/desktop_nav-standard' ),
			array(
				'nav' => $nav,
			)
		);?>
