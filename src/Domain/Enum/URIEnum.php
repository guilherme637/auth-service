<?php

namespace App\Domain\Enum;

enum URIEnum: string
{
    case LOGIN = '/login?response_type=%s&client_id=%s&redirect_uri=%s&scope=%s&state=%s';
    case CHECK = '?state=%s&code=%s';
}
