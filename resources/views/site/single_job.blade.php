@extends('layouts.app')

@section('title','Job Page')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
    integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
    crossorigin="anonymous" />
@endpush

@section('search')
<div class="container">
    <div class="row justify-content-center">
        <div class="media col-md-11">
            <img src="{{$work->company->logo}}" class=" align-self-center mr-3" alt="..."
                style="width:120px; height:120px">
            <div class="media-body row mt-2">
                <div class="col-md-8">
                    <h4 class="mt-0">{{$work->title}}</h4>
                    <h5 class="mt-0"><i class="far fa-building"></i> <span
                            class="text-primary">{{$work->company->c_name}}</span></h5>
                    <div class="mt-0"><i class="fas fa-map-marker-alt"></i> {{$work->company->address}}</div>
                    <div class="mt-0"><i class="fas fa-briefcase"></i> {{$work->position}}</div>
                    <div class="mt-0"><i class="fas fa-user-clock"></i> {{$work->type}}</div>
                </div>
                <div class="row col-md-4 align-items-end">
                    <div class="mr-1 col-md-12">
                        <span class='create-box'
                            style="color: white">{{$work->created_at->locale('vi')->diffForHumans()}}</span>
                    </div>
                    @if ($work->status == 0)
                    <div class="mr-1 col-md-12"><i class="fas fa-dollar-sign"></i>
                        {{$work->salary_number($work->salary_min)}} -
                        {{$work->salary_number($work->salary_max)}}
                    </div>
                    @else
                    <div class="mr-1 col-md-12"><i class="fas fa-dollar-sign"></i>
                        {{__('Thương Lượng')}}
                    </div>
                    @endif
                    <div class="col-md-12"><i class="far fa-calendar-alt"></i>
                        {{date('d/m/Y', strtotime($work->last_date))}}</div>
                    @auth
                    @if (Auth::user()->role == 0)
                    <div class="mt-1 mb-1 col-md-12">
                        <button type="button" class="btn btn-outline-danger" data-work="{{$work->id}}"
                            data-profile="{{Auth::user()->profile->id}}" data-url="{{ route('profiles.apply')}}"
                            onclick="apply(this)">Ứng Tuyển
                            Ngay</button>
                    </div>
                    @else
                    <button type="button" class="btn btn-outline-danger" disabled> Tài Khoản Không Thể Ứng
                        Tuyển</button>
                    @endif
                    @endauth
                    @guest
                    <button type="button" class="btn btn-outline-danger" disabled> Đăng Nhập Để Ứng Tuyển</button>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="card col-md-12">
            <div class="card-body row ">
                <div class="col-md-7">
                    <h5 class="col-md-12 mt-1 text-primary">MÔ TẢ CÔNG VIỆC</h5>
                    <hr>
                    <div class="col-md-12 text-muted">
                        <p>{{$work->description}}</p>
                    </div>
                    <h5 class="col-md-12 mt-1 text-primary">QUYỀN LỢI ĐƯỢC HƯỞNG</h5>
                    <hr>
                    <div class="col-md-12 text-muted">
                        <p>{{$work->benefit}}</p>
                    </div>
                    <h5 class="col-md-12 mt-1 text-primary">YÊU CẦU CÔNG VIỆC</h5>
                    <hr>
                    <div class="col-md-12 text-muted">
                        <p>{{$work->require}}</p>
                    </div>
                </div>
                <div class=" col-md-5">
                    <h5 class="col-md-12 mt-1 text-primary">THÔNG TIN LIÊN HỆ</h5>
                    <hr>
                    <div class="col-md-12">
                        <h6 class="mb-2 text-muted">Người liên hệ: <span>{{$work->contact_name}}</span></h6>
                        <h6 class="mb-2 text-muted">Email liên hệ: <span>{{$work->contact_email}}</span></h6>
                        <h6 class="mb-2 text-muted">Số điện thoại: <span>{{$work->contact_phone}}</span></h6>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous"></script>
@endpush