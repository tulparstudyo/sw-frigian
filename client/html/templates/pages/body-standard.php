<?php
$enc = $this->encoder();
?>

<div class="container">
<div class="info-title">
<h1  style="    font-size: 26px;
    line-height: 36px;
    font-weight: bold;
    text-align: center;"><?= $enc->attr( $this->label ); ?></h1></div>

<div class="info-body"  style="    line-height: 18px;
    border: 1px solid #e6e6e6;
    padding: 15px;
    background-color: white;
    box-shadow: 0px 5px 7px rgb(0 0 0 / 10%);
    margin-bottom: 5px;">

<?php $text = $enc->attr( $this->content );
$edit_text = str_replace("&quot;",'"', $text);
echo($edit_text); ?></div>
</div>



