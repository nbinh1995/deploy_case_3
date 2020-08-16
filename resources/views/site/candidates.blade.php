@extends('layouts.app')

@section('title','List Candidates Page')

@section('search')
<div class="row pt-1s" id="image-company">
    @include('partials.image_company')
</div>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row shadow-sm justify-content-center" style="background-color: #f8f9fa">
        @forelse ($company->works as $item)
        <div class="col-md-10 cursor bg-white">
            <div class="media">
                <div class="box-company">
                    <img src="{{$company->logo}}" class="align-self-start mr-3" style="width:100px;height:100px">
                </div>
                <div class="media-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="text-uppercase">{{$item->title}}
                                        </h5>
                                    </div>
                                    <div class="col-md-12">
                                        <i class="far fa-building"></i>
                                        {{$company->c_name}}
                                    </div>
                                    <div class="col-md-12">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{$company->address}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row justify-content-end align-items-center">
                                    <div class="col-md-12 mb-2">
                                        <span
                                            class='create-box'>{{$item->created_at->locale('vi')->diffForHumans()}}</span>
                                    </div>
                                    <div class="col-md-12">
                                        <i class="far fa-calendar-alt"></i>
                                        {{date('d/m/Y', strtotime($item->last_date))}}
                                    </div>
                                    <div class="col-md-12"><i class="fas fa-briefcase"></i> {{$item->position}}
                                    </div>
                                    <div class="col-md-12">Ứng viên: {{$item->applicants->count()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10 bg-white mb-5">
            <hr>
            @forelse ($item->applicants as $key => $it)
            <a href="{{route('profiles.show',['profile'=> $it->profile])}}">
                <h6>Ứng cử viên {{$key+1}}: {{$it->profile->name}}</h6>
            </a>

            @empty
            <h6>Không có ứng cử viên</h6>
            @endforelse
            <hr>
        </div>
        @empty

        @endforelse
    </div>
</div>
@endsection