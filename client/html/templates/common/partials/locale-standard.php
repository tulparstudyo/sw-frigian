<?php
$enc = $this->encoder();
$config = $this->config( 'client/jsonapi/url/config', [] );
$url_parameters = request()->route()->parameters()
?>
<div class="locale-select">
<ul class=" select-menu header__top-content--right user-set-role d-flex">
<?php if(frigian_option('show_language_select')){?>
	<li class="select-dropdown user-currency pos-relative"> <a class="user-set-role__button" href="#" data-toggle="dropdown" aria-expanded="false"><img src="<?=frigian_url('assets/img/icon/flag/icon_'.$this->get( 'selectLanguageId', 'en' ).'.png')?>" alt="">
    <i class="fal fa-chevron-down"></i></a>
    <ul class="expand-dropdown-menu dropdown-menu locale-select-language" >
      <?php foreach( $this->get( 'selectMap', [] ) as $lang => $list ) : ?>
      <li class="<?= ( $lang === $this->get( 'selectLanguageId', 'en' ) ? 'active' : '' ); ?>"> <a href="<?= $enc->attr( $this->url( $this->request()->getTarget(), $this->param( 'controller' ), $this->param( 'action' ), array_merge( $this->get( 'selectParams', [] ), $list[$this->get( 'selectCurrencyId', 'EUR' )] ?? current( $list ), $url_parameters ), [], $config ) ); ?>"> <img src="<?=frigian_url('assets/img/icon/flag/icon_'.$lang.'.png')?>" alt="">
        <?= $enc->html( $this->translate( 'language', $lang ), $enc::TRUST ); ?>
        </a> </li>
      <?php endforeach; ?>
    </ul>
  </li>
    <?php	} ?>
    <?php if(frigian_option('show_currency_select')){?>  
  <li class=" select-dropdown  user-info pos-relative"> <a class="user-set-role__button" href="#" data-toggle="dropdown" aria-expanded="false" >
    <?= $this->translate( 'currency', $this->get( 'selectCurrencyId', 'EUR' ) ); ?>
    

    <i class="fal fa-chevron-down"></i></a>
    <ul class="expand-dropdown-menu dropdown-menu locale-select-currency" >
      <?php foreach( $this->get( 'selectMap', map() )->get( $this->get( 'selectLanguageId', 'en' ), [] ) as $currency => $locParam ) : ?>
      <li class="select-item <?= ( $currency === $this->get( 'selectCurrencyId', 'EUR' ) ? 'active' : '' ); ?>"> <a href="<?= $enc->attr( $this->url( $this->request()->getTarget(), $this->param( 'controller' ), $this->param( 'action' ), array_merge( $this->get( 'selectParams', [] ), $locParam, $url_parameters ), [], $config ) ); ?>">
        <?= $this->translate( 'currency', $currency ); ?>
        </a> </li>
      <?php endforeach; ?>
    </ul>
  </li>
  <?php	} ?>
</ul>
</div>
