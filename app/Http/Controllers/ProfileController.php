<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Http\Repositories\ProfileRepositoryInterface;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $profileRepository;

    public function __construct(ProfileRepositoryInterface $profileRepository)
    {
        $this->middleware('verified');
        $this->profileRepository = $profileRepository;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        if (Auth::user()->role == 1 || Auth::user()->role == 2) {
            return view('site.profile', compact('profile'));
        } else redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function apply(Request $request)
    {
        if (Auth::user()->role == 0) {
            Applicant::create($request->all());
            return response()->json(['code' => 200], 200);
        } else return response()->json(['code' => 403], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        if (Auth::user()->id == $profile->user_id) {
            return view('site.profile', compact('profile'));
        } else return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        if (Auth::user()->id == $profile->user_id) {
            $data = $this->profileRepository->update($profile, $request);
            $info_profile = view('partials.info_profile', ['profile' => $data])->render();
            return response()->json([
                'code' => 200,
                'info_profile' => $info_profile
            ], 200);
        } else return response()->json([
            'code' => 403,
            'message' => 'No Auth'
        ], 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
