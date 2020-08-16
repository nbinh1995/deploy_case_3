<div class="container pt-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="bg-title">Kết Nối Nguồn Nhân Lực</h2>
            <h6 class="sm-title">Tìm công việc IT bạn mong muốn</h6>
        </div>
        <div class="col-md-12">
            <form action="{{route('search')}}" method="get">
                <div class="form-row">
                    <div class="col-md-10 mb-3">
                        <input type="text" class="form-control" name="search"
                            placeholder="Tìm kiếm việc làm,nhà tuyển dụng">
                    </div>
                    {{-- <div class="col-md-3 mb-3">
                        <select class="custom-select" name='category_id'>
                            <option selected disabled value="">Loại việc làm...</option>
                            @foreach ($category as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                    </select>
                </div> --}}
                <div class="col-md-2 mb-3 ml-auto">
                    <button class="btn btn-outline-danger" type="submit">Tìm kiếm</button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>