@extends('admin.layout.index')

@section('content')
	<div class="row">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div id="page-wrapper">
                        <div class="container-fluid" style="background-color: white; margin: 0 5;">
                            <div class="col-lg-12">
                                <h1 class="page-header">Cập nhật thông tin</h1>
                                </div>
                                <!-- /.col-lg-12 -->
                                <div class="col-lg-7" style="padding-bottom:120px">
                               
                                <form enctype="multipart/form-data" action="admin/danhmuc/hinhthucvanchuyen/sua/{{$data->id}}" method="POST">
                                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="form-group">
                                        <label>Hình thức vận chuyển</label><br>
                                        <input class="form-control" name="shiptype_name" value="{{$data->shiptype_name}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Code</label><br>
                                        <input class="form-control" name="shiptype_code" value="{{$data->shiptype_code}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Trạng thái</label><br>
                                        @if($data->shiptype_status == 1)
                                            <input type="checkbox" name="shiptype_status" checked="">Cho phép mở
                                        @else
                                            <input type="checkbox" name="shiptype_status">Cho phép mở
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-default">Thêm vào CSDL</button>
                                    <button type="reset" class="btn btn-default">Làm mới</button>
                                    <a href="admin/danhmuc/hinhthucvanchuyen" class="btn btn-default"> Trở lại</a>
                                <form>
                            </div>
                        </div>
                        <!-- /.row -->
                     </div>
                </div>
                <!-- /.row -->
            </div>
                <!-- /.container-fluid -->
        </div>
    </div>


@endsection
