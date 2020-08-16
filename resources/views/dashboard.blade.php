@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1 class="green">Welcome Great Job Dashboard</h1>
    </div>
    <div class="row">
        <div class="tile_count col-md-12 col-sm-12">
            <div class="col-md-3 col-sm-6  tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Tổng Số Tài Khoản</span>
                <div class="count">{{$user_count}}</div>
            </div>
            <div class="col-md-3 col-sm-6  tile_stats_count">
                <span class="count_top"><i class="fa fa-folder-open"></i> Tổng Số Công Việc</span>
                <div class="count green">{{$work_count}}</div>
            </div>
            <div class="col-md-3 col-sm-6  tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Tổng Số Tài Khoản Công Ty</span>
                <div class="count">{{$company_count}}</div>
            </div>
            <div class="col-md-3 col-sm-6  tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Tổng Số Tài Khoản Ứng Viên</span>
                <div class="count">{{$profile_count}}</div>
            </div>
        </div>
    </div>
</div>
@endsection