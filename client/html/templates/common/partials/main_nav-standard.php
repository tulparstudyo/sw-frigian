<?php
$nav = $this->get( 'nav', [] );
?>
<!-- Start Header Menu -->
<div class="header-menu">
  <nav>
    <ul class="header__nav">
      <!--Start Single Nav link-->
      <li class="header__nav-item pos-relative"> <a href="<?=url('/')?>" class="header__nav-link">
      <?= $this->translate( 'client', 'Home' ); ?></a> </li>
      <!-- End Single Nav link--> 
      
      <!--Start Single Nav link--> 
      <?php /* 
      <li class="header__nav-item pos-relative"> <a href="#" class="header__nav-link">
      <?= $this->translate( 'client', 'Custom Block' ); ?> <i class="fal fa-chevron-down"></i></a> 
        <!-- Megamenu Menu-->
        <ul class="mega-menu pos-absolute">
          <li class="mega-menu__box"> 
            <!--Single Megamenu Item Menu-->
            <div class="mega-menu__item-box"> <span class="mega-menu__title">
            <?= $this->translate( 'client', 'Women Is Clothes & Fashion' ); ?></span>
              <ul class="mega-menu__item">
                <li>
                  <p><?= $this->translate( 'client', 'Shop Women Is Clothing And Accessories And Get Inspired By The Latest Fashion Trends.' ); ?></p>
                </li>
              </ul>
            </div>
            <!--Single Megamenu Item Menu--> 
            
            <!--Single Megamenu Item Menu-->
            <div class="mega-menu__item-box"> <span class="mega-menu__title">
            <?= $this->translate( 'client', 'Simple Style' ); ?></span>
              <ul class="mega-menu__item">
                <li>
                  <p> <?= $this->translate( 'client', 'A New Flattering Style With All The Comfort Of Our Linen.' ); ?></p>
                </li>
              </ul>
            </div>
            <!--Single Megamenu Item Menu--> 
            
            <!--Single Megamenu Item Menu-->
            <div class="mega-menu__item-box"> <span class="mega-menu__title"> <?= $this->translate( 'client', 'Easy Layers' ); ?></span>
              <ul class="mega-menu__item">
                <li>
                  <p><?= $this->translate( 'client', 'Endless Styling Possibilities In A Collection Full Of Versatile Pieces.' ); ?></p>
                </li>
              </ul>
            </div>
            <!--Single Megamenu Item Menu--> 
            
          </li>
          <!--Megamenu Item Banner-->
          <li class="mega-menu__banner m-t-30"> <a href="product-single-default.html" class="mega-menu__banner-link"> <img src="<?=frigian_url('assets/img/banner/menu-banner-2.png')?>" alt="" class="mega-menu__banner-img mega-menu__banner-img--horaizontal"> </a> </li>
          <!--Megamenu Item Banner-->
          
        </ul>
        <!-- Megamenu Menu--> 
      </li>
      <!-- Start Single Nav link--> 
      */?>
      <!--Start Single Nav link-->
      <li class="header__nav-item pos-relative"> <a href="/blog/page_aboutus" class="header__nav-link">
      <?= $this->translate( 'client', 'About Us' ); ?> </a> 
        
      </li>

      <li class="header__nav-item pos-relative"> <a href="/blog/page_news" class="header__nav-link"><?= $this->translate( 'client', 'Blog' ); ?> </a> 
        <!--Single Dropdown Menu
        <ul class="dropdown__menu pos-absolute">
          <li class="dropdown__list"> <a href="#" class="dropdown__link d-flex justify-content-between align-items-center"><?= $this->translate( 'client', 'Blog Grid' ); ?> <i class="far fa-chevron-right"></i></a>
            <ul class="dropdown__submenu pos-absolute">
              <li class="dropdown__submenu-list"><a href="blog-grid-sidebar-left.html" class="dropdown__submenu-link"><?= $this->translate( 'client', 'Blog Grid Left Sidebar' ); ?> </a></li>
              <li class="dropdown__submenu-list"><a href="blog-grid-sidebar-right.html" class="dropdown__submenu-link"> <?= $this->translate( 'client', 'Blog Grid Right Sidebar' ); ?></a></li>
            </ul>
          </li>
          <li class="dropdown__list"> <a href="#" class="dropdown__link d-flex justify-content-between align-items-center"><?= $this->translate( 'client', 'Blog List' ); ?> <i class="far fa-chevron-right"></i></a>
            <ul class="dropdown__submenu pos-absolute">
              <li class="dropdown__submenu-list"><a href="blog-list-sidebar-left.html" class="dropdown__submenu-link"><?= $this->translate( 'client', 'Blog List Left Sidebar' ); ?> </a></li>
              <li class="dropdown__submenu-list"><a href="blog-list-sidebar-right.html" class="dropdown__submenu-link"> <?= $this->translate( 'client', 'Blog List Right Sidebar' ); ?></a></li>
            </ul>
          </li>
          <li class="dropdown__list"> <a href="#" class="dropdown__link d-flex justify-content-between align-items-center"><?= $this->translate( 'client', 'Blog Single' ); ?> <i class="far fa-chevron-right"></i></a>
            <ul class="dropdown__submenu pos-absolute">
              <li class="dropdown__submenu-list"><a href="blog-single-sidebar-left.html" class="dropdown__submenu-link"><?= $this->translate( 'client', 'Blog Single Left Sidebar' ); ?> </a></li>
              <li class="dropdown__submenu-list"><a href="blog-single-sidebar-right.html" class="dropdown__submenu-link"><?= $this->translate( 'client', 'Blog Single Right Sidebar' ); ?> </a></li>
            </ul>
          </li>
        </ul>
    Single Dropdown Menu--> 
      </li>
      <!-- End Single Nav link--> 
      
      <!--Start Single Nav link
      <li class="header__nav-item pos-relative"> <a href="#" class="header__nav-link"><?= $this->translate( 'client', 'Pages' ); ?>  <i class="fal fa-chevron-down"></i></a> <span class="menu-label menu-label--blue"><?= $this->translate( 'client', 'New' ); ?></span> 
      Single Dropdown Menu-->
        <ul class="dropdown__menu pos-absolute">
          <li class="dropdown__list"><a href="about.html" class="dropdown__link"><?= $this->translate( 'client', 'About Us' ); ?></a></li>
          <li class="dropdown__list pos-relative"> <a href="frequently-questions.html" class="dropdown__link"><?= $this->translate( 'client', 'Frequently Questions' ); ?></a> <span class="menu-label menu-label--blue"><?= $this->translate( 'client', 'New' ); ?></span> </li>
          <li class="dropdown__list"><a href="privacy-policy.html" class="dropdown__link"><?= $this->translate( 'client', 'Privacy Policy' ); ?></a></li>
          <li class="dropdown__list"><a href="404.html" class="dropdown__link"><?= $this->translate( 'client', '404 Page' ); ?></a></li>
        </ul>
        <!--Single Dropdown Menu--> 
      </li>
      <!-- End Single Nav link--> 
      
      <!--Start Single Nav link-->
      <li class="header__nav-item pos-relative"> <a href="/blog/page_contactus" class="header__nav-link"><?= $this->translate( 'client', 'Contact Us' ); ?></a> </li>
      <!-- End Single Nav link-->
    </ul>
  </nav>
</div>
<!-- End Header Menu --> 