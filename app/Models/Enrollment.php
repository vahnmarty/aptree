<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrollment extends Model
{
    use HasFactory;

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function items()
    {
        return $this->belongsToMany(ModuleItem::class, 'enrollment_module_items');
    }
}
