@extends('layouts.mail')

@section('title', 'Код для авторизации')

@section('content')
    <table cellpadding="0" cellspacing="0" style="width:100%">
        <tr align="center">
            <td style="color: rgb(48, 113, 231);font-size:24px;font-weight:700;padding:0 0 20px 0">
                Приветствуем!
            </td>
        </tr>
        {{-- <tr align="center">
            <td style="color:rgb(23, 23, 23);padding:0 0 32px 0">Ваш код</td>
        </tr> --}}
        <tr>
            <td>
                <x-table-item name="Код"> {{ $code }}</x-table-item>
            </td>
        </tr>
    </table>
@endsection
