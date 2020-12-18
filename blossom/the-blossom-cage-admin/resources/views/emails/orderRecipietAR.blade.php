<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"/>

    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">

    <title>Blossom Cage</title>
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
          integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/brands.css"
          integrity="sha384-nT8r1Kzllf71iZl81CdFzObMsaLOhqBU1JD2+XoAALbdtWaXDOlWOZTR4v1ktjPE" crossorigin="anonymous">

    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Quicksand:400,500,700');

        /**This is to overwrite Outlook.com’s Embedded CSS************/
        table {
            border-collapse: separate;
        }

        a, a:link, a:visited {
            text-decoration: none;
            color: #00788a
        }

        h2, h2 a, h2 a:visited, h3, h3 a, h3 a:visited, h4, h5, h6, .t_cht {
            color: #000 !important
        }

        p {
            margin-bottom: 0
        }

        .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td {
            line-height: 100%
        }

        /**This is to center your email in Outlook.com************/
        .ExternalClass {
            width: 100%;
        }

        /* General Resets */
        #outlook a {
            padding: 0;
        }

        body, #body-table {
            height: 100% !important;
            width: 100% !important;
            margin: 0 auto;
            padding: 0;
            line-height: 100%;
        !important
        }

        img, a img {
            border: 0;
            outline: none;
            text-decoration: none;
        }

        .image-fix {
            display: block;
        }

        table, td {
            border-collapse: collapse;
        }

        /* Client Specific Resets */
        .ReadMsgBody {
            width: 100%;
        }

        .ExternalClass {
            width: 100%;
        }

        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
            line-height: 100% !important;
        }

        .ExternalClass * {
            line-height: 100% !important;
        }

        table, td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            outline: none;
            border: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        body, table, td, p, a, li, blockquote {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        body.outlook img {
            width: auto !important;
            max-width: none !important;
        }

        /* Start Template Styles */
        /* Main */
        body {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
            direction: rtl !important;
            text-align: right !important;
        }

        body, #body-table {
            background-color: #e9ecef
            margin: 0 auto !important;;
            margin: 0 auto !important;
            text-align: center !important;
        }

        p {
            padding: 0;
            margin: 0;
            line-height: 24px;
            font-family: Open Sans, sans-serif;
        }

        a, a:link {
            color: #1c344d;
            text-decoration: none !important;
        }


        /* Yahoo Mail */
        .thread-item.expanded .thread-body {
            background-color: #e9ecef !important;
        }

        .thread-item.expanded .thread-body .body, .msg-body {
            display: block !important;
        }

        #body-table .undoreset table {
            display: table !important;
            table-layout: fixed !important;
        }

        /* Start Media Queries */
        @media only screen and (max-width: 600px) {
            .full_row {
                width: 96% !important;
            }
        }

        @media only screen and (max-width: 480px) {

        }

        @media only screen and (max-width: 390px) {
            *[class].full-width {
                width: 100% !important;
            }

            *[class].mobile-width {
                width: 100% !important;
                padding: 0 4px;
            }

            *[class].content-width {
                width: 240px !important;
            }

            *[class].center {
                text-align: center !important;
                height: auto !important;
            }

            *[class].center-stack {
                padding-bottom: 30px !important;
                text-align: center !important;
                height: auto !important;
            }

            *[class].stack {
                padding-bottom: 30px !important;
                height: auto !important;
            }

            *[class].gallery {
                padding-bottom: 20px !important;
            }

            *[class].fluid-img {
                height: auto !important;
                max-width: 600px !important;
                width: 100% !important;
                min-width: 320px !important;
            }

            *[class].midaling {
                width: 100% !important;
                border: none !important;
            }

            *[class].facilitiesList {
                width: 100% !important;
            }

            *[class].facilitiesList td {
                width: 100% !important;
                display: inline-block !important;
            }

            *[class].w100 {
                width: 100% !important;
            }

            *[class].dib {
                width: 100% !important;
                display: inline-block !important;
            }

            *[class].text-center {
                text-align: center !important;
            }

            *[class].bsize18 {
                text-align: left !important;
            }

            *[class].logo img {
                margin-bottom: 20px !important;
            }

            *[class].dn {
                display: none !important;
            }

        }


    </style>
</head>
<body id="bd" style="margin:0; background:#e9ecef;">
@php
    $status = '';
    if($data['order']['order_status_id'] == 1)
    {
    $status = 'تم الاستلام';
    }
    elseif($data['order']['order_status_id'] == 2)
    {$status = 'معالجة';}
    elseif($data['order']['order_status_id'] == 3)
    {$status = 'أرسل';}
    elseif($data['order']['order_status_id'] == 4)
    {
    $status = 'تم التوصيل';
    }
    elseif($data['order']['order_status_id'] == 5)
    {
    $status = 'ألغيت';
    }
    else{
    $status = 'معالجة';
    }

@endphp

<table class="z" bgcolor="ffffff" border="0" cellpadding="0" cellspacing="0"
       style="max-width: 600px;direction: rtl!important; width:100%; background: #ffffff; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"
       align="center">
    <tbody>

    <tr>
        <td width="100%">
            <table bgcolor="#e9ecef" class="full" border="0" cellpadding="0" cellspacing="0"
                   style="direction: rtl!important;mso-table-lspace:0pt; mso-table-rspace:0pt; margin: 0 auto; background: #e9ecef;"
                   width="100%" align="center">
                <tr>
                    <td height="5" style="background: #627A76;">

                    </td>
                </tr>
            </table>
            <table class="full_row" border="0" cellpadding="0" cellspacing="0"
                   style="direction: rtl!important;max-width: 560px; width:100%; mso-table-lspace:0pt; mso-table-rspace:0pt; margin: 0 auto; "
                   align="center">
                <tbody>
                <tr>
                    <td height="10"></td>
                </tr>
                <tr>
                    <td valign="top">

                        <table border="0" cellpadding="0" cellspacing="0"
                               style="mso-table-lspace:0pt; mso-table-rspace:0pt; margin: 0 auto; border-collapse:collapse;"
                               width="100%" align="center">

                            <tr>
                                <td class="dib" valign="top" width="150" height="50">

                                    <!-- Start Image -->

                                    <table border="0" cellpadding="0" cellspacing="0"
                                           style="mso-table-lspace:0pt; mso-table-rspace:0pt; margin: 0 auto; border-collapse:collapse;"
                                           width="100%" align="center">
                                        <tbody>
                                        <tr>


                                            <!-- Start Image -->
                                            <td valign="top">

                                                <table border="0" cellpadding="0" cellspacing="0"
                                                       style="direction: rtl!important;mso-table-lspace:0pt; mso-table-rspace:0pt; margin: 0 auto; border-collapse:collapse;"
                                                       width="100%" align="center">
                                                    <tbody>
                                                    <tr>

                                                        <td class="logo" width="150" align="right"
                                                            style="line-height: 0px;">

                                                            <a href="#"
                                                               style="display:block; margin: 0 auto; text-align: left;">
                                                                <img label="img"
                                                                     src="{{asset('public/images/logo-invert.png')}}"
                                                                     alt="img" width="100"  height="70" class="img"
                                                                     style="display:block; line-height:0px; font-size:0px; border:0px;">
                                                            </a>
                                                        </td>
                                                        <td class="logo" width="150" align="left"
                                                            style="line-height: 0px;">
                                                            <a href="#"
                                                               style="display:block; margin: 0 auto; text-align: left;font-family: 'Quicksand' , arial; font-size: 14px; font-weight: bold;">
                                                                اتصل بنا

                                                            </a>
                                                        </td>

                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </td>
                                            <!-- End Image -->

                                        </tr>
                                        </tbody>
                                    </table>

                                    <!-- End Image -->

                                </td>
                        </table>

                    </td>
                </tr>
                <tr>
                    <td height="5	"></td>
                </tr>
                <tr>
                    <td height="5" style="border-bottom:1px solid #e6e6e6;">

                    </td>
                </tr>
                <tr>
                    <td height="10">

                    </td>
                </tr>
                <tr>
                    <td valign="top" style="margin: 0 !important; padding:0!important;" align="center" width="100%">
                        <table class="dn" cellpadding="0" cellspacing="0" border="0" width="100%" height="10"
                               align="center"></table>
                        <table bgcolor="#fff" cellpadding="0" cellspacing="0" border="0" width="100%" align="left">
                            <tbody>
                            <tr>
                                <td valign="top" style="margin: 0 !important; padding:0!important;" align="center"
                                    width="100%">
                                    <table class="w101" style="margin:0; display:block; overflow: hidden;"
                                           cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
                                        <tbody>
                                        <tr>
                                            <td class="w101" valign="top"
                                                style="margin: 0 !important; padding:0!important;" align="center"
                                                width="100%"><a
                                                        style="border:none; text-decoration:none; width:100%; display:block; "
                                                        href="#"><img style="width:100%;" class="imgfixer"
                                                                      src="{{asset('public/images/img3.jpg')}}"></a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table style="margin:0;width:100%;" cellpadding="0" cellspacing="0" border="0"
                                           width="100%" align="center">
                                        <tr>
                                            <td width="100%" valign="top"
                                                style="margin: 0 !important; padding:0!important;" height="30"></td>
                                        </tr>
                                        <tr>
                                            <td width="100%" valign="top"
                                                style="margin: 0 !important; padding:0!important; font-size:14px;font-family: 'Quicksand' , arial; font-weight:500 ; line-height:21px;text-align: right;color: #333334;letter-spacing: .5px;  "
                                                height="30"><strong>
                                                العزيز,{{$data['order']['recipient_first_name']}} {{$data['order']['recipient_last_name']}}
                                                </strong>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="fxfont1" height="40" width="100%" valign="top"
                                                style="margin: 0 !important; padding:0!important;border:none; text-decoration:none; padding:0;font-size:20px; font-family: 'Quicksand' , arial; font-weight:500 ; line-height:31px; text-align: center; color: #333334;letter-spacing: .5px;"
                                                align="center">
                                                @if($data['order']['order_status_id'] == 1)
                                                    لقد قمت بوضع طلب جديد ورقم طلبك هو:{{$data['order']['order_token']}}
                                                @elseif($data['order']['order_status_id']== 2)
                                                    طلبك قيد المعالجة لإرساله ورقم طلبك هو:{{$data['order']['order_token']}}
                                                @elseif($data['order']['order_status_id'] == 3)
                                                    تم إرسال طلبك للتسليم ورقم طلبك هو:{{$data['order']['order_token']}}
                                                @elseif($data['order']['order_status_id'] == 4)
                                                    شكرا للتسوق في تنظيفات. تم تسليم طلبك بنجاح على عنوان الشحن الخاص
                                                    بك.
                                                @elseif($data['order']['order_status_id'] == 5)
                                                    تم إلغاء طلبك ورقم طلبك هو:{{$data['order']['order_token']}}.
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="100%" valign="top"
                                                style="margin: 0 !important; padding:0!important;" height="10"></td>
                                        </tr>
                                        <tr>
                                            <td class="p0" width="100%" valign="top"
                                                style="margin: 0 !important; padding:0!important; font-size:16px;font-family: 'Quicksand' , arial; font-weight:500 ; line-height:21px; text-align: center; color: #777;letter-spacing: .5px; ">


                                                هنا<a href="{{$data['link']}}"> تفاصيل</a> النظام.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="100%" valign="top"
                                                style="margin: 0 !important; padding:0!important;" height="10"></td>
                                        </tr>

                                    </table>
                                    <table style="margin:0;width:100%;" cellpadding="0" cellspacing="0" border="0"
                                           width="100%" align="center">
                                        <tr>

                                            <td style="margin: 0; margin-bottom: 0; margin: 0 !important; margin-bottom: 0 !important;"
                                                valign="top">


                                                <table border="0" cellpadding="0" cellspacing="0" height="15">
                                                    <tbody>
                                                    <tr>
                                                        <td height="15"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="40">
                                                    <tbody>
                                                    <tr>
                                                        <td bgcolor="#E9ECEF"
                                                            style="color:#5e7976;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:16px;font-weight:600; vertical-align:top; margin:0!important; text-align: right;padding:10px 15px!important; margin: 0; margin-bottom: 0; vertical-align: middle; margin: 0 !important; margin-bottom: 0 !important;"
                                                            align="left" width="100%">معلومات الاتصال
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="50"
                                                       style="border-bottom:1px solid #f1f1f1;">
                                                    <tbody>
                                                    <tr>
                                                        <td style="margin: 0; margin-bottom: 0;letter-spacing: .5px;padding:10px 15px!important; margin: 0 !important; vertical-align:middle; vertical-align: middle;margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:400; text-align: right;"
                                                            align="left" width="100%">
                                                            <strong>البريد
                                                                الإلكتروني:</strong> {{$data['order']['recipient_email']}}
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="50"
                                                       style="border-bottom:1px solid #f1f1f1;">
                                                    <tbody>
                                                    <tr>
                                                        <td style="margin: 0; margin-bottom: 0; text-align: right;letter-spacing: .5px;padding:10px 15px!important; margin: 0 !important; vertical-align:middle; vertical-align: middle;margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:400;"
                                                            align="left" width="100%">
                                                            <strong>هاتف:</strong> <strong style="font-weight: normal;direction: ltr;text-align: right;display: inline-block;">{{$data['order']['recipient_phone_no']}}</strong>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="40">
                                                    <tbody>
                                                    <tr>
                                                        <td bgcolor="#E9ECEF"
                                                            style="color:#5e7976;text-align: right;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:16px;font-weight:600; vertical-align:top; margin:0!important; padding:10px 15px!important;margin: 0; margin-bottom: 0; vertical-align: middle; margin: 0 !important; margin-bottom: 0 !important;"
                                                            align="left" width="100%">عنوان الشحن
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="50"
                                                       style="border-bottom:1px solid #f1f1f1;">
                                                    <tbody>
                                                    <tr>
                                                        <td style="margin: 0; margin-bottom: 0; text-align: right;letter-spacing: .5px;padding:10px 15px!important; margin: 0 !important; vertical-align:middle; vertical-align: middle;margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:400;"
                                                            align="left" width="100%">
                                                            <strong>الاسم
                                                                الكامل:</strong> {{$data['order']['recipient_first_name']}} {{$data['order']['recipient_last_name']}}
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="50"
                                                       style="border-bottom:1px solid #f1f1f1;">
                                                    <tbody>
                                                    <tr>
                                                        <td style="margin: 0; margin-bottom: 0;text-align: right; letter-spacing: .5px;padding:10px 15px!important; margin: 0 !important; vertical-align:middle; vertical-align: middle;margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:400;"
                                                            align="left" width="100%">
                                                            <strong>عنوان
                                                                الشارع:</strong> {{$data['shipping_address']['full_address']}}

                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="50"
                                                       style="border-bottom:1px solid #f1f1f1;">
                                                    <tbody>
                                                    <tr>
                                                        <td style="margin: 0; margin-bottom: 0;text-align: right; letter-spacing: .5px;padding:10px 15px!important; margin: 0 !important; vertical-align:middle; vertical-align: middle;margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:400;"
                                                            align="left" width="100%">
                                                            <strong>الرمز
                                                                البريدي:</strong> {{$data['shipping_address']['zip_code']}}
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>


                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="50"
                                                       style="border-bottom:1px solid #f1f1f1;">
                                                    <tbody>
                                                    <?php  $data_city_shipping = \App\Cities::where('id', $data['shipping_address']['city'])->where('archive', 0)->first();

                                                    ?>
                                                    <tr>
                                                        <td style="margin: 0; margin-bottom: 0;text-align: right; letter-spacing: .5px;padding:10px 15px!important; margin: 0 !important; vertical-align:middle; vertical-align: middle;margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:400;"
                                                            align="left" width="100%">
                                                            <strong>مدينة:</strong>{{$data_city_shipping->ar_name}}
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="50"
                                                       style="border-bottom:1px solid #f1f1f1;">
                                                    <tbody>
                                                    <tr>
                                                        <td style="margin: 0; margin-bottom: 0;text-align: right; letter-spacing: .5px;padding:10px 15px!important; margin: 0 !important; vertical-align:middle; vertical-align: middle;margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:400;"
                                                            align="left" width="100%">
                                                            <strong>حالة:</strong> {{!empty($data['shipping_address']['state']) ? $data['shipping_address']['state'] : $data['shipping_address']['city']}}

                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>



                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="50"
                                                       style="border-bottom:1px solid #f1f1f1;">
                                                    <tbody>
                                                    <tr>
                                                        <td style="margin: 0; margin-bottom: 0; text-align: right;letter-spacing: .5px;padding:10px 15px!important; margin: 0 !important; vertical-align:middle; vertical-align: middle;margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:400;"
                                                            align="left" width="100%">
                                                            <strong>هاتف:</strong> <strong style="font-weight: normal;direction: ltr;text-align: right;display: inline-block;">{{$data['shipping_address']['phone_no']}}</strong>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="40">
                                                    <tbody>
                                                    <tr>
                                                        <td bgcolor="#E9ECEF"
                                                            style="color:#5e7976;text-align: right;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:16px;font-weight:600; vertical-align:top; margin:0!important; padding:10px 15px!important;margin: 0; margin-bottom: 0; vertical-align: middle; margin: 0 !important; margin-bottom: 0 !important;"
                                                            align="left" width="100%">عنوان وصول الفواتير
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="50"
                                                       style="border-bottom:1px solid #f1f1f1;">
                                                    <tbody>
                                                    <tr>
                                                        <td style="margin: 0; margin-bottom: 0; text-align: right;letter-spacing: .5px;padding:10px 15px!important; margin: 0 !important; vertical-align:middle; vertical-align: middle;margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:400;"
                                                            align="left" width="100%">
                                                            <strong>الاسم
                                                                الكامل:</strong>

                                                            @if(!empty($data['billing_address']['first_name']))
                                                                {{$data['billing_address']['first_name']}} {{$data['billing_address']['last_name']}}
                                                            @else
                                                                {{$data['order']['recipient_first_name']}} {{$data['order']['recipient_last_name']}}
                                                            @endif

                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="50"
                                                       style="border-bottom:1px solid #f1f1f1;">
                                                    <tbody>
                                                    <tr>
                                                        <td style="margin: 0; margin-bottom: 0;text-align: right; letter-spacing: .5px;padding:10px 15px!important; margin: 0 !important; vertical-align:middle; vertical-align: middle;margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:400;"
                                                            align="left" width="100%">
                                                            <strong>عنوان
                                                                الشارع:</strong> {{$data['billing_address']['full_address']}}

                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="50"
                                                       style="border-bottom:1px solid #f1f1f1;">
                                                    <tbody>
                                                    <tr>
                                                        <td style="margin: 0; margin-bottom: 0;text-align: right; letter-spacing: .5px;padding:10px 15px!important; margin: 0 !important; vertical-align:middle; vertical-align: middle;margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:400;"
                                                            align="left" width="100%">
                                                            <strong>الرمز
                                                                البريدي:</strong> {{$data['billing_address']['zip_code']}}
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="50"
                                                       style="border-bottom:1px solid #f1f1f1;">
                                                    <tbody>
                                                    <?php  $data_city = \App\Cities::where('id', $data['billing_address']['city'])->where('archive', 0)->first();

                                                    ?>
                                                    <tr>
                                                        <td style="margin: 0; margin-bottom: 0;text-align: right; letter-spacing: .5px;padding:10px 15px!important; margin: 0 !important; vertical-align:middle; vertical-align: middle;margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:400;"
                                                            align="left" width="100%">
                                                            <strong>مدينة:</strong>{{$data_city->ar_name}}
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="50"
                                                       style="border-bottom:1px solid #f1f1f1;">
                                                    <tbody>
                                                    <tr>
                                                        <td style="margin: 0; margin-bottom: 0;text-align: right; letter-spacing: .5px;padding:10px 15px!important; margin: 0 !important; vertical-align:middle; vertical-align: middle;margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:400;"
                                                            align="left" width="100%">
                                                            <strong>حالة:</strong> {{!empty($data['billing_address']['state']) ? $data['shipping_address']['state'] : $data['shipping_address']['city']}}

                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>


                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="40">
                                                    <tbody>
                                                    <tr>
                                                        <td bgcolor="#E9ECEF"
                                                            style="color:#5e7976;text-align: right;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:16px;font-weight:600; vertical-align:top; margin:0!important;text-align: right;padding:10px 15px!important;margin: 0; margin-bottom: 0; vertical-align: middle; margin: 0 !important; margin-bottom: 0 !important;"
                                                            align="right" width="100%">معلومات الشحن
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="50"
                                                       style="border-bottom:1px solid #f1f1f1;">
                                                    <tbody>
                                                    <tr>
                                                        <td style="margin: 0; margin-bottom: 0;text-align: right; letter-spacing: .5px;padding:10px 15px!important; margin: 0 !important; vertical-align:middle; vertical-align: middle;margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:400;"
                                                            align="right" width="100%">
                                                            <strong>رقم فاتورة مجرى
                                                                الهواء:</strong> {{$data['order']['awb_number']}}
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="50"
                                                       style="border-bottom:1px solid #f1f1f1;">
                                                    <tbody>
                                                    <tr>
                                                        <td style="margin: 0; margin-bottom: 0;letter-spacing: .5px;padding:10px 15px!important; margin: 0 !important; vertical-align:middle; vertical-align: middle;margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:400;"
                                                            align="right" width="100%">
                                                            <strong> حالة
                                                                الشحن: </strong> {{!empty($data['order']['shipping_status']) ? $data['order']['shipping_status'] : 'غير متوفر'}}
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="50"
                                                       style="border-bottom:1px solid #f1f1f1;">
                                                    <tbody>
                                                    <tr>
                                                        <td style="margin: 0; margin-bottom: 0;letter-spacing: .5px;padding:10px 15px!important; margin: 0 !important; vertical-align:middle; vertical-align: middle;margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:400;"
                                                            align="right" width="100%">
                                                            <strong> تفاصيل
                                                                الشحن: </strong> {{!empty($data['order']['shipping_details']) ? $data['order']['shipping_details'] : 'غير متوفر'}}
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>




                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                width="100%" height="40">
                                                <tbody>
                                                <tr>
                                                    <td bgcolor="#E9ECEF"
                                                        style="color:#5e7976;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:16px;font-weight:600; vertical-align:top; margin:0!important;text-align: left;padding:10px 15px!important;margin: 0; margin-bottom: 0; vertical-align: middle; margin: 0 !important; margin-bottom: 0 !important;"
                                                        align="left" width="100%">طريقة الدفع او السداد
                                                    </td>
                                                </tr>
                                                </tbody>
                                    </table>
                                    <table align="center" cellpadding="0" cellspacing="0" border="0"
                                           width="100%" height="50"
                                           style="border-bottom:1px solid #f1f1f1;">
                                        <tbody>
                                        <tr>
                                            <td style="margin: 0; margin-bottom: 0;letter-spacing: .5px;padding:10px 15px!important; margin: 0 !important; vertical-align:middle; vertical-align: middle;margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:400;"
                                                align="left" width="100%">
                                                <strong> طريقة الدفع او السداد:</strong>
                                                @if(!empty($data['order']['cod']) && $data['order']['cod'] == "1" )
                                                    Cash on delivery
                                                @else
                                                    Paytab
                                                @endif
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    @if(empty($data['order']['cod']) && $data['order']['cod'] == "0" )

                                        <table align="center" cellpadding="0" cellspacing="0" border="0"
                                               width="100%" height="50"
                                               style="border-bottom:1px solid #f1f1f1;">
                                            <tbody>
                                            <tr>
                                                <td style="margin: 0; margin-bottom: 0;letter-spacing: .5px;padding:10px 15px!important; margin: 0 !important; vertical-align:middle; vertical-align: middle;margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:400;"
                                                    align="left" width="100%">
                                                    <strong>نوع البطاقة:</strong>
                                                    {{$data['order']['card_brand']}}

                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table align="center" cellpadding="0" cellspacing="0" border="0"
                                               width="100%" height="50"
                                               style="border-bottom:1px solid #f1f1f1;">
                                            <tbody>
                                            <tr>
                                                <td style="margin: 0; margin-bottom: 0;letter-spacing: .5px;padding:10px 15px!important; margin: 0 !important; vertical-align:middle; vertical-align: middle;margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:400;"
                                                    align="left" width="100%">
                                                    <strong>بطاقة التفاصيل:</strong>
                                                    {{$data['order']['first_4_digits']}}
                                                    ******** {{$data['order']['last_4_digits']}}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    @endif


                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="40">
                                                    <tbody>
                                                    <tr>
                                                        <td bgcolor="#E9ECEF"
                                                            style="color:#5e7976;text-align: right;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:16px;font-weight:600; vertical-align:top; margin:0!important;text-align: right;padding:10px 15px!important;margin: 0; margin-bottom: 0; vertical-align: middle; margin: 0 !important; margin-bottom: 0 !important;"
                                                            align="right" width="100%">طريقة الشحن
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="100"
                                                       style="border-bottom:1px solid #d6d6d6;">
                                                    <tbody>
                                                    <tr>
                                                        <td width="100%" height="30"
                                                            style="margin: 0; margin-bottom: 0; margin: 0 !important; vertical-align:top; margin-bottom: 0 !important;"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="margin: 0; margin-bottom: 0; margin: 0 !important;text-align: right; vertical-align:top; margin-bottom: 0 !important;"
                                                            align="left" width="100%"><p
                                                                    style="color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:bold; vertical-align:top; margin:12px 0 0 13px !important;">
                                                                طريقة الشحن
                                                                :
                                                                <span style="color:#444;font-family:'Arial', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:300; vertical-align:top; margin:0!important; font-style:italic"> SMSA الشحن
                                                                                                            </span></p>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="50"
                                                       style="border-bottom:1px solid #f1f1f1;">
                                                    <tbody>
                                                    <tr>
                                                        <td style="margin: 0; margin-bottom: 0;letter-spacing: .5px;padding:10px 15px!important; margin: 0 !important; vertical-align:middle; vertical-align: middle;margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:400;"
                                                            align="left" width="100%">
                                                            <strong>طريقة الشحن
                                                                :</strong>
                                                            SMSA الشحن
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                                @if(is_numeric($data['order']['awb_number']) && $data['order']['awb_number'] > 0 && $data['order']['awb_number'] == round($data['order']['awb_number'], 0))

                                                    <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                           width="100%" height="50"
                                                           style="border-bottom:1px solid #f1f1f1;">
                                                        <tbody>
                                                        <tr>
                                                            <td style="margin: 0; margin-bottom: 0;letter-spacing: .5px;padding:10px 15px!important; margin: 0 !important; vertical-align:middle; vertical-align: middle;margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:400;"
                                                                align="left" width="100%">
                                                                <strong>عدد أوب:</strong>
                                                                {{$data['order']['awb_number']}}
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                @endif





                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="40">
                                                    <tbody>
                                                    <tr>
                                                        <td bgcolor="#E9ECEF"
                                                            style="color:#5e7976;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:16px;font-weight:600; vertical-align:top; margin:0!important; text-align: center;margin: 0; margin-bottom: 0; vertical-align: middle; margin: 0 !important; margin-bottom: 0 !important;"
                                                            align="left" width="100%">عناصر المعلومات
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                                @php $total = $totalaccessories= 0; @endphp
                                                @foreach($data['items'] as $item)

                                                    <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%" height="40" style="border-bottom:1px solid #f1f1f1;">
                                                        <tbody>
                                                        <tr>
                                                            <td width="100%" valign="top" style="margin: 0 !important; padding:0!important; font-size:14px; color:#000;" height="10"></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="100%" valign="top" style="margin: 0 !important; padding:0!important; font-size:14px; color:#000;">
                                                                <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                    <tr>
                                                                        <td width="100px" valign="top" style="margin: 0 !important; padding:0!important; font-size:14px; color:#000;">
                                                                            <img width="100px"
                                                                                 src="http://d4q3rypwox3wu.cloudfront.net/thumbnails/large/items/{{$item['image']}}"
                                                                                 border="0" hspace="0" vspace="0" style="max-width:100%;">
                                                                        </td>
                                                                        <td width="10px" valign="top" style="margin: 0 !important; padding:0!important; font-size:14px; color:#000;"></td>
                                                                        <td style="margin: 0; margin-bottom: 0; margin: 0 !important; vertical-align:top; margin-bottom: 0 !important;color:#627A76;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif'; line-height: 25px; text-decoration:none;font-size:14px;font-weight:bold; vertical-align:middle;" align="right" width="400px">
                                                                            {{$item['ar_title']}}<br>
                                                                            @if(!empty($item['color_code']))

                                                                                <span style="color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;margin:0!important; font-weight: bold; ">
                                                                                <strong style="display: inline-block; vertical-align: middle;width: 20px; height: 20px; background: {{$item['color_code']}}; border-radius: 50px!important; -webkit-border-radius: 50px!important; -moz-border-radius: 50px!important;"></strong></span>
                                                                                <br>
                                                                                <span style="color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:13px;margin:0!important; font-weight: normal; line-height: 30px; "> Quantity: <strong>{{$item['quantity']}}</strong></span>

                                                                                <br>

                                                                            @endif

                                                                            <span style="width:100%; display: block; text-align: left; color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:18px;margin:0!important; font-weight: normal; "> {{$item['currency']}} {{$item['price']}}</span>

                                                                            @php $total = $total +($item['price'] * $item['quantity']); @endphp

                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td width="100%" valign="top" style="margin: 0 !important; padding:0!important; font-size:14px; color:#000;" height="10"></td>
                                                        </tr>

                                                        @if(!empty($item['orderItemAccessories']))

                                                            @foreach($item['orderItemAccessories'] as $orderItemAccessoire)



                                                                <tr>
                                                                    <td width="100%" valign="top" style="margin: 0 !important; padding:0!important; font-size:14px; color:#000;">
                                                                        <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                            <tr>
                                                                                <td width="30px" valign="top" style="margin: 0 !important; padding:0!important; font-size:14px; color:#000;"></td>
                                                                                <td  width="60px" valign="top" style="margin: 0 !important; padding:0!important; font-size:14px; color:#000;">
                                                                                    <img width="60px"
                                                                                         src="http://d4q3rypwox3wu.cloudfront.net/thumbnails/small/accessories/{{$orderItemAccessoire['image']}}"
                                                                                         border="0" hspace="0" vspace="0" style="max-width:100%;">
                                                                                </td>
                                                                                <td width="10px" valign="top" style="margin: 0 !important; padding:0!important; font-size:14px; color:#000;"></td>
                                                                                <td style="margin: 0; margin-bottom: 0; margin: 0 !important; vertical-align:top; margin-bottom: 0 !important;color:#627A76;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:bold; vertical-align:middle;" align="right" width="400px">
                                                                                    {{$orderItemAccessoire['en_title']}} <br>
                                                                                    <span style="color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:13px;margin:0!important; font-weight: normal; "> Quantity: <strong>{{$orderItemAccessoire['quantity']}}</strong></span>
                                                                                    <br>
                                                                                    <span style="width:100%; display: block; text-align: left; color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:18px;margin:0!important; font-weight: normal; "> {{$item['currency']}} {{$orderItemAccessoire['price']}}</span>
                                                                                    @php $totalaccessories = $totalaccessories +($orderItemAccessoire['quantity'] * $orderItemAccessoire['price']); @endphp


                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                        <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                            <tr>
                                                                                <td height="10px" valign="top" style="margin: 0 !important; padding:0!important; font-size:14px; color:#000;"></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                @endforeach

                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="40">
                                                    <tbody>
                                                    <tr>
                                                        <td bgcolor="#E9ECEF"
                                                            style="color:#5e7976;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:16px;font-weight:600; vertical-align:top; margin:0!important; text-align: center;margin: 0; margin-bottom: 0; vertical-align: middle; margin: 0 !important; margin-bottom: 0 !important;"
                                                            align="left" width="100%">ملخص الطلب
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="40"
                                                       style="border-bottom:1px solid #f1f1f1;">
                                                    <tbody>
                                                    <tr>
                                                        <td style="margin: 0; margin-bottom: 0; margin: 0 !important; vertical-align:top; margin-bottom: 0 !important;"
                                                            align="left" width="100%">
                                                            <table align="center" cellpadding="0" cellspacing="0"
                                                                   border="0" width="100%" height="40">
                                                                <tbody>
                                                                <tr>
                                                                    <td style="margin: 0; letter-spacing: .5px;margin-bottom: 0; margin: 0 !important; vertical-align:top; margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:bold; vertical-align:middle; text-align: right;"
                                                                        align="left" width="50%">
                                                                        حاصل الجمع

                                                                    </td>
                                                                    <td style="margin: 0; margin-bottom: 0; margin: 0 !important; vertical-align:top; margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:16px;font-weight:bold; vertical-align:middle; text-align: left;"
                                                                        align="right" width="50%">
                                                                        {{$data['order']['order_currency']}}  {{$total + $totalaccessories}}
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="40"
                                                       style="border-bottom:1px solid #f1f1f1;">
                                                    <tbody>
                                                    <tr>
                                                        <td style="margin: 0; margin-bottom: 0; margin: 0 !important; vertical-align:top; margin-bottom: 0 !important;"
                                                            align="left" width="100%">
                                                            <table align="center" cellpadding="0" cellspacing="0"
                                                                   border="0" width="100%" height="40">
                                                                <tbody>
                                                                <tr>
                                                                    <td style="margin: 0;letter-spacing: .5px; margin-bottom: 0; margin: 0 !important; vertical-align:top; margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:bold; vertical-align:middle; text-align: right;"
                                                                        align="left" width="50%">
                                                                        توصيل
                                                                    </td>
                                                                    <td style="margin: 0; margin-bottom: 0; margin: 0 !important; vertical-align:top; margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:16px;font-weight:bold; vertical-align:middle; text-align: left;"
                                                                        align="right" width="50%">
                                                                        {{$data['order']['order_currency']}} {{$data['order']['converted_shipping_amount']}}

                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="40"
                                                       style="border-bottom:1px solid #f1f1f1;">
                                                    <tbody>
                                                    <tr>
                                                        <td style="margin: 0; margin-bottom: 0; margin: 0 !important; vertical-align:top; margin-bottom: 0 !important;"
                                                            align="left" width="100%">
                                                            <table align="center" cellpadding="0" cellspacing="0"
                                                                   border="0" width="100%" height="40">
                                                                <tbody>
                                                                <tr>
                                                                    <td style="margin: 0;letter-spacing: .5px; margin-bottom: 0; margin: 0 !important; vertical-align:top; margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:14px;font-weight:bold; vertical-align:middle; text-align: right;"
                                                                        align="left" width="50%">
                                                                        الضريبة المقدرة

                                                                    </td>
                                                                    <td style="margin: 0; margin-bottom: 0; margin: 0 !important; vertical-align:top; margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:16px;font-weight:bold; vertical-align:middle; text-align: left;"
                                                                        align="right" width="50%">
                                                                        {{$data['order']['order_currency']}} {{$data['order']['converted_tax_amount']}}
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="40"
                                                       style="border-bottom:1px solid #f1f1f1;">
                                                    <tbody>
                                                    <tr>
                                                        <td style="margin: 0; margin-bottom: 0; margin: 0 !important; vertical-align:top; margin-bottom: 0 !important;"
                                                            align="left" width="100%">
                                                            <table align="center" cellpadding="0" cellspacing="0"
                                                                   border="0" width="100%" height="40">
                                                                <tbody>
                                                                <tr>
                                                                    <td style="margin: 0;letter-spacing: .5px; margin-bottom: 0; margin: 0 !important; vertical-align:top; margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:20px; text-transform: uppercase;font-weight:bold; vertical-align:middle; text-align: right;"
                                                                        align="left" width="50%">
                                                                        مجموع
                                                                    </td>
                                                                    <td style="margin: 0; margin-bottom: 0; margin: 0 !important; vertical-align:top; margin-bottom: 0 !important;color:#444;font-family:'Quicksand', 'Arial', 'Helvetica', 'sans-serif';text-decoration:none;font-size:16px;font-weight:bold; vertical-align:middle; text-align: left;"
                                                                        align="right" width="50%">
                                                                        {{$data['order']['order_currency']}} {{$total + $totalaccessories + $data['order']['converted_tax_amount'] + $data['order']['converted_shipping_amount']}}
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                       width="100%" height="40">
                                                    <tbody>
                                                    <tr>
                                                        <td style="margin: 0; margin-bottom: 0; margin: 0 !important; vertical-align:top; margin-bottom: 0 !important;"
                                                            align="left" width="100%" height="40"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>

                                        </tr>
                                    </table>

                                    <table bgcolor="" cellpadding="0" cellspacing="0" border="0" width="100%"
                                           align="center">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <table width="100%   " border="0" align="center" cellpadding="0"
                                                       cellspacing="0">
                                                    <tbody>
                                                    <tr>
                                                        <td height="15"></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" width="100%" bgcolor="#E9ECEF">
                                                            <table class="table600" width="100%" border="0"
                                                                   cellspacing="0" cellpadding="0" bgcolor="#E9ECEF">
                                                                <tbody>
                                                                <tr>
                                                                    <td height="20" width="100%"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center" valign="top">
                                                                        <table class="table-inner" width="80%"
                                                                               border="0" cellspacing="0"
                                                                               cellpadding="0">

                                                                            <!-- notification -->
                                                                            <tbody>
                                                                            <tr>
                                                                                <td align="center"
                                                                                    style="font-size:14px; font-family: 'Quicksand' , arial; font-weight:500 ; line-height:21px; text-align: center; color: #777;letter-spacing: .5px;">
                                                                                    نحن هنا للمساعدة ، لا تتردد في
                                                                                    الاتصال بنا على
                                                                                    <a href="#"
                                                                                       style="font-size:14px; font-family: 'Quicksand' , arial; font-weight:500 ; line-height:21px; text-align: center; color: #333334;letter-spacing: .5px;color:#000; text-decoration:none">
                                                                                        info@xyz.com</a><br>
                                                                                    انقر هنا ل
                                                                                    <a href="#"
                                                                                       style="font-size:14px; font-family: 'Quicksand' , arial; font-weight:500 ; line-height:21px; text-align: center; color: #333334;letter-spacing: .5px;color:#000; text-decoration:none">إلغاء
                                                                                        الاشتراك
                                                                                        .</a><br>

                                                                                </td>
                                                                            </tr>
                                                                            <!-- end notification -->
                                                                            <tr>
                                                                                <td height="20"></td>
                                                                            </tr>

                                                                            <!--social-->
                                                                            <tr>
                                                                                <td align="center">
                                                                                    <table width="190" border="0"
                                                                                           cellpadding="0"
                                                                                           cellspacing="0"
                                                                                           class="social">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <a href="#">
                                                                                                    <img src="{{asset('public/images/social_twitter.png')}}"
                                                                                                         width="30"
                                                                                                         alt="">
                                                                                                </a>
                                                                                            </td>
                                                                                            <td width="15"></td>
                                                                                            <td>
                                                                                                <a href="#">
                                                                                                    <img src="{{asset('public/images/social_facebook.png')}}"
                                                                                                         width="30"
                                                                                                         alt="">
                                                                                                </a>
                                                                                            </td>
                                                                                            <td width="15"></td>
                                                                                            <td>
                                                                                                <a href="#">
                                                                                                    <img src="{{asset('public/images/socail_linkedin.png')}}"
                                                                                                         width="30"
                                                                                                         alt="">
                                                                                                </a>
                                                                                            </td>
                                                                                            <td width="15"></td>
                                                                                            <td>
                                                                                                <a href="#">
                                                                                                    <img src="{{asset('public/images/socail_instagram.png')}}"
                                                                                                         width="30"
                                                                                                         alt="">
                                                                                                </a>
                                                                                            </td>
                                                                                            <td width="15"></td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                            <!--end social--> </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                            <table width="100%" border="0" class="footer"
                                                                   style="border-top: 1px solid #ddd;color: #acafb3;font-size: 11px;line-height: 14px;margin-top: 20px;padding-top: 10px;text-align: center;">
                                                                <tbody>
                                                                <tr>
                                                                    <td height="10"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td style=" text-align: center; font-size: 11px;">
                                                                        <a href="#"
                                                                           style="text-decoration: none;color: #000;line-height: 30px;font-family: 'Quicksand' , arial; font-weight:500 ;font-size: 14px;">الدعم</a>
                                                                        |
                                                                        <a href="#"
                                                                           style="text-decoration: none;color: #000;line-height: 30px;font-family: 'Quicksand' , arial; font-weight:500 ;font-size: 14px;">الأحكام
                                                                            والشروط</a> |
                                                                        <a href="#"
                                                                           style="text-decoration: none;color: #000;line-height: 30px;font-size: 14px;font-family: 'Quicksand' , arial; font-weight:500 ;">سياسة
                                                                            خاصة</a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="10"></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" bgcolor="#000">
                                                            <table class="table600" width="100%" border="0"
                                                                   align="center" cellpadding="0" cellspacing="0">
                                                                <tbody>
                                                                <tr>
                                                                    <td height="40" align="center" bgcolor="#627A76"
                                                                        style=" font-size:12px ; color:#fff; line-height:15px;font-family: 'Quicksand' , arial; font-weight:500 ;">
                                                                        © 2019 مغشة، جميع الحقوق محفوظة.

                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="20"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                                <!--End footer info--> </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>

    </tbody>
</table>


</body>
</html>