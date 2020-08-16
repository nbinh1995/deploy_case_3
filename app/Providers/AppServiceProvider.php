<?php

namespace App\Providers;

use App\Category;
use App\Http\Repositories\CompanyRepository;
use App\Http\Repositories\CompanyRepositoryInterface;
use App\Http\Repositories\ProfileRepository;
use App\Http\Repositories\ProfileRepositoryInterface;
use App\Http\Repositories\UserRepository;
use App\Http\Repositories\UserRepositoryInterface;
use App\Http\Repositories\WorkRepository;
use App\Http\Repositories\WorkRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
        $this->app->singleton(ProfileRepositoryInterface::class, ProfileRepository::class);
        $this->app->singleton(WorkRepositoryInterface::class, WorkRepository::class);
        $this->app->singleton(CompanyRepositoryInterface::class, CompanyRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('category', Category::all());
    }
}
