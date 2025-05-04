@extends('layouts.mail')

@section('title', 'Вы добавлены в качестве сотрудника')

@section('content')
    <table cellpadding="0" cellspacing="0" style="width:100%">
        <tr align="center">
            <td style="color: rgb(4, 110, 190);font-size:24px;font-weight:700;padding:0 0 20px 0">
                Добро пожаловать!
            </td>
        </tr>
        <tr>
            <td>
                <x-table-item name="Код">{{ $password }}</x-table-item>
            </td>
        </tr>
    </table>
@endsection
