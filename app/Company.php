<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function works()
    {
        return $this->hasMany(Work::class, 'company_id', 'id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($company) { // before delete() method call this
            foreach ($company->works() as $item) {
                $item->delete;
            }
        });
    }
}
