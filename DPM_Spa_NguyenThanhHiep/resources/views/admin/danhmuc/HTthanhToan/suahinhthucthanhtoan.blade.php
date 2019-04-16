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
                               <!--  @if(count($errors) > 0)
                                    <div class="alert alert-danger">
                                        @foreach($errors -> all() as $err)
                                            {{$err}} <br>
                                        @endforeach
                                    </div>
                                @endif
                                @if(session('ThongBaoThem'))
                                    <div class="alert alert-success">
                                        {{session('ThongBaoThem')}}
                                    </div>
                                @endif -->
                                <form enctype="multipart/form-data" action="admin/danhmuc/hinhthucthanhtoan/sua/{{$data->id}}" method="POST">
                                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="form-group">
                                        <label>Hình thức thanh toán</label><br>
                                        <input class="form-control" name="paymenttype_name" value="{{$data->paymenttype_name}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Mã code</label><br>
                                        <input class="form-control" name="paymenttype_code" value="{{$data->paymenttype_code}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label><br>
                                        <textarea name="paymenttype_description" class="form-control " id="editor1">{{$data->paymenttype_description}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Trạng thái</label><br>
                                        @if($data->paymenttype_status == 1)
                                            <input type="checkbox" name="paymenttype_status" checked="">Cho phép mở
                                        @else
                                            <input type="checkbox" name="paymenttype_status">Cho phép mở
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-default">Thêm vào CSDL</button>
                                    <button type="reset" class="btn btn-default">Làm mới</button>
                                    <a href="admin/danhmuc/hinhthucthanhtoan" class="btn btn-default"> Trở lại</a>
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
