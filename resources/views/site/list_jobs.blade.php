@extends('layouts.app')

@section('title','List Jobs Page')

@section('search')
@include('partials.search')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>{{$works->total()}} Việc Làm Cho Bạn</h3>
            <hr>
        </div>
        <div class="col-md-8 mt-3">
            @forelse ($works as $item)
            <div class="mb-5 shadow-sm bg-white cursor">
                <a href="{{ route('jobs.show',['work'=> $item]) }}">
                    <div class="media">
                        <div class="box-company">
                            <img src="{{$item->company->logo}}" class="align-self-start mr-3"
                                style="width:100px; height:100px">
                        </div>
                        <div class="media-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-12 text-primary">
                                                <h5 class="text-uppercase">{{$item->title}}</h5>
                                            </div>
                                            <div class="col-md-12">
                                                <i class="far fa-building"></i> {{$item->company->c_name}}
                                            </div>
                                            <div class="col-md-12">
                                                <i class="fas fa-map-marker-alt"></i> {{$item->company->address}}
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
                                            @if ($item->status == 0)
                                            <div class="col-md-12"><i class="fas fa-dollar-sign"></i>
                                                {{$item->salary_number($item->salary_min)}} -
                                                {{$item->salary_number($item->salary_max)}}
                                            </div>
                                            @else
                                            <div class="col-md-12"><i class="fas fa-dollar-sign"></i>
                                                {{__('Thương Lượng')}}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @empty

            @endforelse
        </div>
        <div class="col-md-3 mt-3">
            <div class="card">
                <div class="card-header"><i class="fas fa-search"></i> Tìm Kiếm Nâng Cao</div>
                <div class="card-body">Content</div>
                <div class="card-footer"><button class="btn btn-primary w-100">Tìm Kiếm</button></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row justify-content-center">
                {{ $works->appends(request()->query()) }}
            </div>
        </div>
    </div>
</div>

@endsection