<?php
$nav = $this->get( 'nav', [] );
?>
<!--  Start Mobile-offcanvas Menu Section   -->
<div id="offcanvas-mobile-menu" class="offcanvas offcanvas-mobile-menu">
  <div class="offcanvas__top"> <span class="offcanvas__top-text"></span>
    <button class="offcanvas-close"><i class="fal fa-times"></i></button>
  </div>
  <div class="offcanvas-inner">
    <?=$nav['locale']?>
   
                               
  
    <div class="offcanvas-menu">
    <?=$this->partial( $this->config( 'client/html/common/partials/category_nav', 'common/partials/category_nav-standard' ),
			array(
				'nav' => $nav,
			)
		);?>
  
    </div>
  </div>
  <ul class="offcanvas__social-nav m-t-50">
    <li class="offcanvas__social-list"><a href="#" class="offcanvas__social-link"><i class="fab fa-facebook-f"></i></a></li>
    <li class="offcanvas__social-list"><a href="#" class="offcanvas__social-link"><i class="fab fa-twitter"></i></a></li>
    <li class="offcanvas__social-list"><a href="#" class="offcanvas__social-link"><i class="fab fa-youtube"></i></a></li>

    <li class="offcanvas__social-list"><a href="#" class="offcanvas__social-link"><i class="fab fa-instagram"></i></a></li>
  </ul>
</div>
<!--  End Mobile-offcanvas Menu Section   --> 

