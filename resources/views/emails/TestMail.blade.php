<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <title></title>


    <style>
    button {
        background-color: #ffa73b;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }

    .btn1 {
        width: 287px;
    }
    </style>

</head>

<body>
    <div class="es-wrapper-color">
        <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
            <tbody>
                <tr class="gmail-fix" height="0">
                    <td>
                        <table width="600" cellspacing="0" cellpadding="0" border="0" align="center">
                            <tbody>
                                <tr>
                                    <td cellpadding="0" cellspacing="0" border="0"
                                        style="line-height: 1px; min-width: 600px;" height="0"><img
                                            src="https://tlr.stripocdn.email/content/guids/CABINET_837dc1d79e3a5eca5eb1609bfe9fd374/images/41521605538834349.png"
                                            style="display: block; max-height: 0px; min-height: 0px; min-width: 600px; width: 600px;"
                                            alt width="600" height="1"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="esd-email-paddings" valign="top">


                        <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" style="background-color: #ffa73b;" esd-custom-block-id="6340"
                                        bgcolor="#ffa73b" align="center">
                                        <table class="es-content-body" style="background-color: transparent;"
                                            width="600" cellspacing="0" cellpadding="0" align="center">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure" align="left">
                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-container-frame" width="600"
                                                                        valign="top" align="center">
                                                                        <table
                                                                            style="background-color:  #ffecd1; border-radius: 4px; border-collapse: separate;"
                                                                            width="100%" cellspacing="0" cellpadding="0"
                                                                            bgcolor="#ffffff">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="esd-block-text es-p35t es-p5b es-p30r es-p30l"
                                                                                        align="center">
                                                                                        <h1>{{$detail['title']}}</h1>
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
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center">
                                        <table class="es-content-body" style="background-color: transparent;"
                                            width="600" cellspacing="0" cellpadding="0" align="center">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure" align="left">
                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-container-frame" width="600"
                                                                        valign="top" align="center">
                                                                        <table
                                                                            style="border-radius: 4px; border-collapse: separate; background-color: #ffffff;"
                                                                            width="100%" cellspacing="0" cellpadding="0"
                                                                            bgcolor="#ffffff">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="esd-block-text es-p20t es-p20b es-p30r es-p30l es-m-txt-l"
                                                                                        bgcolor="#ffffff" align="left">
                                                                                        <p>
                                                                                            Your order have been placed!
                                                                                        </p>
                                                                                        <p>
                                                                                            This payment form will
                                                                                            expired in 2 Days. Contact
                                                                                            us to resend a new form
                                                                                            after expiry date.
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="esd-block-button es-p35t es-p35b es-p10r es-p10l"
                                                                                        align="center">
                                                                                        <span
                                                                                            class="es-button-border"><button
                                                                                                class="btn1" id="open"><a
                                                                                                    href="{{URL::to('paymentForm')}}?token={{$detail['code']}}"
                                                                                                    class="es-button es-button-1637153467019"
                                                                                                    target="_blank"
                                                                                                    style="text-decoration: none; color:white;">Click
                                                                                                    Here to
                                                                                                    Pay!</a></button>
                                                                                        </span>
                                                                                    </td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td class="esd-block-button es-p35t es-p35b es-p10r es-p10l"
                                                                                        align="center"><span
                                                                                            class="es-button-border"><button><a
                                                                                                    href="{{url('generate-invoice', $detail['id'])}}"
                                                                                                    class="es-button es-button-1637153467019"
                                                                                                    target="_blank"
                                                                                                    style="text-decoration: none; color:white">Click
                                                                                                    Here to download
                                                                                                    invoice!</a></button></span>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="esd-block-text es-p20t es-p20b es-p30r es-p30l es-m-txt-l"
                                                                                        bgcolor="#ffffff" align="left">
                                                                                        <p>Thank you for supporting us!
                                                                                            Please continue to support
                                                                                            us!</p>
                                                                                    </td>
                                                                                </tr>
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

        <table cellpadding="0" cellspacing="0" class="es-footer" align="center">
            <tbody>
                <tr>
                    <td class="esd-stripe" esd-custom-block-id="6342" align="center">
                        <table class="es-footer-body" width="600" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-structure es-p30t es-p30b es-p30r es-p30l" align="left">
                                        <table width="100%" cellspacing="0" cellpadding="0">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-container-frame" width="540" valign="top"
                                                        align="center">
                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                            <tbody>

                                                                <tr>
                                                                    <td align="left" class="esd-block-text es-p25t">
                                                                        <p>You received this email
                                                                            because you have made an
                                                                            order in our company!</p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" class="esd-block-text es-p25t">
                                                                        <p>Ignore this message if your
                                                                            order has been cancelled!
                                                                        </p>
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
                    </td>
                </tr>
            </tbody>
        </table>

        </td>
        </tr>
        </tbody>
        </table>
    </div>

</body>



</html>

