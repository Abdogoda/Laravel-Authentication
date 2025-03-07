<?php

namespace App\Enums;

enum TokenAbility: string
{
    case ACCESS_API = 'access_api';
    case ISSUE_ACCESS_TOKEN = 'issue_access_token';
}
