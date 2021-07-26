<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2014
 * @copyright Aimeos (aimeos.org), 2015-2020
 */

/* Available data:
 * - productItem : Product item incl. referenced items
 */

$enc = $this->encoder();

$favorite_product=frigian_favorite_products();
$watch_product=frigian_watch_products();

$pinTarget = $this->config( 'client/html/catalog/session/pinned/url/target' );
$pinController = $this->config( 'client/html/catalog/session/pinned/url/controller', 'catalog' );
$pinAction = $this->config( 'client/html/catalog/session/pinned/url/action', 'detail' );
$pinConfig = $this->config( 'client/html/catalog/session/pinned/url/config', [] );

$watchTarget = $this->config( 'client/html/account/watch/url/target' );
$watchController = $this->config( 'client/html/account/watch/url/controller', 'account' );
$watchAction = $this->config( 'client/html/account/watch/url/action', 'watch' );
$watchConfig = $this->config( 'client/html/account/watch/url/config', [] );

$favTarget = $this->config( 'client/html/account/favorite/url/target' );
$favController = $this->config( 'client/html/account/favorite/url/controller', 'account' );
$favAction = $this->config( 'client/html/account/favorite/url/action', 'favorite' );
$favConfig = $this->config( 'client/html/account/favorite/url/config', [] );


/** client/html/catalog/actions/list
 * List of user action names that should be displayed in the catalog detail view
 *
 * Users can add products to several personal lists that are either only
 * available during the session or permanently if the user is logged in. The list
 * of pinned products is session based while the watch list and the favorite
 * products are durable. For the later two lists, the user has to be logged in
 * so the products can be associated to the user account.
 *
 * The order of the action names in the configuration determines the order of
 * the actions on the catalog detail page.
 *
 * @param array List of user action names
 * @since 2017.04
 * @category User
 * @category Developer
 */

$urls = array(
	'pin' => $this->url( $pinTarget, $pinController, $pinAction, ['pin_action' => 'add', 'pin_id' => $this->productItem->getId(), 'd_name' => $this->productItem->getName( 'url' )], $pinConfig ),
	'watch' => $this->url( $watchTarget, $watchController, $watchAction, ['wat_action' => 'add', 'wat_id' => $this->productItem->getId(), 'd_name' => $this->productItem->getName( 'url' )], $watchConfig ),
	'favorite' => $this->url( $favTarget, $favController, $favAction, ['fav_action' => 'add', 'fav_id' => $this->productItem->getId(), 'd_name' => $this->productItem->getName( 'url' )], $favConfig ),
);

$icons = array('pin'=>'fa-map-pin','watch'=>'fa-eye','favorite'=>'fa-heart');
?>

<?php $params_fav = ['fav_action' => 'delete', 'fav_id' =>$this->productItem->getId()] + $this->get( 'favoriteParams', [] ); ?>
<?php $params_watch = ['wat_action' => 'delete', 'wat_id' => $this->productItem->getId()] + $this->get( 'watchParams', [] ); ?>
		
<div class="catalog-actions">
	<?php foreach( $this->config( 'client/html/catalog/actions/list', ['pin', 'watch', 'favorite'] ) as $entry ) : ?>
		
		<?php if( isset( $urls[$entry] ) ) : ?>
            <?php 
            $fav_class = '';
            foreach( $favorite_product as $listItem ) {
                $fav_id=$listItem->getRefId(); 
                 if($entry == "favorite" && $fav_id == $this->productItem->getId() ) {
                    $fav_class = 'fav-added';
                } 
            }?>
            <?php 
            $watch_class = '';
            foreach( $watch_product as $listItem ) {
                $watch_id=$listItem->getRefId(); 
                 if($entry == "watch" && $watch_id == $this->productItem->getId() ) {
                    $fav_class = 'watch-added';
                } 
            }?>
			<a class="actions-button <?=$fav_class?> <?=$watch_class?> actions-button-<?= $enc->attr( $entry ) ?> " 
            data-add="<?= $enc->attr( $urls[$entry] );  ?> " data-remove="<?= $enc->attr( $this->url( $favTarget, $favController, $favAction, $params_fav, [], $favConfig ) ); ?> " 
            data-remove-watch="<?= $this->url( $watchTarget, $watchController, $watchAction, $params_watch, [], $watchConfig ); ?> " 
            href="<?= $enc->attr( $urls[$entry] ); ?>" title="<?= $enc->attr( $this->translate( 'client/code', $entry ) ); ?>">
            <i  style ="width: 40px; height:40px;padding-top: 10px;"data-toggle="tooltip" data-placement="top" title="<?= $enc->attr( $this->translate( 'client/code', $entry ) ); ?>"  class="fa <?= @$icons[$enc->attr( $entry )]; ?> "></i></a>

	
			<?php endif; ?>
	<?php endforeach; ?>

	
	

</div>
<script>

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
