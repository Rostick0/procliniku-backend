<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title')</title>
    <style>
        body {
            width: 100% !important;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
            line-height: 100%;
        }

        [style*="Arial"] {
            font-family: Arial, sans-serif !important;
        }

        table td {
            border-collapse: collapse;
        }

        table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
    </style>
</head>

<body width="100%" style="color:#1D1B20;margin:0;padding:0">
    <div style="font-size:0px;font-color:#ffffff;opacity:0;visibility:hidden;width:0;height:0;display:none;">
        @yield('title')
    </div>
    <table cellpadding="0" cellspacing="0" style="font-family:Arial,Helvetica,sans-serif;font-size:16px;width:100%">
        <tr>
            <td style="padding:0 20px 0 20px">
                <table cellpadding="0" cellspacing="0" style="width:100%">
                    <tr align="center">
                        <td style="color:rgb(48, 113, 231);font-size:32px;font-weight:600;letter-spacing:0.5px;">
                            JShoP
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:28px 0 20px 0">
                            <table cellpadding="0" cellspacing="0" style="width:100%">
                                @yield('content')
                            </table>
                        </td>
                    </tr>
                    {{-- @if (!isset($footer_none))
                            <tr>
                                <td
                                    style="border-top:0.5px solid #d1d1d1;color:#d1d1d1;font-size:12px;padding:16px 0 48px 0;">
                                    Please note that as per our Terms Driver's original
                                    documents shall be provided at the time
                                    of rental. Valid Credit card under the drivers name shall be presented at the time of
                                    rental. Online payments shall be done by Credit Card under drivers name only.</td>
                            </tr>
                        @endif --}}
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
