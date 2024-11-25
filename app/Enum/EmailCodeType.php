<?php

namespace App\Enum;

enum EmailCodeType: string
{
    case login = "login";
    case register = "register";
    case update_email = "update_email";
}
