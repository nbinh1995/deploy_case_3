<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function works()
    {
        return $this->hasMany(Work::class, 'category_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($category) { // before delete() method call this
            $category->works()->delete;
        });
    }
}
