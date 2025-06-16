<?php

namespace App\Enums;

enum BranchUserRole: string
{
    case MEMBER = 'member';
    case ADMIN = 'admin';
    case MANAGER = 'manager';
}
