<?php

namespace App\Http\Repositories;

interface RepositoryInterface
{
    public function all();
    public function paginate($amount);
    public function find($id);
    public function store($data);
    public function update($id, $data);
    public function destroy($id);
}
