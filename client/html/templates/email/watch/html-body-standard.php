<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2019-2020
 */

$enc = $this->encoder();

$detailTarget = $this->config( 'client/html/catalog/detail/url/target' );
$detailController = $this->config( 'client/html/catalog/detail/url/controller', 'catalog' );
$detailAction = $this->config( 'client/html/catalog/detail/url/action', 'detail' );
$detailConfig = $this->config( 'client/html/catalog/detail/url/config', ['absoluteUri' => 1] );

$pricefmt = $this->translate( 'client/code', 'price:default' );
/// Price format with price value (%1$s) and currency (%2$s)
$priceFormat = $pricefmt !== 'price:default' ? $pricefmt : $this->translate( 'client', '%1$s %2$s' );

?>
<?php $this->block()->start( 'email/watch/html' ); ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <!--[if gte mso 9]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="format-detection" content="date=no" />
    <meta name="format-detection" content="address=no" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="x-apple-disable-message-reformatting" />
    <!--[if !mso]><!-->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&display=swap" rel="stylesheet" />
    <!--<![endif]-->
    <title>Email Template</title>
    <!--[if gte mso 9]>
    <style type="text/css" media="all"> 
        sup { font-size: 100% !important; }
    </style>
    <![endif]-->
    <!-- body, html, table, thead, tbody, tr, td, div, a, span { font-family: Arial, sans-serif !important; } -->


    <style type="text/css" media="screen">
        body { padding:0 !important; margin:0 auto !important; display:block !important; min-width:100% !important; width:100% !important; background:#f4ecfa; -webkit-text-size-adjust:none }
        a { color:#000000; text-decoration:none }
        p { padding:0 !important; margin:0 !important }
        img { margin: 0 !important; -ms-interpolation-mode: bicubic; /* Allow smoother rendering of resized image in Internet Explorer */ }

        a[x-apple-data-detectors] { color: inherit !important; text-decoration: inherit !important; font-size: inherit !important; font-family: inherit !important; font-weight: inherit !important; line-height: inherit !important; }

        .btn-16 a { display: block; padding: 15px 35px; text-decoration: none; }
        .btn-20 a { display: block; padding: 15px 35px; text-decoration: none; }

        .l-white a { color: #ffffff; }
        .l-black a { color: #282828; }
        .l-pink a { color: #000000; }
        .l-grey a { color: #6e6e6e; }
        .l-purple a { color: #9128df; }

        .gradient { background: linear-gradient(to right, #037e34 0%,#037e34 100%); }

        .btn-secondary { border-radius: 10px; background: linear-gradient(to right, #037e34 0%,#037e34 100%); }


        /* Mobile styles */
        @media only screen and (max-device-width: 480px), only screen and (max-width: 480px) {
            .mpx-10 { padding-left: 10px !important; padding-right: 10px !important; }

            .mpx-15 { padding-left: 15px !important; padding-right: 15px !important; }

            .mpb-15 { padding-bottom: 15px !important; }

            u + .body .gwfw { width:100% !important; width:100vw !important; }

            .td,
            .m-shell { width: 100% !important; min-width: 100% !important; }

            .mt-left { text-align: left !important; }
            .mt-center { text-align: center !important; }
            .mt-right { text-align: right !important; }

            .me-left { margin-right: auto !important; }
            .me-center { margin: 0 auto !important; }
            .me-right { margin-left: auto !important; }

            .mh-auto { height: auto !important; }
            .mw-auto { width: auto !important; }

            .fluid-img img { width: 100% !important; max-width: 100% !important; height: auto !important; }

            .column,
            .column-top,
            .column-dir-top { float: left !important; width: 100% !important; display: block !important; }

            .m-hide { display: none !important; width: 0 !important; height: 0 !important; font-size: 0 !important; line-height: 0 !important; min-height: 0 !important; }
            .m-block { display: block !important; }

            .mw-15 { width: 15px !important; }

            .mw-2p { width: 2% !important; }
            .mw-32p { width: 32% !important; }
            .mw-49p { width: 49% !important; }
            .mw-50p { width: 50% !important; }
            .mw-100p { width: 100% !important; }

            .mmt-0 { margin-top: 0 !important; }
        }

    </style>
</head>
<body class="body" style="padding:0 !important; margin:0 auto !important; display:block !important; min-width:100% !important; width:100% !important; background:#f4ecfa; -webkit-text-size-adjust:none;">
<center>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin: 0; padding: 0; width: 100%; height: 100%;" bgcolor="#f4ecfa" class="gwfw">
        <tr>
            <td style="margin: 0; padding: 0; width: 100%; height: 100%;" align="center" valign="top">
                <table width="600" border="0" cellspacing="0" cellpadding="0" class="m-shell">
                    <tr>
                        <td class="td" style="width:600px; min-width:600px; font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td class="mpx-10">
                                        <!-- Top -->
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td class="text-12 c-grey l-grey a-right py-20" style="font-size:12px; line-height:16px; font-family:'PT Sans', Arial, sans-serif; min-width:auto !important; color:#6e6e6e; text-align:right; padding-top: 20px; padding-bottom: 20px;">
                                                    <a href="#" target="_blank" class="link c-grey" style="text-decoration:none; color:#6e6e6e;"><span class="link c-grey" style="text-decoration:none; color:#6e6e6e;">View this email in your browser</span></a>
                                                </td>
                                            </tr>
                                        </table>											<!-- END Top -->

                                        <!-- Container -->
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td class="gradient pt-10" style="border-radius: 10px 10px 0 0; padding-top: 10px;" bgcolor="#037e34">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td style="border-radius: 10px 10px 0 0;" bgcolor="#ffffff">
                                                                <!-- Logo -->
                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                    <tr>
                                                                        <td class="img-center p-30 px-15" style="font-size:0pt; line-height:0pt; text-align:center; padding: 30px; padding-left: 15px; padding-right: 15px;">
                                                                            <a href="#" target="_blank">
                                                                                <img src="<?=url()->current();?>/packages/swordbros/shop/themes/frigian/assets/img/iconekol/logo_0.png" alt="Header Logo" style="max-width: 200px; vertical-align: middle">
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <!-- Logo -->

                                                                <!-- Main -->
                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                    <tr>
                                                                        <td class="px-50 mpx-15" style="padding-left: 50px; padding-right: 50px;">
                                                                            <!-- Section - Intro -->
                                                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                <tr>
                                                                                    <td class="pb-50" style="padding-bottom: 50px;">
                                                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                           
                                                                                            <tr>
                                                                                                <td class="title-36 a-center pb-15" style="font-size:36px; line-height:40px; color:#282828; font-family:'PT Sans', Arial, sans-serif; min-width:auto !important; text-align:center; padding-bottom: 15px;">
                                                                                                    <strong> <?= $enc->html( $this->get( 'emailIntro' ) ); ?></strong>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="text-16 lh-26 a-center" style="font-size:16px; color:#6e6e6e; font-family:'PT Sans', Arial, sans-serif; min-width:auto !important; line-height: 26px; text-align:center;">
                                                                                                    <?= $enc->html( nl2br( $this->translate( 'client', 'One or more products you are watching have been updated.' ) ), $enc::TRUST ); ?>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                            <!-- END Section - Intro -->

                                                                            <!-- Section - Order Details -->
                                                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                <tr>
                                                                                    <td class="pb-50" style="padding-bottom: 50px;">
                                                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">


                                                                                            <tr>
                                                                                                <td class="pb-40" style="padding-bottom: 40px;">
                                                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                                        <?= $enc->html( $this->translate( 'client', 'Details' ), $enc::TRUST ); ?>
                                                                                                        <tr>
                                                                                                            <td class="img" height="1" bgcolor="#ebebeb" style="font-size:0pt; line-height:0pt; text-align:left;">&nbsp;</td>
                                                                                                        </tr>
                                                                                                    </table>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <?php foreach( $this->extProducts as $entry ) : $product = $entry['item']; ?>
                                                                                            <tr>
                                                                                                <td class="pb-30" style="padding-bottom: 30px;">
                                                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                                        <tr>
                                                                                                            <th class="column-top" valign="top" width="230" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;">
                                                                                                                <div class="fluid-img" style="font-size:0pt; line-height:0pt; text-align:center;">
                                                                                                                    <a href="#" target="_blank">
                                                                                                                        <?php $media = $product->getRefItems( 'media', 'default', 'default' ); ?>
                                                                                                                        <?php if( ( $image = $media->first() ) !== null && ( $url = $image->getPreview() ) != '' ) : ?>
                                                                                                                        <img class="product-image" src="<?= $enc->attr( $this->content( $url ) ); ?>" height="150">
                                                                                                                        <?php endif; ?>                                                                                                                    </a>
                                                                                                                </div>
                                                                                                            </th>
                                                                                                            <th class="column-top mpb-15" valign="top" width="30" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;"></th>
                                                                                                            <th class="column-top" valign="top" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;">
                                                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                                                    <tr>
                                                                                                                        <td class="title-20 pb-10" style="font-size:20px; line-height:24px; color:#282828; font-family:'PT Sans', Arial, sans-serif; text-align:left; min-width:auto !important; padding-bottom: 10px;">
                                                                                                                            <strong> <?php $params = array_merge( $this->param(), ['currency' => $entry['currency'], 'd_name' => $product->getName(), 'd_prodid' => $product->getId(), 'd_pos' => ''] ); ?>
                                                                                                                                <a class="product-name" href="<?= $enc->attr( $this->url( ( $product->getTarget() ?: $detailTarget ), $detailController, $detailAction, $params, [], $detailConfig ) ); ?>">
                                                                                                                                    <?= $enc->html( $product->getName(), $enc::TRUST ); ?>
                                                                                                                                </a>
                                                                                                                            </strong>
                                                                                                                        </td>
                                                                                                                    </tr>

                                                                                                                    <tr>
                                                                                                                        <td class="text-16 lh-26 c-black" style="font-size:18px; font-family:'PT Sans', Arial, sans-serif; text-align:left; min-width:auto !important; line-height: 26px; color:#282828;">

                                                                                                                            <strong>Price:</strong>  <?= sprintf( $priceFormat, $this->number( $entry['price']->getValue(), $entry['price']->getPrecision() ), $this->translate( 'currency', $entry['price']->getCurrencyId() ) ); ?>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </table>
                                                                                                            </th>
                                                                                                        </tr>
                                                                                                    </table>
                                                                                                </td>
                                                                                            </tr>

                                                                                            <?php endforeach; ?>

                                                                                            <tr>
                                                                                                <td class="pt-10 pb-40" style="padding-top: 10px; padding-bottom: 40px;">
                                                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                                        <tr>
                                                                                                            <td class="img" height="1" bgcolor="#ebebeb" style="font-size:0pt; line-height:0pt; text-align:left;">&nbsp;</td>
                                                                                                        </tr>
                                                                                                    </table>
                                                                                                </td>
                                                                                            </tr>


                                                                                            <tr>
                                                                                                <td class="text-16 lh-26 a-center pb-25" style="font-size:16px; color:#6e6e6e; font-family:'PT Sans', Arial, sans-serif; min-width:auto !important; line-height: 26px; text-align:center; padding-bottom: 25px;">
                                                                                                    <?= $enc->html( nl2br( $this->translate( 'client', 'If you have any questions, please reply to this e-mail' ) ), $enc::TRUST ); ?>
                                                                                                </td>
                                                                                            </tr>

                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                            <!-- END Section - Order Details -->
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <!-- END Main -->
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <!-- END Container -->

                                        <!-- Footer -->
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td class="p-50 mpx-15" bgcolor="#949196" style="border-radius: 0 0 10px 10px; padding: 50px;">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        
                                                        <tr>
                                                            <td class="text-14 lh-24 a-center c-white l-white pb-20" style="font-size:14px; font-family:'PT Sans', Arial, sans-serif; min-width:auto !important; line-height: 24px; text-align:center; color:#ffffff; padding-bottom: 20px;">
                                                            <?= $enc->html( $this->translate( 'client', 'Moscow region Domodedovsky district, village Starosyanovo st. New 11' ), $enc::TRUST ); ?>
                                    
                                                            <br />
                                                                <a target="_blank" class="link c-white" style="text-decoration:none; color:#ffffff;"><span class="link c-white" style="text-decoration:none; color:#ffffff;"> +7 (495) 542-40-60</span></a> 
                                                                <br />
                                                                <a href="<?=url()->to('/')?>" target="_blank" class="link c-white" style="text-decoration:none; color:#ffffff;"><span class="link c-white" style="text-decoration:none; color:#ffffff;"><?=url()->current()?> - sales@ekolmarket.ru</span></a>
                                                            </td>
                                                        </tr>
                                                        
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>											<!-- END Footer -->

                                        <!-- Bottom -->
                                        											<!-- END Bottom -->
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</center>
</body>
</html>
<?php $this->block()->stop(); ?>
<?= $this->block()->get( 'email/watch/html' ); ?>
