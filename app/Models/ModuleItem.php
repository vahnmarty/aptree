<?php

namespace App\Models;

use Storage;
use App\Enums\ModuleItemType;
use Spatie\EloquentSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\SortableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModuleItem extends Model implements Sortable
{
    use SortableTrait;
    use HasFactory;

    protected $casts = [
        'type' => ModuleItemType::class,
        'video_response' => 'array'
    ];

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    protected $guarded = [];

    public function getImage()
    {
        return Storage::disk('do')->url($this->image);
    }

    public function question()
    {
        return $this->hasOne(Question::class);
    }
}
