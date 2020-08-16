<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Repositories\CompanyRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Repositories\WorkRepositoryInterface;
use App\Work;

class HomeController extends Controller
{
    const AmountWorks = 6;
    const AmountCompanies = 8;

    protected $workRepository;
    protected $companyRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        WorkRepositoryInterface $workRepository,
        CompanyRepositoryInterface $companyRepository
    ) {
        $this->workRepository = $workRepository;
        $this->companyRepository = $companyRepository;
    }

    public function index()
    {
        $works = $this->workRepository->isHotWorks(4);
        $companies = $this->companyRepository->isHotCompanies(5);

        return view('home', compact('works', 'companies'));
    }

    public function search(Request $request)
    {
        $works = $this->workRepository->search($request->search, self::AmountWorks);
        if ($works) {
            return view('site.list_jobs', compact('works'));
        } else {
            return redirect('/jobs');
        }
    }

    public function jobs()
    {
        $works = $this->workRepository->paginate(self::AmountWorks);

        return view('site.list_jobs', compact('works'));
    }

    public function companies()
    {
        $companies = $this->companyRepository->paginate(self::AmountCompanies);

        return view('site.list_companies', compact('companies'));
    }

    public function showCompany(Company $company)
    {
        return view('site.single_company', compact('company'));
    }

    public function showJob(Work $work)
    {
        return view('site.single_job', compact('work'));
    }
}
