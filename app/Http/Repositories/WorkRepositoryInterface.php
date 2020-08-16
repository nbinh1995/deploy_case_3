<?php

namespace App\Http\Repositories;

interface WorkRepositoryInterface extends RepositoryInterface
{
    public function isHotWorks($num);
    public function search($data, $amount);
}
