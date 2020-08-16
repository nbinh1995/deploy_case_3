<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    protected function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function applicants()
    {
        return $this->hasMany(Applicant::class, 'profile_id', 'id');
    }


    public static function boot()
    {
        parent::boot();

        static::deleting(function ($profile) { // before delete() method call this
            foreach ($profile->applicants() as $item) {
                $item->delete;
            }
        });
    }
}
