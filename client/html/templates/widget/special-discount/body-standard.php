<?php
$enc = $this->encoder();
?>
         <!-- ::::::  Start banner Section  ::::::  -->
         <div class="banner m-t-100 pos-relative">
            <div class="banner__bg">
                <img src="<?=frigian_url('assets/img/banner/special-discount.jpg') ?>" alt="">
            </div>
            <div class="banner__box banner__box--single-text-style-2">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="banner__content banner__content--center pos-absolute">
                                <h6 class="banner__title  font--medium m-b-10"><?= $this->translate( 'client', 'SPECIAL DISCOUNTs' ); ?></h6>
                                <h1 class="banner__title banner__title--large font--regular text-capitalize"><?= $this->translate( 'client', 'For all Grocery' ); ?> <br>
                                    products</h1>
                                <h6 class="banner__title font--medium m-b-40"><?= $this->translate( 'client', 'Take now 20% off for all grocer product.' ); ?></h6>
                                <a href="product-single-default.html" class="btn btn--large btn--radius btn--black btn--black-hover-green font--bold text-uppercase"><?= $this->translate( 'client', 'Shop now' ); ?></a>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>    
        </div> 
		<!-- ::::::  End banner Section  ::::::  -->

