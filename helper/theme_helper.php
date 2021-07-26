
<?php

if(!function_exists('frigian_url')){
	function frigian_url($file=''){
		return '/'.rtrim(config('shop.client.html.common.baseurl', 'packages/swordbros/shop/themes/frigian'), '/').'/'.ltrim($file, '/');	
	}
}
if(!function_exists('frigian_home_products')){
	function frigian_home_products(){
		return \Aimeos\Shop\Facades\Shop::get('swordbros/homeProducts')->getBody();
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
if(!function_exists('frigian_catalog_session')){
	function frigian_catalog_session(){
		return \Aimeos\Shop\Facades\Shop::get('catalog/session')->getBody();
	}
}
if(!function_exists('frigian_catalog_list_types')){
    function frigian_catalog_list_types(){
        $rows = \DB::table('mshop_catalog_list_type')
            ->where('domain', 'product')
            ->get();
        if($rows){
            return $rows;
        } else{
            return [];
        }
    }
}
if(!function_exists('frigian_top_products')){
	function frigian_top_products(){
 

		$ctx = \Aimeos\Shop\Facades\Shop::get('swordbros/frigian/widget')->getContext();
		$manager = \Aimeos\MShop::create( $ctx, 'order/base/product' );
		$result = $manager->aggregate( $manager->filter(), 'order.base.product.productid', 'order.base.product.quantity', 'sum' ); 
	
		// find the products which are sold most in $result (product ID is the key, count is the value)
		$prodIds = $result->arsort()->keys()->toArray();
		//print_r(	$result );

		$products=array();
		 
			foreach($prodIds as $ids){
				if (\Aimeos\Controller\Frontend::create( $ctx, 'product' )->uses( ['text','price', 'media'] )->product($ids)->search()->toArray() != []){
					$products[]= \Aimeos\Controller\Frontend::create( $ctx, 'product' )->uses( ['text','price', 'media'] )->get($ids);
				}
				
			}
		
		//$products= \Aimeos\Controller\Frontend::create( $ctx, 'product' )->uses( ['text','price', 'media'] )->product($prodIds)->search();

		return($products);

	}
}

if(!function_exists('frigian_new_products')){
	function frigian_new_products(){
		$ctx = \Aimeos\Shop\Facades\Shop::get('swordbros/frigian/widget')->getContext();
		$products = \Aimeos\Controller\Frontend::create( $ctx, 'product' )->sort('-ctime')
			->uses( ['media', 'price', 'text'] )
			->search();

		return($products);
	}
}

if(!function_exists('frigian_favorite_products')){

	function frigian_favorite_products(){
		$context = \Aimeos\Shop\Facades\Shop::get('swordbros/frigian/widget')->getContext();
	
		$domains = $context->getConfig()->get( 'client/html/account/favorite/domains', ['text', 'price', 'media'] );
		$domains['product'] = ['favorite'];

		$cntl = \Aimeos\Controller\Frontend::create( $context, 'customer' );
		$listItems = $cntl->uses( $domains )->get()->getListItems( 'product', 'favorite' );
		
	
		

		return $listItems;

	}
}
if(!function_exists('frigian_watch_products')){

	function frigian_watch_products(){
		$context = \Aimeos\Shop\Facades\Shop::get('swordbros/frigian/widget')->getContext();
	
		$domains = $context->getConfig()->get( 'client/html/account/watch/domains', ['text', 'price', 'media'] );
		$domains['product'] = ['watch'];

		$cntl = \Aimeos\Controller\Frontend::create( $context, 'customer' );
		$listItems = $cntl->uses( $domains )->get()->getListItems( 'product', 'watch' );
		
		return $listItems;

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

if(!function_exists('frigian_deleteFavorites')){
	function frigian_deleteFavorites($ids){
		
		$cntl = \Aimeos\Controller\Frontend::create(  \Aimeos\Shop\Facades\Shop::get('swordbros/frigian/widget')->getContext(), 'customer' );
	
		$item = $cntl->uses( ['product' => ['favorite']] )->get();
		
			if( ( $listItem = $item->getListItem( 'product', 'favorite', $ids ) ) !== null ) {
				$cntl->deleteListItem( 'product', $listItem );
			}
		

		$cntl->store();
	}
	
}
