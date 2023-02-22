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

    public function category()
    {
        return tenancy()->central(function(){
            return $this->belongsTo(CourseCategory::class);
        });
    }

    public function subcategories()
    {
        return $this->belongsToMany(CourseSubcategory::class, 'course_subcategory');
        
        return tenancy()->central(function(){
            
        });
    }

    public function instructors()
    {
        return $this->belongsToMany(User::class, 'course_instructors');
    }
}
