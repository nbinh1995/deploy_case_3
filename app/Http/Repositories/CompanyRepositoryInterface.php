<?php

namespace App\Http\Repositories;

interface CompanyRepositoryInterface extends RepositoryInterface
{
    public function isHotCompanies($num);
    public function active();
    public function no_active();
}
