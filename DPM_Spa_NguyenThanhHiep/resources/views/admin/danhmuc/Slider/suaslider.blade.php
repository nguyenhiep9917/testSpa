@extends('admin.layout.index')

@section('content')
	<div class="row">
           <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div id="page-wrapper">
                        <div class="container-fluid" style="background-color: white; margin: 0 5;">
                            <div class="col-lg-12">
                                <h1 class="page-header">Thêm hình ảnh Slider</h1>
                                </div>
                                <!-- /.col-lg-12 -->
                                <div class="col-lg-7" style="padding-bottom:120px">
                                <form enctype="multipart/form-data" action="admin/danhmuc/slider/sua/{{$data_edit->id}}" method="POST">
                                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="form-group">
                                        <label>Chọn hình ảnh</label><br>
                                        <img src="image/slider/{{$data_edit->file_name}}" width="160px" height="120px">
                                        <input type="file" name="file_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả ngắn</label><br>
                                        <textarea name="content" class="form-control " id="editor1" ></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-default">Thêm vào CSDL</button>
                                    <button type="reset" class="btn btn-default">Làm mới</button>
                                    <a href="admin/danhmuc/slider" class="btn btn-default"> Trở lại</a>
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