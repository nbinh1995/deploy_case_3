<?php

namespace App\Http\Repositories;

use App\User;

class UserRepository extends EloquentRepository implements UserRepositoryInterface

{

    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
