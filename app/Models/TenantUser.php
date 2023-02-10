<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TenantUser extends Model
{
    protected $guard_name = 'web';
    
    use HasFactory;

    use HasRoles;
}
