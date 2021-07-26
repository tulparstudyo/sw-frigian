<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2012
 * @copyright Aimeos (aimeos.org), 2015-2020
 */


$enc = $this->encoder();


$listTarget = $this->config( 'client/html/catalog/lists/url/target' );

$listController = $this->config( 'client/html/catalog/lists/url/controller', 'catalog' );

$listAction = $this->config( 'client/html/catalog/lists/url/action', 'list' );

$listConfig = $this->config( 'client/html/catalog/lists/url/config', [] );

$optTarget = $this->config( 'client/jsonapi/url/target' );
$optCntl = $this->config( 'client/jsonapi/url/controller', 'jsonapi' );
$optAction = $this->config( 'client/jsonapi/url/action', 'options' );
$optConfig = $this->config( 'client/jsonapi/url/config', [] );


?>
<section class="aimeos catalog-filter" data-jsonurl="<?= $enc->attr( $this->url( $optTarget, $optCntl, $optAction, [], [], $optConfig ) ); ?>">

	<?php if( isset( $this->filterErrorList ) ) : ?>
		<ul class="error-list">
			<?php foreach( (array) $this->filterErrorList as $errmsg ) : ?>
				<li class="error-item"><?= $enc->html( $errmsg ); ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

	<nav>
		<form class="row" method="GET" action="<?= $enc->attr( $this->url( $listTarget, $listController, $listAction, $this->get( 'filterParams', [] ), $listConfig ) ); ?>">
	

			<?= $this->block()->get( 'catalog/filter/tree' ); ?>

			<?php if ($this->param('f_name')) : ?>
				<input type="hidden" name="f_name" value="<?=$this->param('f_name')?>" >

			<?php endif; ?>

			<?php if ($this->param('f_catid')) : ?>
	
				<input type="hidden" name="f_catid" value="<?=$this->param('f_catid')?>" >
			<?php endif; ?>

			
         
			<?= $this->block()->get( 'catalog/filter/price' ); ?>
          
			<?= $this->block()->get( 'catalog/filter/supplier' ); ?>
			<?= $this->block()->get( 'catalog/filter/attribute' ); ?>
			<?= $this->block()->get( 'catalog/session/pinned' ); ?>
			<?= $this->block()->get( 'catalog/session/seen' ); ?>

		</form>
	</nav>

</section>
