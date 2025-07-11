<?php

namespace App\Enums;

enum GroupType
{
    use EnumToArray;

    case Team;
    case Club;
    case Company;
    case Unknown;
}
