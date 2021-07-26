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


/** client/html/catalog/filter/tree/force-search
 * Use the current category in full text searches
 *
 * Normally, a full text search finds all products that match the entered string
 * regardless of the category the user is currently in. This is also the standard
 * behavior of other shops.
 *
 * If it's desired, setting this configuration option to "1" will limit the full
 * text search to the current category only, so only products that match the text
 * and which are in the current category are found.
 *
 * @param boolean True to enforce current category for search, false for full text search only
 * @since 2015.10
 * @category Developer
 * @category User
 */
$enforce = $this->config( 'client/html/catalog/filter/tree/force-search', false );

/** client/html/catalog/filter/partials/tree
 * Relative path to the category tree partial template file
 *
 * Partials are templates which are reused in other templates and generate
 * reoccuring blocks filled with data from the assigned values. The tree
 * partial creates an HTML block of nested lists for category trees.
 *
 * @param string Relative path to the template file
 * @since 2017.01
 * @category Developer
 */


?>
<?php $this->block()->start( 'catalog/filter/tree' ); ?>
<?php if( isset( $this->treeCatalogTree ) && $this->treeCatalogTree->getStatus() > 0 && !$this->treeCatalogTree->getChildren()->isEmpty() ) : ?>
                        <!-- Start Single Sidebar Widget - Filter [Catagory] -->
                        <div class="sidebar__widget">
                            <div class="sidebar__box">
                                <h5 class="sidebar__title">   <?= $enc->html( $this->translate( 'client', 'Product Categories' ), $enc::TRUST ); ?>
                             
                            </div>
                            <ul class="sidebar__menu">
                                <li>
                                    <ul class="sidebar__menu-collapse">
                                        <!-- Start Single Menu Collapse List -->
                                       <li class="sidebar__menu-collapse-list">
                                           <div class="accordion">
                                            <?= $this->partial(
                                                $this->config( 'client/html/catalog/filter/partials/tree', 'catalog/filter/tree-partial-standard' ),
                                                [
                                                    'nodes' => $this->treeCatalogTree->getChildren(),
                                                    'path' => $this->get( 'treeCatalogPath', map() ),
                                                    'params' => $this->get( 'treeFilterParams', [] ),
                                                    'level' => 1
                                                ]
                                            ); ?>

                                           </div>
                                       </li> <!-- End Single Menu Collapse List -->
                                   </ul>
                                </li>
                                <li>
                                <a href="/shop" > <?= $enc->html( $this->translate( 'client', 'All Products' ), $enc::TRUST ); ?> </a>
                              </li>
                            </ul>
                        </div>  <!-- End SSingle Sidebar Widget - Filter [Catagory] -->

<?php endif ?>
<?php $this->block()->stop(); ?>
<?= $this->block()->get( 'catalog/filter/tree' ); ?>
