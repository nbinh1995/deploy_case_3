<div class="card-title mb-4">
    <div class="d-flex justify-content-start">
        <div class="image-container">
            <img src="{{$profile->avatar ?? 'http://placehold.it/150x150'}}" id="imgProfile"
                style="width: 150px; height: 150px" class="img-thumbnail" />
        </div>
        <div class="ml-3">
            <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold">
                {{$profile->name ?? '...Chưa Cập Nhật...'}}</h2>
            <h6 class="d-block"><i class="fas fa-venus-mars"></i><span class="text-muted">
                    {{$profile->gender ?? '...Chưa Cập Nhật...'}}</span>
            </h6>
            <h6 class="d-block"><i class="fas fa-birthday-cake"><span
                        class="text-muted">{{date('d/m/Y', strtotime($profile->birth)) ?? '...Chưa Cập Nhật...'}}</span></i>
            </h6>
            <h6 class="d-block"><i class="fas fa-map-marked-alt"></i>
                <span class="text-muted"> {{$profile->address ?? '...Chưa Cập Nhật...'}}</span>
            </h6>
        </div>
        @auth
        @if(Auth::user()->id == $profile->user_id)
        <div class="ml-auto">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#profileModal">
                Cập Nhật Thông Tin
            </button>
            <!-- Modal -->
            <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Thông Tin</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('profiles.update',['profile'=>$profile])}}" method="post"
                            onsubmit="event.preventDefault();profile.update(this)" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="modal-body">
                                <div class="form-group row align-items-end">
                                    <div class="col-md-3">
                                        <h5>Avatar</h5>
                                        <div class="image-container" style="width: 150px; height:150px">
                                            <img src="{{$profile->avatar ?? 'http://placehold.it/150x150'}}" alt=""
                                                id="imgAvatar" class="img img-thumbnail">
                                            <div class="middle">
                                                <label for="avatar" style="cursor: pointer"><span
                                                        class="btn btn-secondary"><i
                                                            class="fas fa-camera"></i></span></label>
                                                <input type="file" name="avatar" id="avatar"
                                                    onchange="profile.uploadAvatar(this)" hidden>
                                            </div>
                                        </div>
                                        <span class="text-danger" role="alert">
                                            <strong id="err-avatar"></strong>
                                        </span>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group row mb-1 align-items-center">
                                            <h6 class="col-md-3">Họ và Tên: </h6>
                                            <input type="text" class="form-control col-md-8"
                                                value="{{$profile->name ?? ''}}" name="name" id="full_name"
                                                placeholder="Họ và tên...">
                                            <span class="text-danger" role="alert">
                                                <strong id="err-full-name"></strong>
                                            </span>
                                        </div>
                                        <div class="form-group align-bottom mb-1">
                                            <span class=" font-weight-bold pr-3 mr-5">Giới Tính: </span>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="male"
                                                    value="Nam" @if ($profile->gender == 'Nam')
                                                checked
                                                @endif>
                                                <label class="form-check-label" for="inlineRadio1">Nam</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="femail"
                                                    value="Nữ" @if ($profile->gender == 'Nữ')
                                                checked
                                                @endif>
                                                <label class="form-check-label" for="inlineRadio2">Nữ</label>
                                            </div>
                                            <span class="text-danger" role="alert">
                                                <strong id="err-gender"></strong>
                                            </span>
                                        </div>
                                        <div class="form-group row align-items-center mb-1">
                                            <label for="birth" class="col-md-3 font-weight-bold">Ngày Sinh: </label>
                                            <input type="date" class="form-control col-md-8" name="birth" id="birth"
                                                value="{{$profile->birth ?? ''}}">
                                            <span class="text-danger" role="alert">
                                                <strong id="err-birth"></strong>
                                            </span>
                                        </div>
                                        <div class="form-group row align-items-center mb-1">
                                            <label for="address" class="col-md-3 font-weight-bold">Địa Chỉ</label>
                                            <input type="text" class="form-control col-md-8"
                                                value="{{$profile->address ?? ''}}" name="address" id="address"
                                                placeholder="địa chỉ...">
                                            <span class="text-danger" role="alert">
                                                <strong id="err-address"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="bio">Giới thiệu bản thân</label>
                                    <textarea class="form-control" name="bio" id="bio" placeholder="Giới thiệu bản thân...">{{$profile->bio ?? ''}}</textarea>
                                    <span class="text-danger" role="alert">
                                        <strong id="err-bio"></strong>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="exp">Kinh nghiệm</label>
                                    <textarea class="form-control" name="exp" id="exp" placeholder="Kinh nghiệm bản thân...">{{$profile->exp ?? ''}}</textarea>
                                    <span class="text-danger" role="alert">
                                        <strong id="err-exp"></strong>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="resume">Hồ sơ đính kèm</label>
                                    <input type="file" name="resume" class="form-control" id="resume"
                                        value="{{$profile->resume}}">
                                    <span class="text-danger" role="alert">
                                        <strong id="err-resume"></strong>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="cover_letter">Thư xin việc</label>
                                    <input type="file" name="cover_letter" class="form-control" id="cover_letter"
                                        value="{{$profile->cover_letter}}">
                                    <span class="text-danger" role="alert">
                                        <strong id="err-cover-letter"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
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
<div class="row">
    <div class="col-12">
        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab"
                    aria-controls="basicInfo" aria-selected="true">Thông Tin Hồ Sơ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="connectedServices-tab" data-toggle="tab" href="#connectedServices" role="tab"
                    aria-controls="connectedServices" aria-selected="false">Công Việc Đã Ứng Tuyển</a>
            </li>
        </ul>
        <div class="tab-content ml-1" id="myTabContent">
            <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                <div class="row">
                    <div class="col-sm-3 col-md-2 col-5">
                        <label style="font-weight:bold;">Giới thiệu bản thân</label>
                    </div>
                    <div class="col-md-8 col-6">
                        {{$profile->bio ?? '...Chưa Cập Nhật...'}}
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-sm-3 col-md-2 col-5">
                        <label style="font-weight:bold;">Kinh Nghiệm</label>
                    </div>
                    <div class="col-md-8 col-6">
                        {{$profile->exp ?? '...Chưa Cập Nhật...'}}
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-sm-3 col-md-2 col-5">
                        <label style="font-weight:bold;">Hồ sơ đính kèm</label>
                    </div>
                    <div class="col-md-8 col-6">
                        @if ($profile->resume)
                        <embed src="{{$profile->resume}}" type="application/pdf" height="300px" width="100%"
                            class="embed-responsive">
                        <a href="{{$profile->resume}}">download</a>
                        @else
                        <h6>...Chưa Cập Nhật...</h6>
                        @endif
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-sm-3 col-md-2 col-5">
                        <label style="font-weight:bold;">Thư xin việc</label>
                    </div>
                    <div class="col-md-8 col-6">
                        @if ($profile->cover_letter)
                        <embed src="{{$profile->cover_letter}}" type="application/pdf" height="300px" width="100%"
                            class="embed-responsive">
                        <a href="{{$profile->cover_letter}}">download</a>
                        @else
                        <h6>...Chưa Cập Nhật...</h6>
                        @endif
                    </div>
                </div>
                <hr />
            </div>
            <div class="tab-pane fade" id="connectedServices" role="tabpanel" aria-labelledby="ConnectedServices-tab">
                @foreach ($profile->applicants as $item)
                {{-- @php
                dd($item->work)
                @endphp --}}
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="media col-md-11">
                            <img src="{{$item->work->company->logo}}" class=" align-self-center mr-3" alt="..."
                                style="width:120px; height:120px">
                            <div class="media-body row mt-2">
                                <div class="col-md-8">
                                    <h4 class="mt-0">{{$item->work->title}}</h4>
                                    <h5 class="mt-0"><i class="far fa-building"></i> <span
                                            class="text-primary">{{$item->work->company->c_name}}</span>
                                    </h5>
                                    <div class="mt-0"><i class="fas fa-map-marker-alt"></i>
                                        {{$item->work->company->address}}
                                    </div>
                                    <div class="mt-0"><i class="fas fa-briefcase"></i>
                                        {{$item->work->position}}</div>
                                    <div class="mt-0"><i class="fas fa-user-clock"></i>
                                        {{$item->work->type}}</div>
                                </div>
                                <div class="row col-md-4 align-items-end">
                                    <div class="mr-1 col-md-12">
                                        <span
                                            class='create-box'>{{$item->work->created_at->locale('vi')->diffForHumans()}}</span>
                                    </div>
                                    @if ($item->work->status == 0)
                                    <div class="mr-1 col-md-12"><i class="fas fa-dollar-sign"></i>
                                        {{$item->work->salary_number($item->work->salary_min)}} -
                                        {{$item->work->salary_number($item->work->salary_max)}}
                                    </div>
                                    @else
                                    <div class="mr-1 col-md-12"><i class="fas fa-dollar-sign"></i>
                                        {{__('Thương Lượng')}}
                                    </div>
                                    @endif
                                    <div class="col-md-12"><i class="far fa-calendar-alt"></i>
                                        {{date('d/m/Y', strtotime($item->work->last_date))}}</div>
                                    <a href="{{ route('jobs.show',['work'=> $item->work]) }}" class="btn btn-info">Xem
                                        chi
                                        tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>