<?php
if(!function_exists('frigian_url')){
	function frigian_url($file=''){
		return '/'.rtrim(config('shop.client.html.common.baseurl', 'packages/swordbros/shop/themes/frigian'), '/').'/'.ltrim($file, '/');	
	}
}
if(!function_exists('frigian_widget')){
	function frigian_widget($file=''){
		return \Aimeos\Shop\Facades\Shop::get('swordbros/frigian/widget')->getBody($file);
	}
}
if(!function_exists('frigian_header')){
	function frigian_header(){
		return \Aimeos\Shop\Facades\Shop::get('locale/select')->getBody();
	}
}
if(!function_exists('frigian_footer')){
	function frigian_footer(){
		return \Aimeos\Shop\Facades\Shop::get('swordbros/frigian/footer')->getBody();
	}
}
if(!function_exists('get_username')){
	function get_username(){
		return \Auth::user()->name;
	}
}
if(!function_exists('frigian_catalog_filter')){
	function frigian_catalog_filter(){
		return \Aimeos\Shop\Facades\Shop::get('catalog/filter')->getBody();
	}
}
if(!function_exists('frigian_top_products')){
	function frigian_top_products(){
		$ctx = \Aimeos\Shop\Facades\Shop::get('swordbros/frigian/widget')->getContext();
		$products = \Aimeos\Controller\Frontend::create( $ctx, 'product' )
			->uses( ['media', 'price', 'text'] )
			->search();
		return($products);
	}
}
if(!function_exists('frigian_new_products')){
	function frigian_new_products(){
		$ctx = \Aimeos\Shop\Facades\Shop::get('swordbros/frigian/widget')->getContext();
		$products = \Aimeos\Controller\Frontend::create( $ctx, 'product' )
			->uses( ['media', 'price', 'text'] )
			->search();
		return($products);
	}
}

// ADMIN
if(!function_exists('frigian_options')){
	function frigian_options(){
		$options = [];
		$ctx = \Aimeos\Shop\Facades\Shop::get('swordbros/frigian/widget')->getContext();
		$ctl = new \Aimeos\Admin\JQAdm\Swordbros\Frigian\Standard($ctx);
		if($ctl){
			$locale = $ctx->getLocale();
			$options['selectLanguageId'] = $locale->getLanguageId();
			$options['selectLanguageId'] = $locale->getCurrencyId();
			$options =$ctl->searchData();  
		} else {
			$options['selectLanguageId'] =  \Request::input('locale', 'ru');
			$options['selectLanguageId'] =  \Request::input('locale', 'ru');
		}
        request()->session()->put('frigian_options', $options);
        return [];
	}
}
if(!function_exists('frigian_option')){
	function frigian_option($key, $lang=false){
		$data = request()->session()->get('frigian_options', []);
		if(empty($data)) $data = frigian_options();
		return get_option_value($data, $key, $lang);  
	}
}


if(!function_exists('is_selected')){
	function is_selected($data, $key, $value){

		if(isset($data[$key]) ){
			if($data[$key]==$value){
				return "selected checked";
			} 
		}
		return "";
	}
}

if(!function_exists('is_checked')){
	function is_checked($data, $key){

		if(isset($data[$key])){
			if($data[$key]){
				return "checked";
			} 
		}
		return "";
	}
}

if(!function_exists('get_option_value')){
	function get_option_value($data, $key, $lang=false){
		if(empty($lang)) $lang = \Request::input('locale', 'ru');
		if(isset($data[$key])){
			if($lang && isset($data[$key][$lang])){
				return $data[$key][$lang];
			} else if(!is_array($data[$key])){
				return $data[$key];
			}
		}
		return null;
	}
}
if(!function_exists('frigian_admin_bar')){
	function frigian_admin_bar($context){
		echo '<span style="color:#FFF">'.get_username().' <a href="/" target="_blank">Front Page</a></span>';
	}
}

