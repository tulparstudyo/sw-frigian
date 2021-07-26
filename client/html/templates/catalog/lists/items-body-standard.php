<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2012
 * @copyright Aimeos (aimeos.org), 2015-2020
 */

$enc = $this->encoder();


/** client/html/catalog/lists/basket-add
 * Display the "add to basket" button for each product item
 *
 * Enables the button for adding products to the basket from the list view.
 * This works for all type of products, even for selection products with product
 * variants and product bundles. By default, also optional attributes are
 * displayed if they have been associated to a product.
 *
 * **Note:** To fetch the necessary product variants, you have to extend the
 * list of domains for "client/html/catalog/lists/domains", e.g.
 *
 *  client/html/catalog/lists/domains = array( 'attribute', 'media', 'price', 'product', 'text' )
 *
 * @param boolean True to display the button, false to hide it
 * @since 2016.01
 * @category Developer
 * @category User
 * @see client/html/catalog/domains
 */
$listTarget = $this->config( 'client/html/catalog/lists/url/target' );
$listController = $this->config( 'client/html/catalog/lists/url/controller', 'catalog' );
$listAction = $this->config( 'client/html/catalog/lists/url/action', 'list' );
$listConfig = $this->config( 'client/html/catalog/lists/url/config', [] );

/** client/html/catalog/lists/infinite-scroll
 * Enables infinite scrolling in product catalog list
 *
 * If set to true, products from the next page are loaded via XHR request
 * and added to the product list when the user reaches the list bottom.
 *
 * @param boolean True to use infinite scrolling, false to disable it
 * @since 2019.10
 * @category Developer 
 */
$infiniteScroll = $this->config( 'client/html/catalog/lists/infinite-scroll', false );
$products = $this->get( 'listProductItems', map() );

?>
<?php $this->block()->start( 'catalog/lists/items' ); ?>
<div class="product-tab-area">

    <div class="tab-content tab-animate-zoom">
        <div class="tab-pane show active shop-grid" id="sort-grid">
            <div class="row">

                <?php foreach($products as $product){     ?>
     
                <?php echo $this->partial ( $this->config( 'client/html/common/partials/product', 'common/partials/product-standard' ),
                    array(
                        'require-stock' => ( bool )$this->config( 'client/html/basket/require-stock', true ),
                        'basket-add' => $this->config( 'client/html/catalog/product/basket-add', false ),
                        'product' => $product,
                        'position' => $this->get( 'itemPosition' )
                    )
                );
                ?>
             
                <?php } ?>

            </div>
        </div>
        <div class="tab-pane shop-list" id="sort-list">
            <div class="row"> 
                <!-- Start Single List Product -->
                <?php foreach($products as $product){ ?>
                   
               
                    <?php echo $this->partial ( $this->config( 'client/html/common/partials/product', 'common/partials/product-list-standard' ),
                    array(
                        'require-stock' => ( bool )$this->config( 'client/html/basket/require-stock', true ),
                        'basket-add' => $this->config( 'client/html/catalog/product/basket-add', false ),
                        'product' => $product,
                        'position' => $this->get( 'itemPosition' )
                    )
                );
                ?> 
                <?php } ?>
                <!-- End Single List Product --> 
            </div>
        </div>
    </div>
</div>
<?php $this->block()->stop(); ?>
<?= $this->block()->get( 'catalog/lists/items' ); ?>
