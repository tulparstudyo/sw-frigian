<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2013
 * @copyright Aimeos (aimeos.org), 2015-2020
 */

$enc = $this->encoder();

$listTarget = $this->config( 'client/html/catalog/lists/url/target' );
$listController = $this->config( 'client/html/catalog/lists/url/controller', 'catalog' );
$listAction = $this->config( 'client/html/catalog/lists/url/action', 'list' );
$listConfig = $this->config( 'client/html/catalog/lists/url/config', [] );

$suggestTarget = $this->config( 'client/html/catalog/suggest/url/target' );
$suggestController = $this->config( 'client/html/catalog/suggest/url/controller', 'catalog' );
$suggestAction = $this->config( 'client/html/catalog/suggest/url/action', 'suggest' );
$suggestConfig = $this->config( 'client/html/catalog/suggest/url/config', [] );
$enforce = $this->config( 'client/html/catalog/filter/search/force-search', true );

?>
<?php /*$this->block()->start( 'catalog/filter/search' ); ?>

		<form  class="header-search" method="GET" action="<?= $enc->attr( $this->url( $listTarget, $listController, $listAction, $this->get( 'filterParams', [] ), $listConfig ) ); ?>">
        <div class="header-search__content pos-relative">

		<input class="form-control value" type="search"
			name="<?= $enc->attr( $this->formparam( 'f_search' ) ) ?>"
			title="<?= $enc->attr( $this->translate( 'client', 'Search' ) ) ?>"
			placeholder="<?= $enc->attr( $this->translate( 'client', 'Search' ) ) ?>"
			value="<?= $enc->attr( $enforce ? $this->param( 'f_search' ) : '' ) ?>"
			data-url="<?= $enc->attr( $this->url( $suggestTarget, $suggestController, $suggestAction, [], [], $suggestConfig ) ) ?>"
			data-hint="<?= $enc->attr( $this->translate( 'client', 'Please enter at least three characters' ) ) ?>">

            <button class="pos-absolute" type="submit"><i class="icon-search"></i></button>
        </div>


		</form>

<?php $this->block()->stop(); ?>

<?= $this->block()->get( 'catalog/filter/search' ); */?>


<?php $this->block()->start( 'catalog/filter/search' ); ?>
<form  class="header-search" method="GET" action="<?= $enc->attr( $this->url( $listTarget, $listController, $listAction, $this->get( 'filterParams', [] ), $listConfig ) ); ?>">
     
<div class="catalog-filter-search">
	<div class="widget header-search__content pos-relative">
                  <!-- <h5 class="widget-title line-bottom"><?= $enc->html( $this->translate( 'client', 'Search' ), $enc::TRUST ); ?></h5> -->
                  <div class="search-form">
	          
						<input class="form-control value" type="text" 
							name="<?= $enc->attr( $this->formparam( 'f_search' ) ) ?>"
							value="<?= $enc->attr( $enforce ? $this->param( 'f_search' ) : '' ) ?>"
							placeholder="<?= $enc->attr( $this->translate( 'client', 'Search' ) ) ?>"
							data-url="<?= $enc->attr( $this->url( $suggestTarget, $suggestController, $suggestAction, ['site' => 'default'], [], $suggestConfig ) ) ?>"
							data-hint="<?= $enc->attr( $this->translate( 'client', 'Please enter at least three characters' ) ) ?>"
						 />
						 <button class="pos-absolute" type="submit"><i class="icon-search"></i></button>
				</div>        
	</div>
	
</div>

</form>
<?php $this->block()->stop(); ?>
<?= $this->block()->get( 'catalog/filter/search' ); ?>
