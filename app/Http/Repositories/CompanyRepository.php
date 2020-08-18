<?php

namespace App\Http\Repositories;

use Illuminate\Support\Str;
use App\Company;

class CompanyRepository extends EloquentRepository implements CompanyRepositoryInterface

{

    public function __construct(Company $model)
    {
        parent::__construct($model);
    }

    public function active()
    {
        return $this->model->orderBy('created_at', 'desc')->where('active', 'ACTIVE')->get();
    }

    public function no_active()
    {
        return $this->model->orderBy('created_at', 'desc')->where('active', 'NO_ACTIVE')->get();
    }

    public function paginate($amount)
    {
        return $this->model::with('works:company_id')->paginate($amount);
    }

    public function isHotCompanies($num)
    {
        return $this->model::where('hot', 1)->take($num)->get();
    }

    public function isActive($num)
    {
        return $this->model::where('active', 0)->take($num)->get();
    }

    public function update($id, $data)
    {
        $id->update($data->except('logo', 'cover_photo'));
        $id->slug = Str::slug($data->c_name);
        if ($data->hasFile('logo') && $data->file('logo')->isValid()) {
            if ($id->logo != '/images/noimage.png') {
                unlink(public_path($id->logo));
            }
            $imagePath = $data->file('logo');
            $imageName = substr(md5(time()), 0, 10) . '1.' . $imagePath->getClientOriginalExtension();
            $path = $imagePath->move('avatars', $imageName)->getPathname();
            // $path = $imagePath->store('avatar', 'public');
            // $id->logo = '/storage/' . $path;
            $id->logo = '/' . $path;
        }

        if ($data->hasFile('cover_photo') && $data->file('cover_photo')->isValid()) {
            if ($id->cover_photo != '/images/default-banner.jpg') {
                unlink(public_path($id->cover_photo));
            }
            $imagePath = $data->file('cover_photo');
            $imageName = substr(md5(time()), 0, 10) . '2.' . $imagePath->getClientOriginalExtension();
            // $path = $imagePath->store('cover', 'public');
            $path = $imagePath->move('covers', $imageName)->getPathname();
            // $id->cover_photo = '/storage/' . $path;
            $id->cover_photo = '/' . $path;
        }
        $id->save();
        return $id;
    }
}
