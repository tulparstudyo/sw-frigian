<?php
$enc = $this->encoder();
?>
<!-- ::::::  Start Testimonial Section  ::::::  -->
<div class="testimonial m-t-100 pos-relative">
  <div class="testimonial__bg"> <img src="<?=frigian_url('assets/img/testimonial/testimonials-bg.jpg') ?>" alt=""> </div>
  <div class="testimonial__content pos-absolute absolute-center text-center">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="section-content__inner">
            <h2><?= $this->translate( 'client', 'Our Client Say!' ); ?></h2>
          </div>
          <div class="testimonial__slider default-slider">
            <div class="testimonial__content--slider ">
              <div class="testimonial__single">
                <p class="testimonial__desc"><?= $this->translate( 'client', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.' ); ?></p>
                <div class="testimonial__info"> <img class="testimonial__info--user" src="<?=frigian_url('assets/img/testimonial/testimonial-home-1-img-1.png') ?>" alt="">
                  <h5 class="testimonial__info--desig m-t-20">Nirob Khan / <span>CEO</span> </h5>
                </div>
              </div>
            </div>
            <div class="testimonial__content--slider ">
              <div class="testimonial__single">
                <p class="testimonial__desc"><?= $this->translate( 'client', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.' ); ?></p>
                <div class="testimonial__info"> <img class="testimonial__info--user" src="<?=frigian_url('assets/img/testimonial/testimonial-home-1-img-2.png') ?>" alt="">
                  <h5 class="testimonial__info--desig m-t-20">Torvi / <span>C0O</span> </h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ::::::  End Testimonial Section  ::::::  --> 
