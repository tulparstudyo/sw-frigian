<?php
$link = '<li><form method="post" id="export-product" action="/admin/default/jqadm/save/swordbros/frigian?sw-ajax=1&form=update-excel-file" enctype="multipart/form-data"><label for="excel-file"><i class="log-clear fa fa-upload"></i><input type="file" name="excel" id="excel-file" style="display:none"></label>'.$this->csrf()->formfield().'</form></li>';
$link .= "<li><a href='/admin/default/jqadm/get/swordbros/frigian/product-xlsx-export'><i class='log-clear fa fa-download'></i></a></li>";
$html = '<ul class="sw-navitems">'.$link.'</ul>';
die($html);
