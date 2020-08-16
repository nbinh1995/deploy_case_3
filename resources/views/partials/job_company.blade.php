@forelse ($company->works as $item)
<div class="container">
    <div class="row mb-3 shadow-sm bg-white">
        <div class="col-md-12 cursor">
            <a href="{{ route('jobs.show',['work'=> $item]) }}">
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
        @auth
        @if (Auth::user()->id == $company->user_id)
        <div class="col-md-12">
            <hr>
            <div class="row justify-content-end mb-3 mr-1">
                <button onclick="work.edit(this)" data-url="{{route('jobs.edit',['work'=>$item])}}"
                    data-urln="{{route('jobs.update',['work'=>$item])}}" class="btn btn-outline-primary"><i
                        class="far fa-edit"></i>
                    Sửa</button>
                <form action="{{route('jobs.destroy',['work'=>$item])}}" method="post"
                    onsubmit="event.preventDefault();work.destroy(this)">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-outline-danger ml-1"><i class="far fa-trash-alt"></i>
                        Xóa</button>
                </form>
            </div>
        </div>
        @endif
        @endauth
    </div>
</div>
@empty

@endforelse