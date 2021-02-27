<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2014
 * @copyright Aimeos (aimeos.org), 2015-2020
 */

$enc = $this->encoder();

$target = $this->config( 'client/jsonapi/url/target' );
$controller = $this->config( 'client/jsonapi/url/controller', 'jsonapi' );
$action = $this->config( 'client/jsonapi/url/action', 'options' );
$config = $this->config( 'client/jsonapi/url/config', [] );


$tree = \Aimeos\Shop\Facades\Shop::get('catalog/filter');

$view = $tree->addData($this);

$nav['locale'] = $this->partial( $this->config( 'client/html/common/partials/locale', 'common/partials/locale-standard' ),
			array(
				'selectMap' => $this->get( 'selectMap', [] ),
				'selectLanguageId' => $this->get( 'selectLanguageId', 'ru' ),
				'selectCurrencyId' => $this->get( 'selectCurrencyId', 'RUB' ),
			)
		);		
$nav['items'] = [];
$nav['categories'] = \Aimeos\Shop\Facades\Catalog::uses(['text', 'media'])->getTree();

$header_type = frigian_option('header_type');
if(empty($header_type)) $header_type = 'standard';
$this->block()->start( 'locale/select' ); 
echo $this->partial( $this->config( 'client/html/header', 'header/body-'.$header_type ),
			array(
				'nav' => $nav,
			)
		);
$this->block()->stop(); ?>
<?= $this->block()->get( 'locale/select' ); ?>
