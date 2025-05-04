<?php

namespace App\Enum;

enum ClinicWorkerRole: string
{
    case owner = "owner";
    case provider = "provider";
    case specialist = "specialist";
}
