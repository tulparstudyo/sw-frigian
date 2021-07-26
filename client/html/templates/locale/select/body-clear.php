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
            <div class="header__center sticky-header p-tb-10">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <!-- Start Logo -->
                            <div class="header__logo">
                                <a href="<?=url('/')?>" class="header__logo-link img-responsive">
                                    <img class="header__logo-img img-fluid" src="<?=frigian_url('assets/img/logo/logo.png')?>" alt="">
                                </a>
                            </div> <!-- End Logo -->
<?=$this->partial( $this->config( 'client/html/common/partials/main_nav', 'common/partials/main_nav-standard' ),
			array(
				'nav' => $nav,
			)
		);?>
							<!-- Start Wishlist-AddCart -->
                            <ul class="header__user-action-icon">
				<!-- Start Header Wishlist Box -->
				<?php if (Auth::guest()){ ?>
					<li class="nav-item"><a href="<?=route('login')?>"><i class="icon-users"></i></a></li>
				<?php } else { ?>
					<li class="nav-item dropdown">
						<!--<a  title="<?= get_username() ?>"><small style="font-size:10px;"><?= get_username() ?></small></a>-->
						<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="padding: 0px" href="<?=route('login')?>"><i class="icon-users"></i></a>
						<ul class="dropdown-menu" role="menu">
							<li><a class="nav-link" href="<?= route('aimeos_shop_account',['site'=>Route::current()->parameter('site','default'),'locale'=>Route::current()->parameter('locale','en'),'currency'=>Route::current()->parameter('currency','EUR')]) ?>" title="<?=$this->translate('client', 'Profile')?>"><?=$this->translate('client', 'Profile')?></a></li>
							<li><form id="logout" action="/logout" method="POST"><?= csrf_field()?></form><a class="nav-link" href="javascript: document.getElementById('logout').submit();"><?=$this->translate('client', 'Logout')?></a></li>
						</ul>
					</li>
				<?php } ?>
				<!-- End Header Wishlist Box -->
                                <!-- Start Header Wishlist Box -->
                                <!--<li>
                                    <a href="wishlist.html">
                                        <i class="icon-heart"></i>
                                        <span class="item-count pos-absolute">0</span>
                                    </a>
                                </li> -->
								<!-- End Header Wishlist Box -->
                                <!-- Start Header Add Cart Box -->
                                <li>
                                    <a href="#offcanvas-add-cart__box" class="offcanvas-toggle">
                                        <i class="icon-shopping-cart"></i>
                                        <span class="wishlist-item-count pos-absolute">0</span>
                                    </a>
                                </li> <!-- End Header Add Cart Box -->
                            </ul> 
                        </div>
                    </div>
                </div>
            </div> <!-- End Header Center area -->
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
                                <a href="#offcanvas-add-cart__box" class="offcanvas-toggle">
                                    <i class="icon-shopping-cart"></i>
                                    <span class="wishlist-item-count pos-absolute">3</span>
                                </a>
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
