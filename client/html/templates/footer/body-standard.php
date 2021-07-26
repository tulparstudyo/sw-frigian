    <!-- ::::::  Start  Footer ::::::  -->
    <footer class="footer m-t-100"> <span style="display: none">Git Test direct update</span>
        <div class="container">
            <!-- Start Footer Top Section -->
            <div class="footer__top">
                <div class="row">
                    <div class="col-lg-5 col-md-5">
                        <div class="footer__about">
                            <div class="footer__logo">
                                <a href="index.html" class="footer__logo-link">
                                    <img src="<?=frigian_url('assets/img/iconekol/logo_0.png')?>" alt="" class="footer__logo-img">
                                </a>
                            </div>
                            <ul class="footer__address">
                                <li class="footer__address-item"><i class="fa fa-home"></i>
                                <?php echo frigian_option('store_address')?></li>
                                <li class="footer__address-item"><i class="fa fa-phone-alt"></i>
                                <?php echo frigian_option('store_phone')?></li>
                                <li class="footer__address-item"><i class="fa fa-envelope"></i>
                                <?php echo frigian_option('store_email')?></li>
                            </ul>
                            <ul class="footer__social-nav">
                                <li class="footer__social-list"><a href=" <?php echo frigian_option('facebook_url')?>" class="footer__social-link"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="footer__social-list"><a href="<?php echo frigian_option('twitter_url')?>" class="footer__social-link"><i class="fab fa-twitter"></i></a></li>
                                <li class="footer__social-list"><a href="<?php echo frigian_option('youtube_url')?>" class="footer__social-link"><i class="fab fa-youtube"></i></a></li>
                                <li class="footer__social-list"><a href="<?php echo frigian_option('instagram_url')?>" class="footer__social-link"><i class="fab fa-instagram-square"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12">
                        <!-- Start Footer Nav -->
                        <div class="footer__menu">
                        <?php echo frigian_option('col_1')?>
                             <!-- <h4 class="footer__nav-title footer__nav-title--dash footer__nav-title--dash-red">INFORMATION</h4>
                            <ul class="footer__nav">
                                <li class="footer__list"><a href="" class="footer__link">Delivery Information</a></li>
                                <li class="footer__list"><a href="" class="footer__link">Advanced Search</a></li>
                                <li class="footer__list"><a href="" class="footer__link">Helps & Faqs</a></li>
                                <li class="footer__list"><a href="" class="footer__link">Store Location</a></li>
                                <li class="footer__list"><a href="" class="footer__link">Orders & Returns</a></li>
                                <li class="footer__list"><a href="" class="footer__link">Deliveries</a></li>
                                <li class="footer__list"><a href="" class="footer__link"> Refund & Returns</a></li>
                            </ul>-->
                        </div> <!-- End Footer Nav -->
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12">
                        <div class="footer__menu">
                        <?php echo frigian_option('col_2')?>

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                        <div class="footer__menu">
                        <?php echo frigian_option('col_3')?>

                        </div>
                    </div>
                    <!-- <div class="col-lg-2 col-md-3 col-sm-6 col-12">
                        <div class="footer__menu">
                        <?php echo frigian_option('col_4')?>

                        </div>
                    </div> -->
                </div>
            </div> <!-- End Footer Top Section -->
            <!-- Start Footer Bottom Section -->
            <div class="footer__bottom">
                <div class="row">
                    <div class="col-lg-8 col-md-6 col-12">
                        <!-- Start Footer Copyright Text -->
                        <div class="footer__copyright-text">
                            <p><?= $this->translate('client','Copyright © 2021 EkolMarket All Rights Reserved. Develop by');?><a href="https://www.swordbros.com"> SWORD BROS.</a></p>
                        </div> <!-- End Footer Copyright Text -->
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                         <!-- Start Footer Payment Logo -->
                        <div class="footer__payment">
                            <a href="#" class="footer__payment-link">
                            </a>
                        </div>  <!-- End Footer Payment Logo -->
                    </div>
                </div>
            </div> <!-- End Footer Bottom Section -->
        </div>
    </footer> <!-- ::::::  End  Footer ::::::  -->
<!-- material-scrolltop button -->
<button class="material-scrolltop" type="button"></button>

<!-- Start Modal Add cart -->
<div class="modal fade" id="modalAddCart" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col text-right">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true"> <i class="fal fa-times"></i></span> </button>
            </div>
          </div>
          <div class="row">
            <div class="col-md-7">
              <div class="row">
                <div class="col-md-4">
                  <div class="modal__product-img"> <img class="img-fluid" src="<?=frigian_url('assets/img/product/size-normal/product-home-1-img-1.jpg')?>" alt=""> </div>
                </div>
                <div class="col-md-8">
                  <div class="link--green link--icon-left"><i class="fal fa-check-square"></i>Added to cart successfully!</div>
                  <div class="modal__product-cart-buttons m-tb-15"> <a href="cart.html" class="btn btn--box  btn--tiny btn--green btn--green-hover-black btn--uppercase">View Cart</a> <a href="checkout.html" class="btn btn--box  btn--tiny btn--green btn--green-hover-black btn--uppercaset">Checkout</a> </div>
                </div>
              </div>
            </div>
            <div class="col-md-5 modal__border">
              <ul class="modal__product-shipping-info">
                <li class="link--icon-left"><i class="icon-shopping-cart"></i> There Are 5 Items In Your Cart.</li>
                <li>TOTAL PRICE: <span>$187.00</span></li>
                <li><a href="#" class="btn text-underline color-green" data-dismiss="modal">CONTINUE SHOPPING</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Add cart -->

<!-- Start Modal Quickview cart -->
<div class="modal fade" id="modalQuickView" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col text-right">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true"> <i class="fal fa-times"></i></span> </button>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="product-gallery-box m-b-60">
                <div class="modal-product-image--large"> <img class="img-fluid" src="<?=frigian_url('assets/img/product/gallery/gallery-large/product-gallery-large-1.jpg')?>" alt=""> </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="product-details-box">
                <h5 class="title title--normal m-b-20">Aliquam lobortis</h5>
                <div class="product__price"> <span class="product__price-del">$35.90</span> <span class="product__price-reg">$31.69</span> </div>
                <ul class="product__review m-t-15">
                  <li class="product__review--fill"><i class="icon-star"></i></li>
                  <li class="product__review--fill"><i class="icon-star"></i></li>
                  <li class="product__review--fill"><i class="icon-star"></i></li>
                  <li class="product__review--fill"><i class="icon-star"></i></li>
                  <li class="product__review--blank"><i class="icon-star"></i></li>
                </ul>
                <div class="product__desc m-t-25 m-b-30">
                  <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will</p>
                </div>
                <div class="product-var p-t-30">
                  <div class="product-quantity product-var__item d-flex align-items-center flex-wrap"> <span class="product-var__text">Quantity: </span>
                    <form class="modal-quantity-scale m-l-20">
                      <div class="value-button" id="modal-decrease" onclick="decreaseValueModal()">-</div>
                      <input type="number" id="modal-number" value="1" />
                      <div class="value-button" id="modal-increase" onclick="increaseValueModal()">+</div>
                    </form>
                  </div>
                </div>
                <div class="product-links">
                  <div class="product-social m-tb-30"> <span>SHARE THIS PRODUCT</span>
                    <ul class="product-social-link">
                      <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                      <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                      <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    <?php if (frigian_option('js_code')) { ?>
    <script>
        <?php echo frigian_option('js_code')?>
    </script>
    <?php } ?>
<!-- End Modal Quickview cart -->
