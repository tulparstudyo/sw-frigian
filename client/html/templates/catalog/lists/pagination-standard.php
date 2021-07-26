<?php
/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2012
 * @copyright Aimeos (aimeos.org), 2015-2020
 */
$enc = $this->encoder();
if( $this->get( 'params/f_catid' ) !== null )
{
	$listTarget = $this->config( 'client/html/catalog/tree/url/target' );
	$listController = $this->config( 'client/html/catalog/tree/url/controller', 'catalog' );
	$listAction = $this->config( 'client/html/catalog/tree/url/action', 'tree' );
	$listConfig = $this->config( 'client/html/catalog/tree/url/config', [] );
}
else
{
	$listTarget = $this->config( 'client/html/catalog/lists/url/target' );
	$listController = $this->config( 'client/html/catalog/lists/url/controller', 'catalog' );
	$listAction = $this->config( 'client/html/catalog/lists/url/action', 'list' );
	$listConfig = $this->config( 'client/html/catalog/lists/url/config', [] );
}
$params = $this->get( 'params', [] );
$sort = $this->get( 'params/f_sort', $this->config( 'client/html/catalog/lists/sort', 'relevance' ) );
$sortname = ltrim( $sort, '-' );
$nameDir = $priceDir = '';
if( $sort === 'name' ) {
	$nameSort = $this->translate( 'client', '▼ Name' ); $nameDir = '-';
} else if( $sort === '-name' ) {
	$nameSort = $this->translate( 'client', '▲ Name' );
} else {
	$nameSort = $this->translate( 'client', 'Name' );
}
if( $sort === 'price' ) {
	$priceSort = $this->translate( 'client', '▼ Price' ); $priceDir = '-';
} else if( $sort === '-price' ) {
	$priceSort = $this->translate( 'client', '▲ Price' );
} else {
	$priceSort = $this->translate( 'client', 'Price' );
}
?>
<nav class="pagination">
	
<div class="product-item-selection_area">
<div class="sort-box-item d-flex align-items-center flex-warp sort">
<span><?= $enc->html( $this->translate( 'client', 'Sort by:' ), $enc::TRUST ); ?></span>
<div class="sort-box__option">
                                <label class="select-sort__arrow">
	<select  name="select-sort" class="select-sort nice-select myniceselect" onchange="location = this.value;">
						<?php $url = $this->url( $listTarget, $listController, $listAction, array( 'f_sort' => 'relevance' ) + $params, [], $listConfig ); ?>
<option value="<?= $enc->attr( $url ); ?>" <?= ( $sort === 'relevance' ? 'selected' : '' ); ?>>
<?= $enc->html( $this->translate( 'client', 'Relevance' ), $enc::TRUST ); ?>
</option>
<?php $url = $this->url( $listTarget, $listController, $listAction, array( 'f_sort' => '-ctime' ) + $params, [], $listConfig ); ?>
<option value="<?= $enc->attr( $url ); ?>" <?= ( $sort === '-ctime' ? 'selected' : '' ); ?>>
<?= $enc->html( $this->translate( 'client', 'Latest' ), $enc::TRUST ); ?>
</option>
<?php $url = $this->url( $listTarget, $listController, $listAction, array( 'f_sort' => 'name' ) + $params, [], $listConfig ); ?>
<option value="<?= $enc->attr( $url ); ?>" <?= ( $sort === 'name' ? 'selected' : '' ); ?>>
<?= $enc->html( $nameSort, $enc::TRUST ); ?>
</option>
<?php $url = $this->url( $listTarget, $listController, $listAction, array( 'f_sort' => 'price' ) + $params, [], $listConfig ); ?>
<option value="<?= $enc->attr( $url ); ?>" <?= ( $sort === 'price' ? 'selected' : '' ); ?>>
<?= $enc->html( $priceSort, $enc::TRUST ); ?>
</option>
	</select>
	</label>
                            </div>
</div>
</div>
<?php if( $this->last > 1 ) : ?>
		<div class="browser">
			<?php $url = $this->url( $listTarget, $listController, $listAction, array( 'l_page' => 1 ) + $params, [], $listConfig ); ?>
			<a class="first" href="<?= $enc->attr( $url ); ?>">
				<?= $enc->html( $this->translate( 'client', '◀◀' ), $enc::TRUST ); ?>
			</a>
			<?php $url = $this->url( $listTarget, $listController, $listAction, array( 'l_page' => $this->prev ) + $params, [], $listConfig ); ?>
			<a class="prev" href="<?= $enc->attr( $url ); ?>" rel="prev">
				<?= $enc->html( $this->translate( 'client', '◀' ), $enc::TRUST ); ?>
			</a>
			<span><?= $enc->html( sprintf( $this->translate( 'client', 'Page %1$d of %2$d' ), $this->current, $this->last ) ); ?></span>
			<?php $url = $this->url( $listTarget, $listController, $listAction, array( 'l_page' => $this->next ) + $params, [], $listConfig ); ?>
			<a class="next" href="<?= $enc->attr( $url ); ?>" rel="next">
				<?= $enc->html( $this->translate( 'client', '▶' ), $enc::TRUST ); ?>
			</a>
			<?php $url = $this->url( $listTarget, $listController, $listAction, array( 'l_page' => $this->last ) + $params, [], $listConfig ); ?>
			<a class="last" href="<?= $enc->attr( $url ); ?>">
				<?= $enc->html( $this->translate( 'client', '▶▶' ), $enc::TRUST ); ?>
			</a>
		</div>
	<?php endif; ?>
</nav>
