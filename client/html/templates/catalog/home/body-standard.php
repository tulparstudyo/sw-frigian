<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2020
 */

$enc = $this->encoder();
$pos = 0;
frigian_options();
?>
<!-- :::::: Start Main Container Wrapper :::::: -->
<main id="main-container" class="main-container">
<?php 
	if(frigian_option('show_slider')){
		echo frigian_widget('slider');
	}
?>
<?php/* echo frigian_widget('top-banner');*/?>

<?php if(frigian_option('show_risk_reducer')){
		echo frigian_widget('top-categories');
	}?>
<?php if(frigian_option('show_top_products')){
		echo frigian_widget('top-products');
	} ?>
<?php /*echo frigian_widget('special-discount');*/?>
<?php echo frigian_home_products();?>
<?php if(frigian_option('show_new_products')){
		echo frigian_widget('new-products');
	} ?>
<?php if(frigian_option('show_client_says')){
		echo frigian_widget('testimonials');
	} ?>
<?php if(frigian_option('show_latest_news')){
		echo frigian_widget('latest-news');
	} ?>
<?php if(frigian_option('show_subscribe_form')){
		echo frigian_widget('newsletter');
	}  ?>
<?php if(frigian_option('show_logo_slider')){
		echo frigian_widget('logo-slider');
	}?>
</main>  
<!-- :::::: End MainContainer Wrapper :::::: -->
