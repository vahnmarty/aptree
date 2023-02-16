<?php

namespace App\Models;

use App\Enums\ModuleItemType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Storage;

class ModuleItem extends Model
{
    use HasFactory;

    protected $casts = [
        'type' => ModuleItemType::class,
        'video_response' => 'array'
    ];

    protected $guarded = [];

    public function getImage()
    {
        return Storage::disk('do')->url($this->image);
    }
}
