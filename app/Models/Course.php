<?php

namespace App\Models;

use Spatie\Tags\HasTags;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    use HasTags;

    protected $guarded = [];

    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
