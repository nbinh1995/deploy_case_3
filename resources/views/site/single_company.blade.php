@extends('layouts.app')

@section('title','Company Page')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
    integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
    crossorigin="anonymous" />
@endpush

@section('search')
<div class="row pt-1s" id="image-company">
    @include('partials.image_company')
</div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs row">
                        <li class="nav-item col-md-6">
                            <a class="nav-link active" data-toggle="tab" href="#menu1">Thông Tin Công Ty</a>
                        </li>
                        <li class="nav-item col-md-6">
                            <a class="nav-link" data-toggle="tab" href="#menu2">
                                <span id="count_work">{{$company->works->count()}}</span> Công Việc</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="menu1">
                        @include('partials.info_company')
                    </div>
                    <div class="tab-pane fade bg-light" id="menu2">
                        <div class="card-body" id="job_company">
                            @include('partials.job_company')
                        </div>
                        @auth
                        @if(Auth::user()->id == $company->user_id)
                        <div class="card-footer">
                            <div class="row justify-content-end">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-info" data-urln="{{ route('jobs.store')}}"
                                    data-active="{{$company->active}}" onclick="work.create(this)"><i
                                        class="fas fa-cloud-upload-alt"></i> Đăng Tuyển Dụng
                                </button>
                            </div>
                            <!-- Modal add -->
                            <div class="modal fade" id="WorksModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="" onsubmit="event.preventDefault();work.save(this)" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-body">
                                                <input type="hidden" name="company_id" value="{{$company->id}}">
                                                <div class="form-group">
                                                    <select class="custom-select" name='category_id' id="category_id">
                                                        <option selected disabled value="">Loại việc làm...</option>
                                                        @foreach ($category as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger" role="alert">
                                                        <strong id="err-category-id"></strong>
                                                    </span>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label for="type">Thể Loại</label>
                                                        <select class="custom-select" name='type' id="type">
                                                            <option value="FullTime">FullTime</option>
                                                            <option value="PartTime">PartTime</option>
                                                        </select>
                                                        <span class="text-danger" role="alert">
                                                            <strong id="err-type"></strong>
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="last_date">Ngày Hết Hạn</label>
                                                        <input type="date" class="form-control" name="last_date"
                                                            id="last_date">
                                                        <span class="text-danger" role="alert">
                                                            <strong id="err-last-date"></strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="title">Tiêu đề</label>
                                                    <input type="text" class="form-control" name="title" id="title"
                                                        placeholder="Tiêu đề công việc...">
                                                    <span class="text-danger" role="alert">
                                                        <strong id="err-title"></strong>
                                                    </span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="position">Vị trí tuyển dụng</label>
                                                    <input type="text" class="form-control" name="position"
                                                        id="position" placeholder="Vị trí tuyển dụng...">
                                                    <span class="text-danger" role="alert">
                                                        <strong id="err-position"></strong>
                                                    </span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description-job">Mô tả công việc</label>
                                                    <textarea class="form-control" name="description"
                                                        id="description-job"
                                                        placeholder="Mô tả công việc..."></textarea>
                                                    <span class="text-danger" role="alert">
                                                        <strong id="err-desc-job"></strong>
                                                    </span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="benefit">Quyền Lợi Được Hưởng</label>
                                                    <textarea class="form-control" name="benefit" id="benefit"
                                                        placeholder="Quyền lợi công việc..."></textarea>
                                                    <span class="text-danger" role="alert">
                                                        <strong id="err-benefit"></strong>
                                                    </span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="require">Yêu Cầu Công Việc</label>
                                                    <textarea class="form-control" name="require" id="require"
                                                        placeholder="Yêu cầu công việc..."></textarea>
                                                    <span class="text-danger" role="alert">
                                                        <strong id="err-require"></strong>
                                                    </span>
                                                </div>
                                                <div class="form-group row align-items-md-end">
                                                    <div class="col-md-4">
                                                        <label for="salary_min">Mức Lương Thấp Nhất</label>
                                                        <input type="number" class="form-control" name="salary_min"
                                                            id="salary_min" placeholder="Min... VND" min="100000">
                                                        <span class="text-danger" role="alert">
                                                            <strong id="err-salary-min"></strong>
                                                        </span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="salary_max">Mức Lương Cao Nhất</label>
                                                        <input type="number" class="form-control" name="salary_max"
                                                            id="salary_max" placeholder="Max... VND" min="100000">
                                                        <span class="text-danger" role="alert">
                                                            <strong id="err-salary-max"></strong>
                                                        </span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                name="status" id="status" onchange="checkStatus()">
                                                            <label class="custom-control-label" for="status">Thương
                                                                Lượng</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <label for="contact_name">Tên Người Liên Hệ</label>
                                                        <input type="text" class="form-control" name="contact_name"
                                                            id="contact_name">
                                                        <span class="text-danger" role="alert">
                                                            <strong id="err-contact-name"></strong>
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="contact_phone">Điện Thoại</label>
                                                        <input type="tel" class="form-control" name="contact_phone"
                                                            id="contact_phone" placeholder="số điện thoại ...">
                                                        <span class='text-danger' role="alert">
                                                            <strong id="err-contact-phone"></strong>
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="contact_email">Email</label>
                                                        <input type="email" class="form-control" name="contact_email"
                                                            id="contact_email" placeholder="Email...">
                                                        <span class="text-danger" role="alert">
                                                            <strong id="err-contact-email"></strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Không</button>
                                                <button type="submit" class="btn btn-primary">Lưu</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endauth
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"
    integrity="sha512-8vfyGnaOX2EeMypNMptU+MwwK206Jk1I/tMQV4NkhOz+W8glENoMhGyU6n/6VgQUhQcJH8NqQgHhMtZjJJBv3A=="
    crossorigin="anonymous"></script>
<script src="{{ asset('js/company.js')}}"></script>
<script src="{{ asset('js/work.js')}}"></script>
@endpush