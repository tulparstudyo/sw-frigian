<?php
$nav = $this->get( 'nav', [] );
$enc = $this->encoder();
$target = $this->config( 'client/html/catalog/tree/url/target' );

$controller = $this->config( 'client/html/catalog/tree/url/controller', 'catalog' );

$action = $this->config( 'client/html/catalog/tree/url/action', 'list' );

$config = $this->config( 'client/html/catalog/tree/url/config', [] );

?>
<ul class="menu-contents pos-absolutes">
  <?php
  if ( $nav[ 'categories' ] ) {

      foreach ( $nav[ 'categories' ]->getChildren() as $item ) {
    
        if ( $item->getStatus() > 0 ) { ?>
			  <li class="menu-item"><a href="<?= $this->url( $item->getTarget() ?: $this->config( 'client/html/catalog/tree/url/target' ), 'catalog', 'list', array_merge( $this->get( 'params', [] ), ['f_name' => $item->getName( 'url' ), 'f_catid' => $item->getId()] ), [], [] ) ; ?>">
				<?=$item->getName()?>	</a> 
        <?php  if($item->hasChildren()){ ?>
          <i class="fal fa-chevron-down" ></i>
          <ul class="dropdown frigian-dropdown sub-menu">
                             
            <?php foreach($item->getChildren() as $itemnode ){?>
              <li>          
                <a href="<?= $enc->attr( $this->url( $itemnode ->getTarget() ?: $target, $controller, $action, array_merge( $this->get( 'params', [] ), ['f_name' => $itemnode ->getName( 'url' ), 'f_catid' => $itemnode ->getId()] ), [], $config ) ); ?>">
                <?=$itemnode->getName();?></a> 
            <?php } ?>
                
         </ul>     
        <?php } ?>
        </li>
		  <?php
		  }
	  }
  }
  ?>



</ul> 
<ul class="mobile-category" style="display:none">
  <?php
  if ( $nav[ 'categories' ] ) {
      foreach ($nav[ 'categories' ]->getChildren() as $item ) {
          if ( $item->getStatus() > 0 ) { ?>
			  <li>
        <a href="<?= $this->url( $item->getTarget() ?: $this->config( 'client/html/catalog/tree/url/target' ), 'catalog', 'list', array_merge( $this->get( 'params', [] ), ['f_name' => $item->getName( 'url' ), 'f_catid' => $item->getId()] ), [], [] ) ; ?>">
				<?=$item->getName()?>	</a> 
        <?php  if($item->hasChildren()){ ?>
          <ul class="sub-menu">
                             
            <?php foreach($item->getChildren() as $itemnode ){?>
              <li>          
                <a href="<?= $enc->attr( $this->url( $itemnode ->getTarget() ?: $target, $controller, $action, array_merge( $this->get( 'params', [] ), ['f_name' => $itemnode ->getName( 'url' ), 'f_catid' => $itemnode ->getId()] ), [], $config ) ); ?>">
                <?=$itemnode->getName();?></a> 
            <?php } ?>
                
         </ul>     
        <?php } ?>
        </li>
		  <?php
		  }
	  }
  }
  ?>
</ul> 
<?php if( isset( $this->categories ) ) :?>
    <ul class="menuzord-menu dark">
        <?php 
        if($this->categories->hasChildren()){ ?>
            <?php foreach(  $this->categories->getChildren() as $topcategory  ){ ?>
                <li><a href="<?= $enc->attr( $this->url( $topcategory->getTarget() ?: $target, $cntl, $action, array_merge( $this->get( 'params', [] ), $params, ['f_name' => $topcategory->getName( 'url' ), 'f_catid' => $topcategory->getId()] ), [], $config ) ); ?>"><?=$topcategory->getName()?><i class="ion-chevron-down"></i></a>
                    <ul class="dropdown kenne-dropdown">
                    <?php  if($topcategory->hasChildren()){ ?>
                        <?php foreach(  $topcategory->getChildren() as $item  ){?>
                              <li><a href="<?= $enc->attr( $this->url( $item->getTarget() ?: $target, $cntl, $action, array_merge( $this->get( 'params', [] ), $params, ['f_name' => $item->getName( 'url' ), 'f_catid' => $item->getId()] ), [], $config ) ); ?>"><?=$item->getName();?></a> 
                        <?php } ?>
                     <?php } ?>
                    </ul>
               <li>
            <?php }  ?>
        <?php }  ?>
    </ul>
<?php endif; ?>