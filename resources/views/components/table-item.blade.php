@props(['name'])

<table align="center" cellpadding="0" cellspacing="0" style="width:342px">
    <tr>
        <td style="padding:0 12px 0 0;width:80px">{{ $name }}</td>
        <td style="font-size:20px;font-weight:700">{{ $slot }}</td>
    </tr>
</table>
