<?php

namespace App\Auth\Heleum;

use Illuminate\Database\Eloquent\Model;

use App\Auth\Heleum\Authenticatable;
use App\Auth\Heleum\Authorizable;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

// use Illuminate\Auth\Passwords\CanResetPassword;
// use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract
{
    use Authenticatable, Authorizable;
}
