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
            if ($id->avatar != '/images/img.png') {
                unlink(public_path($id->avatar));
            }
            $imagePath = $data->file('avatar');
            $imageName = substr(md5(time()), 0, 10) . '1.' . $imagePath->getClientOriginalExtension();
            $path = $imagePath->move('avatars', $imageName)->getPathname();
            // $path = $imagePath->store('avatar', 'public');
            // $id->avatar = '/storage/' . $path;
            $id->avatar = '/' . $path;
        }

        if ($data->hasFile('resume') && $data->file('resume')->isValid()) {
            if ($id->resume != '/images/resume.pdf') {
                unlink(public_path($id->resume));
            }
            $imagePath = $data->file('resume');
            $imageName = substr(md5(time()), 0, 10) . '2.' . $imagePath->getClientOriginalExtension();
            $path = $imagePath->move('uploads', $imageName)->getPathname();
            // $path = $imagePath->store('uploads', 'public');
            // $id->resume = '/storage/' . $path;
            $id->resume = '/' . $path;
        }

        if ($data->hasFile('cover_letter') && $data->file('cover_letter')->isValid()) {
            if ($id->cover_letter != '/images/letter.pdf') {
                unlink(public_path($id->cover_letter));
            }
            $imagePath = $data->file('cover_letter');
            $imageName = substr(md5(time()), 0, 10) . '3.' . $imagePath->getClientOriginalExtension();
            $path = $imagePath->move('uploads', $imageName)->getPathname();
            // $path = $imagePath->store('uploads', 'public');
            // $id->cover_letter = '/storage/' . $path;
            $id->cover_letter = '/' . $path;
        }

        $id->save();
        return $id;
    }
}
