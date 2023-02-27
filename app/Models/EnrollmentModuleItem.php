<?php

namespace App\Models;

use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EnrollmentModuleItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function moduleItem()
    {
        return $this->belongsTo(ModuleItem::class);
    }

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
}
