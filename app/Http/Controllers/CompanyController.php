<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Repositories\CompanyRepositoryInterface;
use App\Http\Requests\CompanyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{

    protected $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->middleware('verified');
        $this->companyRepository = $companyRepository;
    }

    public function candidates(Company $company)
    {
        if (Auth::user()->id == $company->user_id) {
            return view('site.candidates', compact('company'));
        } else return redirect()->route('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        if (Auth::user()->id == $company->user_id) {
            return view('site.single_company', compact('company'));
        } else return redirect()->route('companies.show', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $data = $this->companyRepository->update($company, $request);
        $job_company = view('partials.job_company', ['company' => $data])->render();
        $image_company = view('partials.image_company', ['company' => $data])->render();
        $info_company = view('partials.info_company', ['company' => $data])->render();
        return response()->json([
            'code' => 200,
            'image_company' => $image_company,
            'info_company' => $info_company,
            'job_company' => $job_company
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
