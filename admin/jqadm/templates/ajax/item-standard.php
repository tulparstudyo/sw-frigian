<?php 
$html = '';
if($this->param( 'id' )=='admin-bar'){
	frigian_admin_bar($this);
} elseif($this->param( 'id' )=='main-navbar-log') {
    $link = "<a href='/admin/default/jqadm/get/swordbros/frigian/clear-log'><i class='log-clear fa fa-trash'></i></a>";
    $html = '<ul class="sw-navitems">'.$link.'</ul>';
} elseif($this->param( 'id' )=='main-navbar-product') {
    $link = "<li><a href='/admin/default/jqadm/get/swordbros/frigian/clear-log'><i class='log-clear fa fa-upload'></i></a></li>";
    $link .= "<li><a href='/admin/default/jqadm/get/swordbros/frigian/clear-log'><i class='log-clear fa fa-download'></i></a></li>";
    $html = '<ul class="sw-navitems">'.$link.'</ul>';
} elseif($this->param( 'id' )=='clear-log'){
    DB::delete('DELETE FROM madmin_log');
}
die($html);
