<?php

namespace App;

enum EnumsScope: string
{
    case USER = "user";
    case ADMIN = "admin";
    case ROOT = "root";
}
