<?php
$enc = $this->encoder();
$data = \Aimeos\Shop\Facades\Shop::get('swordbros/slider')->addData($this);
$i=0;
?>
<!-- ::::::  Start Hero Section  ::::::  -->

<!-- ::::::  End Hero Section  ::::::  -->

<?php if(isset($data->items) && !empty($data->items)):?>
<style>
.carousel-item .slide-content {
    bottom: 59px;
    position: absolute;
    padding: 10px;
    background: rgba(255,255,255, .7);
    width: 50%;
    text-align: center;
    right: 20px;
}
</style>

<div class="main_banner" >
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
     <?php foreach($data->items as $key=>$item){?>
      <div class="carousel-item <?php if($key == 0) echo 'active';?>">
          <div class="hero__content">
              <div class="container">
                  <div class="row">
                      <div class="col-12 col-lg-8">
                          <div class="hero__content--inner">
                              <?php if($item['content']){ ?>
                              <h4 class="title__hero title__hero--small font--regular"><?=$item['content']?></h4>
                              <?php } ?>
                              <a href="/<?=$item['url']?>" class="btn btn--large btn--radius btn--black btn--black-hover-green font--bold text-uppercase"><?= $this->translate( 'client', $item['button_text']); ?></a> </div>
                      </div>
                  </div>
              </div>
          </div>
        <img class="d-block w-100" src="<?=$item['image_url']?>" alt="<?=$item['image_url']?>">

      </div>
      <?php } ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>

</div>
<script type="text/javascript">
      $(document).ready(function(){
          $('.carousel').carousel();
      });
  </script>
</div>

<!-- Slider Image Not Found -->

      <?php endif; ?>

