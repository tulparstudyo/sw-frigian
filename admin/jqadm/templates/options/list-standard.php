<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2020
 */

$enc = $this->encoder(); 


$target = $this->config( 'admin/jqadm/url/save/target' );
$controller = $this->config( 'admin/jqadm/url/save/controller', 'Jqadm' );
$action = $this->config( 'admin/jqadm/url/save/action', 'save' );
$config = $this->config( 'admin/jqadm/url/save/config', [] );

$newTarget = $this->config( 'admin/jqadm/url/create/target' );
$newCntl = $this->config( 'admin/jqadm/url/create/controller', 'Jqadm' );
$newAction = $this->config( 'admin/jqadm/url/create/action', 'create' );
$newConfig = $this->config( 'admin/jqadm/url/create/config', [] );

$getTarget = $this->config( 'admin/jqadm/url/get/target' );
$getCntl = $this->config( 'admin/jqadm/url/get/controller', 'Jqadm' );
$getAction = $this->config( 'admin/jqadm/url/get/action', 'get' );
$getConfig = $this->config( 'admin/jqadm/url/get/config', [] );

$copyTarget = $this->config( 'admin/jqadm/url/copy/target' );
$copyCntl = $this->config( 'admin/jqadm/url/copy/controller', 'Jqadm' );
$copyAction = $this->config( 'admin/jqadm/url/copy/action', 'copy' );
$copyConfig = $this->config( 'admin/jqadm/url/copy/config', [] );

$delTarget = $this->config( 'admin/jqadm/url/delete/target' );
$delCntl = $this->config( 'admin/jqadm/url/delete/controller', 'Jqadm' );
$delAction = $this->config( 'admin/jqadm/url/delete/action', 'delete' );
$delConfig = $this->config( 'admin/jqadm/url/delete/config', [] );

$default = [ 'slider.status', 'slider.type', 'slider.label', 'slider.provider', 'slider.domain' ];
$default = $this->config( 'admin/jqadm/slider/fields', $default );
$fields = $this->session( 'aimeos/admin/jqadm/slider/fields', $default );

$searchParams = $params = $this->get( 'pageParams', [] );
$searchParams[ 'page' ][ 'start' ] = 0;

$typeList = [];
foreach ( $this->get( 'itemTypes', [] ) as $typeItem ) {
    $typeList[ $typeItem->getCode() ] = $typeItem->getCode();
}

?>
<?php $this->block()->start( 'jqadm_content' ); ?>
<nav class="main-navbar"> <span class="navbar-brand">
  <?= $enc->html( $this->translate( 'admin', 'Swordbros Template Options' ) ); ?>
  <span class="navbar-secondary">(
  <?= $enc->html( $this->site()->label() ); ?>
  )</span> </span> </nav>
<?= $this->partial (
    $this->config( 'admin/jqadm/partial/pagination', 'common/partials/pagination-standard' ), [ 'pageParams' => $params, 'pos' => 'top', 'total' => $this->get( 'total' ),
        'page' => $this->session( 'aimeos/admin/jqadm/slider/page', [] )
    ]
);
?>
<form class="item item-frigian form-horizontal" method="POST" action="<?= $enc->attr( $this->url( $target, $controller, $action, $searchParams, [], $config ) ); ?>">
  <?= $this->csrf()->formfield(); ?>
  <div class="row item-container">
    <div class="col-md-3 item-navbar">
      <div class="navbar-content">
        <ul class="nav nav-tabs flex-md-column flex-wrap d-flex justify-content-between" role="tablist">
          <li class="nav-item basic"> <a class="nav-link active" href="#basic" data-toggle="tab" role="tab" aria-expanded="true" aria-controls="basic"> Basic</a> </li>
          <li class="nav-item header"> <a class="nav-link" href="#header" data-toggle="tab" role="tab"> Header</a> </li>
          <li class="nav-item home-page"> <a class="nav-link" href="#footer" data-toggle="tab" role="tab"> Footer</a> </li>
          <li class="nav-item home-page"> <a class="nav-link" href="#home-page" data-toggle="tab" role="tab"> Home Page</a> </li>
          <li class="nav-item legals"> <a class="nav-link" href="#legals" data-toggle="tab" role="tab"> Legals</a> </li>
          <li class="nav-item pages"> <a class="nav-link" href="#pages" data-toggle="tab" role="tab"><?= $enc->html( $this->translate( 'admin', 'Pages' ) ); ?> </a> </li>
          <li class="nav-item help"> <a class="nav-link" href="#help" data-toggle="tab" role="tab"> Support</a> </li>
        </ul>
        <br>
        <button class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
      </div>
    </div>
    <div class="col-md-9 item-content tab-content">
      <div id="basic" class="row item-basic tab-pane fade active show col-md-12" role="tabpanel" aria-labelledby="basic">
        <h2>Basic</h2>
        <div class="col-md-12 home-section">
          <h4>Store Info</h4>
          <nav>
            <div class="nav nav-tabs nav-fill" id="tore-nav-tab" role="tablist">
              <?php if( ( $languages = $this->get( 'pageLangItems', map() ) )->count() >0 ) : ?>
              <?php foreach($languages as $language){ ?>
              <a class="nav-item nav-link" id="store-nav-<?=$language->getCode()?>-tab" data-toggle="tab" href="#store-nav-<?=$language->getCode()?>" role="tab" aria-controls="nav-<?=$language->getCode()?>" aria-selected="true"><img src="/packages/swordbros/shop/themes/frigian/assets/img/icon/flag/icon_<?=$language->getCode()?>.png" width="24">
              <?=$language->getCode()?>
              </a>
              <?php }?>
              <?php endif; ?>
            </div>
          </nav>
          <div class="tab-content py-3 px-3 px-sm-0" id="tore-nav-tabContent">
            <?php if( ( $languages = $this->get( 'pageLangItems', map() ) )->count() >0 ) : ?>
            <?php foreach($languages as $language){?>
            <div class="tab-pane fade show" id="store-nav-<?=$language->getCode()?>" role="tabpanel" aria-labelledby="store-nav-<?=$language->getCode()?>-tab">
              <div class="tab-content clearfix">
                <h5>
                  <?=$language->getLabel()?>
                  Content's Tab</h5>
                  <div class="form-group row ">
                    <label class="col-sm-4 form-control-label help" >Store Name</label>
                    <div class="col-sm-8">
                      <input type="text" name="option[store_name][<?=$language->getCode()?>]"  value="<?=get_option_value($this->items, 'store_name', $language->getCode())?>" class="form-control item-label">
                    </div>
                  </div>
                  <div class="form-group row ">
                  <label class="col-sm-4 form-control-label help">Slogan</label>
                  <div class="col-sm-8">
                    <input type="text" name="option[topbar_text][<?=$language->getCode()?>]"  value="<?=get_option_value($this->items, 'topbar_text', $language->getCode())?>" class="form-control item-label">
                  </div>
                </div>

                  <div class="form-group row ">
                    <label class="col-sm-4 form-control-label help" >Store Address</label>
                    <div class="col-sm-8">
                      <input type="text" name="option[store_address][<?=$language->getCode()?>]"  value="<?=get_option_value($this->items, 'store_address', $language->getCode())?>" class="form-control item-label">
                    </div>
                  </div>
                  <div class="form-group row ">
                    <label class="col-sm-4 form-control-label help" >Store Phone</label>
                    <div class="col-sm-8">
                      <input type="text" name="option[store_phone][<?=$language->getCode()?>]"  value="<?=get_option_value($this->items, 'store_phone', $language->getCode())?>" class="form-control item-label">
                    </div>
                  </div>
                  <div class="form-group row ">
                    <label class="col-sm-4 form-control-label help" >Store Email</label>
                    <div class="col-sm-8">
                      <input type="text" name="option[store_email][<?=$language->getCode()?>]"  value="<?=get_option_value($this->items, 'store_email', $language->getCode())?>" class="form-control item-label">
                    </div>
                  </div>
              </div>
            </div>
            <?php }?>
            <?php endif; ?>
          </div>


        </div>
        <div class="col-md-12 home-section">
          <h4>Store Social Links</h4>
          <div class="form-group row ">
            <label class="col-sm-4 form-control-label help" >Facebook</label>
            <div class="col-sm-8">
              <input type="text" name="option[facebook_url]"  value="<?=get_option_value($this->items, 'facebook_url')?>" class="form-control item-label">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-sm-4 form-control-label help" >Twitter</label>
            <div class="col-sm-8">
              <input type="text" name="option[twitter_url]"  value="<?=get_option_value($this->items, 'twitter_url')?>" class="form-control item-label">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-sm-4 form-control-label help" >Youtube</label>
            <div class="col-sm-8">
              <input type="text" name="option[youtube_url]"  value="<?=get_option_value($this->items, 'youtube_url')?>" class="form-control item-label">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-sm-4 form-control-label help" >Instagram</label>
            <div class="col-sm-8">
              <input type="text" name="option[instagram_url]"  value="<?=get_option_value($this->items, 'instagram_url')?>" class="form-control item-label">
            </div>
          </div>
          <h4><?= $enc->html( $this->translate( 'admin', 'Customize' ) ); ?></h4>
          <div class="form-group row ">
            <label class="col-sm-4 form-control-label help" >Javascript</label>
            <div class="col-sm-8">
                <strong>&lt;javascript&gt;</strong>
              <textarea  name="option[js_code]"  class="form-control item-label"><?=get_option_value($this->items, 'js_code')?></textarea>
                <strong>&lt;/javascript&gt;</strong>
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-sm-4 form-control-label help" >Css</label>
            <div class="col-sm-8">
                <strong>&lt;style&gt;</strong>
              <textarea name="option[css_code]" class="form-control item-label"><?=get_option_value($this->items, 'css_code')?></textarea>
                <strong>&lt;/style&gt;</strong>
            </div>
          </div>
        </div>
      </div>
      <div id="header" class="row item-header tab-pane col-md-12" role="tabpanel" aria-labelledby="header">
        <h2>Header</h2>
        <div class="col-md-12 home-section">
          <h4>Header</h4>
          <div class="form-group row">
            <label class="col-sm-4 form-control-label help">Header Type</label>
            <div class="col-sm-8 header-type">
            <label class="text-left">
            <input type="radio" name="option[header_type]" value="standard" <?php if(isset($this->items['header_type'])) echo is_selected($this->items, 'header_type', 'standard')?>> Standard<img style="max-width:100%" src="<?=frigian_url('assets\img\header\final-header.jpg')?>">
            </label>
            <label class="text-left">
           <?php /*  <input type="radio" name="option[header_type]" value="clear" <?php if(isset($this->items['header_type'])) echo is_selected($this->items, 'header_type', 'clear')?>> Clear<img style="max-width:100%" src="<?=frigian_url('assets\img\header\header-clear.png') ?>">*/ ?>
            </label>
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-sm-4 form-control-label help">Show Language Selector</label>
            <div class="col-sm-8">
              <input type="hidden" name="option[show_language_select]"  value="0">
              <input type="checkbox" name="option[show_language_select]"  value="1" <?=is_checked($this->items, 'show_language_select')?> class="item-label">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-sm-4 form-control-label help">Show Currency Selector</label>
            <div class="col-sm-8">
              <input type="hidden" name="option[show_currency_select]"  value="0">
              <input type="checkbox" name="option[show_currency_select]"  value="1" <?=is_checked($this->items, 'show_currency_select')?> class="item-label">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-sm-4 form-control-label help">Show Slider</label>
            <div class="col-sm-8">
              <input type="hidden" name="option[show_slider]"  value="0">
              <input type="checkbox" name="option[show_slider]"  value="1" <?=is_checked($this->items, 'show_slider')?> class="item-label">
              <a class="text-danger" href="/admin/default/jqadm/search/swordbros/slider"> Edit Slider</a> </div>
          </div>
        </div>

      </div>
      <div id="footer" class="row item-header tab-pane col-md-12" role="tabpanel" aria-labelledby="footer">
        <h2>Footer</h2>
        <div class="col-md-12 home-section">
          <h4>Footer</h4>
          <nav>
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
              <?php if( ( $languages = $this->get( 'pageLangItems', map() ) )->count() >0 ) : ?>
              <?php foreach($languages as $language){ ?>
              <a class="nav-item nav-link" id="nav-<?=$language->getCode()?>-tab" data-toggle="tab" href="#nav-<?=$language->getCode()?>" role="tab" aria-controls="nav-<?=$language->getCode()?>" aria-selected="true"><img src="/packages/swordbros/shop/themes/frigian/assets/img/icon/flag/icon_<?=$language->getCode()?>.png" width="24">
              <?=$language->getCode()?>
              </a>
              <?php }?>
              <?php endif; ?>
            </div>
          </nav>
          <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
            <?php if( ( $languages = $this->get( 'pageLangItems', map() ) )->count() >0 ) : ?>
            <?php foreach($languages as $language){?>
            <div class="tab-pane fade show" id="nav-<?=$language->getCode()?>" role="tabpanel" aria-labelledby="nav-<?=$language->getCode()?>-tab">
              <div class="tab-content clearfix">
                <h5>
                  <?=$language->getLabel()?>
                  Content's Tab</h5>
                <div class="form-group row ">
                  <label class="col-sm-4 form-control-label help">Copyright</label>
                  <div class="col-sm-8">
                    <input type="text" name="option[copyright_text][<?=$language->getCode()?>]"  value="<?=get_option_value($this->items, 'copyright_text', $language->getCode())?>" class="form-control item-label">
                  </div>
                </div>
                <div class="form-group row ">
                  <label class="col-sm-4 form-control-label help">Column-1</label>
                  <div class="col-sm-8">
                    <textarea name="option[col_1][<?=$language->getCode()?>]"  class="form-control htmleditor form-control item-content"><?=get_option_value($this->items, 'col_1', $language->getCode())?></textarea>
                  </div>
                </div>
                <div class="form-group row ">
                  <label class="col-sm-4 form-control-label help">Column-2</label>
                  <div class="col-sm-8">
                    <textarea name="option[col_2][<?=$language->getCode()?>]"  class="form-control htmleditor form-control item-content"><?=get_option_value($this->items, 'col_2', $language->getCode())?></textarea>
                  </div>
                </div>
                <div class="form-group row ">
                  <label class="col-sm-4 form-control-label help">Column-3</label>
                  <div class="col-sm-8">
                    <textarea name="option[col_3][<?=$language->getCode()?>]"  class="form-control htmleditor form-control item-content"><?=get_option_value($this->items, 'col_3', $language->getCode())?></textarea>
                  </div>
                </div>
                <div class="form-group row ">
                  <label class="col-sm-4 form-control-label help">Column-4</label>
                  <div class="col-sm-8">
                    <textarea name="option[col_4][<?=$language->getCode()?>]"  class="form-control htmleditor form-control item-content"><?=get_option_value($this->items, 'col_4', $language->getCode())?></textarea>
                  </div>
                </div>
              </div>
            </div>
            <?php }?>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div id="home-page" class="row item-home-page tab-pane col-md-12" role="tabpanel" aria-labelledby="home-page">
        <h2>Home Page</h2>
        <div class="col-md-12 home-section">
          <h4>Body</h4>
          <?php /* <div class="form-group row ">
            <label class="col-sm-4 form-control-label help" >Top Banner Image-1</label>
            <div class="col-sm-8 frigian-img">
              <span class="preview"><img class="image" width="64"> </span>
              <input type='file' name="files[show_top_banner_1]" class="image-file" />
              <input type="hidden" name="option[show_top_banner_1]"  value="<?=get_option_value($this->items, 'show_top_banner_1')?>" class="form-control item-label">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-sm-4 form-control-label help">Top Banner Image-2</label>
            <div class="col-sm-8">
              <input type="text" name="option[show_top_banner_2]"  value="<?=get_option_value($this->items, 'show_top_banner_2')?>" class="form-control item-label">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-sm-4 form-control-label help">Middle Banner Image</label>
            <div class="col-sm-8">
              <input type="text" name="option[show_middle_banner]"  value="<?=get_option_value($this->items, 'show_middle_banner')?>" class="form-control item-label">
            </div>
          </div> */?>
          <div class="form-group row ">
            <label class="col-sm-4 form-control-label help">Show Risk Reducer Banner</label>
            <div class="col-sm-8">
              <input type="hidden" name="option[show_risk_reducer]"  value="0">
              <input type="checkbox" name="option[show_risk_reducer]"  value="1" <?=is_checked($this->items, 'show_risk_reducer')?> class="item-label">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-sm-4 form-control-label help">Show Top Products</label>
            <div class="col-sm-8">
              <input type="hidden" name="option[show_top_products]"  value="0">
              <input type="checkbox" name="option[show_top_products]"  value="1" <?=is_checked($this->items, 'show_top_products')?> class="item-label">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-sm-4 form-control-label help">Show New Products</label>
            <div class="col-sm-8">
              <input type="hidden" name="option[show_new_products]"  value="0">
              <input type="checkbox" name="option[show_new_products]"  value="1" <?=is_checked($this->items, 'show_new_products')?> class="item-label">
            </div>
          </div>
         <?php /*  <div class="form-group row ">
            <label class="col-sm-4 form-control-label help">Show Our Latest News</label>
            <div class="col-sm-8">
              <input type="hidden" name="option[show_latest_news]"  value="0">
              <input type="checkbox" name="option[show_latest_news]"  value="1" <?=is_checked($this->items, 'show_latest_news')?> class="item-label">
            </div>
          </div> 
          <div class="form-group row ">
            <label class="col-sm-4 form-control-label help">Show Our Client Say</label>
            <div class="col-sm-8">
              <input type="hidden" name="option[show_client_says]"  value="0">
              <input type="checkbox" name="option[show_client_says]"  value="1" <?=is_checked($this->items, 'show_client_says')?> class="item-label">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-sm-4 form-control-label help">Show Subscribe Form</label>
            <div class="col-sm-8">
              <input type="hidden" name="option[show_subscribe_form]"  value="0">
              <input type="checkbox" name="option[show_subscribe_form]"  value="1" <?=is_checked($this->items, 'show_subscribe_form')?> class="item-label">
            </div>
          </div> */?> 
          <hr>
            <?php foreach(frigian_catalog_list_types() as $catalog_list_type){ ?>
          <div class="form-group row ">
            <label class="col-sm-4 form-control-label help"><?= $enc->html( $this->translate( 'admin', 'Show '.$catalog_list_type->label.' Products' ) ); ?></label>
            <div class="col-sm-8">
              <input type="hidden" name="option[show_<?=$catalog_list_type->code?>_products]"  value="0">
              <input type="checkbox" name="option[show_<?=$catalog_list_type->code?>_products]"  value="1" <?=is_checked($this->items, 'show_'.$catalog_list_type->code.'_products')?> class="item-label">
            </div>
          </div>
            <?php } ?>
          <div class="form-group row ">
            <label class="col-sm-4 form-control-label help">Show Logo Slider</label>
            <div class="col-sm-8">
              <input type="hidden" name="option[show_logo_slider]"  value="0">
              <input type="checkbox" name="option[show_logo_slider]"  value="1" <?=is_checked($this->items, 'show_logo_slider')?> class="item-label">
            </div>
          </div>
        </div>
      </div>

      <div id="legals" class="row item-legals tab-pane col-md-12" role="tabpanel" aria-labelledby="legals">
        <h2>Legals Page Content</h2>
        <div class="col-md-12 home-section"><br>
          <nav>
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
              <?php if( ( $languages = $this->get( 'pageLangItems', map() ) )->count() >0 ) : ?>
              <?php foreach($languages as $language){ ?>
              <a class="nav-item nav-link" id="nav-legal-<?=$language->getCode()?>-tab" data-toggle="tab" href="#nav-legal-<?=$language->getCode()?>" role="tab" aria-controls="nav-legal-<?=$language->getCode()?>" aria-selected="true"><img src="/packages/swordbros/shop/themes/frigian/assets/img/icon/flag/icon_<?=$language->getCode()?>.png" width="24">
              <?=$language->getCode()?>
              </a>
              <?php }?>
              <?php endif; ?>
            </div>
          </nav>
          <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
            <?php if( ( $languages = $this->get( 'pageLangItems', map() ) )->count() >0 ) : ?>
            <?php foreach($languages as $language){?>
            <div class="tab-pane fade" id="nav-legal-<?=$language->getCode()?>" role="tabpanel" aria-labelledby="nav-legal-<?=$language->getCode()?>-tab">
              <div class="tab-content clearfix">
                <h5>
                  <?=$language->getLabel()?>
                  Legal's Tab</h5>
                <div class="form-group row ">
                  <label class="col-sm-4 form-control-label help">Terms and conditions</label>
                  <div class="col-sm-8">
                    <textarea name="option[terms_conditions][<?=$language->getCode()?>]"  class="form-control htmleditor form-control item-content"><?=get_option_value($this->items, 'terms_conditions', $language->getCode())?></textarea>
                  </div>
                </div>
                <div class="form-group row ">
                  <label class="col-sm-4 form-control-label help">Privacy policy</label>
                  <div class="col-sm-8">
                    <textarea name="option[privacy_policy][<?=$language->getCode()?>]"  class="form-control htmleditor form-control item-content"><?=get_option_value($this->items, 'privacy_policy', $language->getCode())?></textarea>
                  </div>
                </div>
                <div class="form-group row ">
                  <label class="col-sm-4 form-control-label help">Cancellation policy</label>
                  <div class="col-sm-8">
                    <textarea name="option[cancellation_policy][<?=$language->getCode()?>]"  class="form-control htmleditor form-control item-content"><?=get_option_value($this->items, 'cancellation_policy', $language->getCode())?></textarea>
                  </div>
                </div>
              </div>
            </div>
            <?php }?>
            <?php endif; ?>
          </div>
        </div>
      </div>
      
      
      <div id="pages" class="row item-pages tab-pane col-md-12" role="tabpanel" aria-labelledby="pages">
        <h2><?= $enc->html( $this->translate( 'admin', 'Custom Page Content' ) ); ?></h2>
        <div class="col-md-12 home-section"><br>
          <nav>
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
              <?php if( ( $languages = $this->get( 'pageLangItems', map() ) )->count() >0 ) : ?>
              <?php foreach($languages as $language){ ?>
              <a class="nav-item nav-link" id="nav-page-<?=$language->getCode()?>-tab" data-toggle="tab" href="#nav-page-<?=$language->getCode()?>" role="tab" aria-controls="nav-page-<?=$language->getCode()?>" aria-selected="true"><img src="/packages/swordbros/shop/themes/frigian/assets/img/icon/flag/icon_<?=$language->getCode()?>.png" width="24">
              <?=$language->getCode()?>
              </a>
              <?php }?>
              <?php endif; ?>
            </div>
          </nav>
          <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
            <?php if( ( $languages = $this->get( 'pageLangItems', map() ) )->count() >0 ) : ?>
            <?php foreach($languages as $language){?>
            <div class="tab-pane fade" id="nav-page-<?=$language->getCode()?>" role="tabpanel" aria-labelledby="nav-page-<?=$language->getCode()?>-tab">
              <div class="tab-content clearfix">
                <h5>
                  <?=$language->getLabel()?>
                  <?= $enc->html( $this->translate( 'admin', 'Page\'s Tab' ) ); ?></h5>
                <div class="form-group row ">
                  <label class="col-sm-4 form-control-label help"><?= $enc->html( $this->translate( 'admin', 'About Us' ) ); ?></label>
                  <div class="col-sm-8">
                    <textarea name="option[page_aboutus][<?=$language->getCode()?>]"  class="form-control htmleditor form-control item-content"><?=get_option_value($this->items, 'page_aboutus', $language->getCode())?></textarea>
                  </div>
                </div>
                <div class="form-group row ">
                  <label class="col-sm-4 form-control-label help"><?= $enc->html( $this->translate( 'admin', 'Contact Us' ) ); ?></label>
                  <div class="col-sm-8">
                    <textarea name="option[page_contactus][<?=$language->getCode()?>]"  class="form-control htmleditor form-control item-content"><?=get_option_value($this->items, 'page_contactus', $language->getCode())?></textarea>
                  </div>
                </div>
                <div class="form-group row ">
                  <label class="col-sm-4 form-control-label help"><?= $enc->html( $this->translate( 'admin', 'Halal' ) ); ?></label>
                  <div class="col-sm-8">
                    <textarea name="option[page_halal][<?=$language->getCode()?>]"  class="form-control htmleditor form-control item-content"><?=get_option_value($this->items, 'page_halal', $language->getCode())?></textarea>
                  </div>
                </div>
                <div class="form-group row ">
                  <label class="col-sm-4 form-control-label help"><?= $enc->html( $this->translate( 'admin', 'News' ) ); ?></label>
                  <div class="col-sm-8">
                    <textarea name="option[page_news][<?=$language->getCode()?>]"  class="form-control htmleditor form-control item-content"><?=get_option_value($this->items, 'page_news', $language->getCode())?></textarea>
                  </div>
                </div>
                <div class="form-group row ">
                  <label class="col-sm-4 form-control-label help"><?= $enc->html( $this->translate( 'admin', 'Help' ) ); ?></label>
                  <div class="col-sm-8">
                    <textarea name="option[page_help][<?=$language->getCode()?>]"  class="form-control htmleditor form-control item-content"><?=get_option_value($this->items, 'page_help', $language->getCode())?></textarea>
                  </div>
                </div>
                <div class="form-group row ">
                  <label class="col-sm-4 form-control-label help"><?= $enc->html( $this->translate( 'admin', 'Support' ) ); ?></label>
                  <div class="col-sm-8">
                    <textarea name="option[page_support][<?=$language->getCode()?>]"  class="form-control htmleditor form-control item-content"><?=get_option_value($this->items, 'page_support', $language->getCode())?></textarea>
                  </div>
                </div>
              </div>
            </div>
            <?php }?>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div id="help" class="row item-help tab-pane col-md-12" role="tabpanel" aria-labelledby="help">
        <h2>Support</h2>
      </div>
    </div>
  </div>
</form>
<style>
	.home-section{
		border: 1px solid #e5e5e5;
		box-shadow: 0;
		transition: box-shadow .5s;
		margin-bottom: 15px;
	}
	.home-section:hover {
		box-shadow: 0 0 3px #00ffff;
	}
	.home-section h4{
		color: #a0a0a0
	}
	.nav-tabs .nav-item {
		min-width: auto;
	}
</style>
<?php $this->block()->stop(); ?>
<?= $this->render( $this->config( 'admin/jqadm/template/page', 'common/page-standard' ) ); ?>
