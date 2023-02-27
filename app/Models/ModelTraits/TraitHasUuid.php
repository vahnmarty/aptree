<?php

namespace App\Models\ModelTraits;
use Str;

trait TraitHasUuid{

    public static function boot()
    {
        parent::boot();
        
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}