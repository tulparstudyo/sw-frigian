<?php
$enc = $this->encoder();
$blogs = [[],[],[],[],[],[],[],[]];
?>
<!-- ::::::  Start  Blog News  ::::::  -->
<div class="blog m-t-100">
  <div class="container">
    <div class="row">
      <div class="col-12"> 
        <!-- Start Section Title -->
        <div class="section-content section-content--border m-b-35">
          <h5 class="section-content__title"><?= $this->translate( 'client', 'Our Latest News' ); ?></h5>
          <a href="blog-list-sidebar-left.html" class="btn btn--icon-left btn--small btn--radius btn--transparent btn--border-green btn--border-green-hover-green font--regular text-capitalize"><?= $this->translate( 'client', 'More blogs' ); ?> <i class="fal fa-angle-right"></i></a> </div>
        <!-- End Section Title --> 
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="default-slider default-slider--hover-bg-red">
          <div class="blog-feed-slider-3grid default-slider gap__col--30 "> 
<?php foreach($blogs  as $blog ){ 
		echo $this->partial( $this->config( 'client/html/common/partials/blog', 'common/partials/blog-standard' ),
			array(
				'blog' => $blog,
			)
		);			  

}?>           
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ::::::  End  Blog News   ::::::  --> 

