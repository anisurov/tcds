<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.=
w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns=3D"http://www.w3.org/1999/xhtml">
<head>
    <meta name=3D"viewport" content=3D"width=3Ddevice-width, initial-scale=3D1.=
          0
    ">
    <meta http-equiv=3D"Content-Type" content=3D"text/html; charset=3DUTF-8">
</head>
<body style=3D"font-family: Avenir, Helvetica, sans-serif; box-sizing: bord=
er-box; background-color: #f5f8fa; color: #74787E; height: 100%; hyphens: a=
      uto; line-height: 1.4; margin: 0; -moz-hyphens: auto; -ms-word-break: break=
      -all; width: 100% !important; -webkit-hyphens: auto; -webkit-text-size-adju=
      st: none; word-break: break-word;
">
<table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#F0F0F0">
    <tbody>
    <tr>
        <td style="background-color: #ffffff;" align="center" valign="top" bgcolor="#ffffff"><br/>
            <table style="width: 100%; max-width: 600px;" border="0" width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td height="30"></td>
                </tr>
                <tr>
                    <td height="20"></td>
                </tr>
                <tr>
                    <td>
                        <p style="text-align: center; margin: 4px; font-family: Helvetica, Arial, sans-serif; font-size: 26px; color: #222222;">
                            Welcome to <b>{{config('app.name')}}</b>
                        <hr>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #ffffff; padding: 12px 24px 12px 24px;" align="left"><br/>
                        <p style="font-family: Helvetica, Arial, sans-serif; font-size: 15px; font-weight: 600; color: #374550;">
                            Respected,Sir</p>
                        <p style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; text-align: left; color: #222222;">
                            Your registration on <b> {{config('app.name')}}</b> was successful.<br>
                            Here is your credintials. Please keep them in a
                            safe place: </p>
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #ffffff; padding: 12px 24px 12px 24px;" align="left">
                        <p style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; text-align: left; color: #222222;">
                            <b>Username/Email:</b>{{$title}}<br>
                            <b>Password:</b>{{$content}}<br></p>
                    </td>
                </tr>
                <tr>
                    <td height="65"></td>
                </tr>
                <tr>
                    <td align="center">
                        <table>
                            <tbody>
                            <tr>
                                <td style="background: #289CDC; padding: 15px 18px; -webkit-border-radius: 4px; border-radius: 4px; font-family: Helvetica, Arial, sans-serif;"
                                    align="center" bgcolor="#289CDC"><a target="_blank" href="{{config('app.url')}}/login"
                                                                        style="color: #ffffff; text-decoration: none; font-size: 16px;">Login</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="65"></td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #DDDDDD;"></td>
                </tr>
                <tr>
                    <td height="25"></td>
                </tr>
                <tr>
                    <td style="text-align: center;" align="center">
                        <table border="0" width="95%" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                            <tr>
                                <td style="font-family: Helvetica, Arial, sans-serif;" align="left" valign="top">
                                    <p style="text-align: left; color: #999999; font-size: 12px; font-weight: normal; line-height: 20px;">
                                        This email is sent to you directly from <a href="http://localhost">{{config('app.name')}}</a>
                                        The information above is gathered from the user input. <br/>&copy;{{date('y')}} <a
                                                href="{{config('app.url')}}">{{config('app.name')}}</a>. All rights reserved.</p>
                                </td>
                                <td width="30"></td>
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
