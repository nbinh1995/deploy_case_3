@extends('layouts.app')

@section('title','List Companies Page')

@section('search')
@include('partials.search')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @forelse ($companies as $item)
        <div class="col-md-3 mb-5">
            <div class="card cursor">
                <a href="{{route('companies.show',['company'=>$item])}}">
                    <div class="box-company">
                        <img src="{{$item->cover_photo}}" class="card-img-top" alt="...">
                        <div class="logo-company shadow-sm bg-white">
                            <img src="{{$item->logo}}" alt="" style="width:60px; height:60px">
                        </div>
                    </div>
                    <div class="card-body body-company">
                        <h5 class="card-title text-center">{{$item->c_name}}</h5>
                        <p class="font-italic"><i class="fas fa-map-marker-alt"></i> {{$item->address}}</p>
                        <p class="card-text line-clamp">{{$item->description}}</p>
                    </div>
                    <div class="card-footer text-center">
                        <small class="text-primary">{{$item->works->count()}} việc làm đang tuyển</small>
                    </div>
                </a>
            </div>
        </div>
        @empty

        @endforelse
        <div class="col-md-12 row justify-content-center">
            {{ $companies->appends(request()->query()) }}
        </div>
    </div>
</div>
@endsection