<?php

namespace App\Models;

use App\Enums\ModuleItemType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModuleItem extends Model
{
    use HasFactory;

    protected $casts = [
        'type' => ModuleItemType::class,
    ];

    protected $guarded = [];
}
