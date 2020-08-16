<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CompanyRepositoryInterface;
use App\Http\Repositories\WorkRepositoryInterface;
use App\Http\Requests\WorkRequest;
use App\Work;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    protected $workRepository;
    protected $companyRepository;

    public function __construct(WorkRepositoryInterface $workRepository, CompanyRepositoryInterface $companyRepository)
    {
        $this->middleware('verified');
        $this->workRepository = $workRepository;
        $this->companyRepository = $companyRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkRequest $request)
    {
        try {
            $this->workRepository->store($request);
            $company = $this->companyRepository->find($request->company_id);
            $count = $company->works->count();

            $job_company = view('partials.job_company', compact('company'))->render();

            return response()->json(['code' => 200, 'job_company' => $job_company, 'count' => $count], 200);
        } catch (\Throwable $th) {
            return response()->json("lỗi");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function show(Work $job)
    {
        return view('site.single_job');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function edit(Work $work)
    {
        
        return response()->json(['code' => 200, 'work' => $work], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Work $work)
    {
        try {
            $this->workRepository->update($work->id, $request->all());
            $company = $this->companyRepository->find($work->company_id);

            $job_company = view('partials.job_company', compact('company'))->render();

            return response()->json(['code' => 200, 'job_company' => $job_company], 200);
        } catch (\Throwable $th) {
            return response()->json("lỗi");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function destroy(Work $work)
    {
        $this->workRepository->destroy($work->id);
        $company = $this->companyRepository->find($work->company_id);
        $count = $company->works->count();

        $job_company = view('partials.job_company', compact('company'))->render();

        return response()->json(['code' => 200, 'job_company' => $job_company,  'count' => $count], 200);
    }
}
