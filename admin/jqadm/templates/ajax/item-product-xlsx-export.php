<?php
$Xlsx = new \Aimeos\Controller\Jobs\Product\Export\Xlsx\Standard($this->get('context'), $this->get('aimeos'));
$files = $Xlsx->run();
if($files){
   $file_path = $files[0];
    header('Content-Type: application/download');
    header("Content-Disposition: attachment; filename=".$Xlsx->getXlsxFilename(1)); 
    header("Pragma: no-cache"); 
    header("Expires: 0"); 
    readfile($file_path);
    die();
}
