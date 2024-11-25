<?php

namespace App\Enum;

enum UserRole: string
{
    case admin = "admin";
    case owner = "owner";
    case client = "client";
}
