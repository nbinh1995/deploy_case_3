<?php

namespace App\Http\Repositories;

use App\Profile;

class ProfileRepository extends EloquentRepository implements ProfileRepositoryInterface

{
    protected $model;

    public function __construct(Profile $model)
    {
        parent::__construct($model);
    }

    public function update($id, $data)
    {
        $id->update($data->except('resume', 'cover_letter', 'avatar'));

        if ($data->hasFile('avatar') && $data->file('avatar')->isValid()) {
            if ($id->avatar) {
                unlink(public_path($id->avatar));
            }
            $imagePath = $data->file('avatar');
            $path = $imagePath->store('avatar', 'public');
            $id->avatar = '/storage/' . $path;
        }

        if ($data->hasFile('resume') && $data->file('resume')->isValid()) {
            if ($id->resume) {
                unlink(public_path($id->resume));
            }
            $imagePath = $data->file('resume');
            $path = $imagePath->store('uploads', 'public');
            $id->resume = '/storage/' . $path;
        }

        if ($data->hasFile('cover_letter') && $data->file('cover_letter')->isValid()) {
            if ($id->cover_letter) {
                unlink(public_path($id->cover_letter));
            }
            $imagePath = $data->file('cover_letter');
            $path = $imagePath->store('uploads', 'public');
            $id->cover_letter = '/storage/' . $path;
        }

        $id->save();
        return $id;
    }
}
