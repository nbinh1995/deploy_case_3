<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Repositories\CompanyRepositoryInterface;
use App\Http\Repositories\ProfileRepositoryInterface;
use App\Http\Repositories\WorkRepositoryInterface;
use App\Http\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $userRepository;
    protected $workRepository;
    protected $companyRepository;
    protected $profileRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        WorkRepositoryInterface $workRepository,
        CompanyRepositoryInterface $companyRepository,
        ProfileRepositoryInterface $profileRepository
    ) {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
        $this->workRepository = $workRepository;
        $this->companyRepository = $companyRepository;
        $this->profileRepository = $profileRepository;
    }

    public function index()
    {
        if (Auth::user()->role == 2) {
            $user_count = $this->userRepository->all()->count();
            $work_count = $this->workRepository->all()->count();
            $company_count = $this->companyRepository->all()->count();
            $profile_count = $this->profileRepository->all()->count();
            return view('dashboard', compact('user_count', 'work_count', 'company_count', 'profile_count'));
        } else {
            return redirect()->route('home');
        }
    }

    public function users()
    {
        if (Auth::user()->role == 2) {
            $user_count = $this->userRepository->all()->count();
            $work_count = $this->workRepository->all()->count();
            $company_count = $this->companyRepository->all()->count();
            $profile_count = $this->profileRepository->all()->count();
            return view('admin.users_admin', compact('user_count', 'work_count', 'company_count', 'profile_count'));
        } else {
            return redirect()->route('home');
        }
    }
    public function jobs()
    {
        if (Auth::user()->role == 2) {
            $user_count = $this->userRepository->all()->count();
            $work_count = $this->workRepository->all()->count();
            $company_count = $this->companyRepository->all()->count();
            $profile_count = $this->profileRepository->all()->count();
            return view('admin.jobs_admin', compact('user_count', 'work_count', 'company_count', 'profile_count'));
        } else {
            return redirect()->route('home');
        }
    }
    public function companies()
    {
        if (Auth::user()->role == 2) {
            $user_count = $this->userRepository->all()->count();
            $work_count = $this->workRepository->all()->count();
            $company_count = $this->companyRepository->all()->count();
            $profile_count = $this->profileRepository->all()->count();
            return view('admin.companies_admin', compact('user_count', 'work_count', 'company_count', 'profile_count'));
        } else {
            return redirect()->route('home');
        }
    }

    public function users_candidates()
    {
        if (Auth::user()->role == 2) {
            $profile = $this->profileRepository->all();
            return response()->json(['code' => 200, 'candidates' => $profile], 200);
        } else {
            return response()->json(['code' => 403], 200);
        }
    }

    public function users_companies()
    {
        if (Auth::user()->role == 2) {
            $companies = $this->companyRepository->active();
            return response()->json(['code' => 200, 'companies' => $companies], 200);
        } else {
            return response()->json(['code' => 403], 200);
        }
    }

    public function companies_noAct()
    {
        if (Auth::user()->role == 2) {
            $companies = $this->companyRepository->no_active();
            return response()->json(['code' => 200, 'companies' => $companies], 200);
        } else {
            return response()->json(['code' => 403], 200);
        }
    }

    public function active($id)
    {
        if (Auth::user()->role == 2) {
            $company = $this->companyRepository->find($id);
            $company->active = 'ACTIVE';
            $company->save();
            return response()->json(['code' => 200], 200);
        } else {
            return response()->json(['code' => 403], 200);
        }
    }

    public function hot_company($id)
    {
        if (Auth::user()->role == 2) {
            $company = $this->companyRepository->find($id);
            if ($company->hot) {
                $company->hot = 0;
            } else {
                $company->hot = 1;
            }

            $company->save();

            return response()->json(['code' => 200], 200);
        } else {
            return response()->json(['code' => 403], 200);
        }
    }

    public function destroy_users_companies($id)
    {
        if (Auth::user()->role == 2) {
            $this->companyRepository->destroy($id);
            return response()->json(['code' => 200], 200);
        } else {
            return response()->json(['code' => 403], 200);
        }
    }

    public function destroy_users_candidates($id)
    {
        if (Auth::user()->role == 2) {
            $this->profileRepository->destroy($id);
            return response()->json(['code' => 200], 200);
        } else {
            return response()->json(['code' => 403], 200);
        }
    }

    public function job_api()
    {
        if (Auth::user()->role == 2) {
            $works = $this->workRepository->all();
            return response()->json(['code' => 200, 'jobs' => $works], 200);
        } else {
            return response()->json(['code' => 403], 200);
        }
    }

    public function job_api_hot($id)
    {
        if (Auth::user()->role == 2) {
            $work = $this->workRepository->find($id);
            if ($work->hot) {
                $work->hot = 0;
            } else {
                $work->hot = 1;
            }

            $work->save();

            return response()->json(['code' => 200], 200);
        } else {
            return response()->json(['code' => 403], 200);
        }
    }
}
