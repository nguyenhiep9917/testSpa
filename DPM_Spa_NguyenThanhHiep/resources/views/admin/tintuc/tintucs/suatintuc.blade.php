@extends('admin.layout.index')

@section('content')
	<div class="row">
           <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div id="page-wrapper">
                        
                        <div class="container-fluid" style="background-color: white; margin: 0 5;">
                            <div class="col-lg-12">
                                <h1 class="page-header">Thêm chủ đề</h1>
                                </div>
                                <!-- /.col-lg-12 -->
                                <div class="col-lg-7" style="padding-bottom:120px">
                                <form enctype="multipart/form-data" action="admin/tintuc/suatintuc/{{$data->cmsnews_id}}" method="POST">
                                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                                   <div class="form-group">
                                        <label>Chủ đề</label><br>
                                        <select name="cmssubject_id" class="form-control">
                                            <option value="0">{{$Subject->cmssubject_name}}</option>
                                            @foreach($dataSubject as $value)
                                                <option value="{{$value->cmssubject_id}}">{{$value->cmssubject_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tiêu đề</label><br>
                                        <input type="text" name="cmsnews_title" class="form-control" value="{{$data->cmsnews_title}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả ngắn</label><br>
                                        <textarea name="cmsnews_shortcontent" class="form-control" >{{$data->cmsnews_shortcontent}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label><br>
                                        <textarea name="cmsnews_fullcontent" class="form-control " id="editor1">{{$data->cmsnews_fullcontent}}</textarea>
                                    </div>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="cmsnews_status" checked="">Cho phép mở <br>
                                    </label><br>
                                    <button type="submit" class="btn btn-default">Thêm vào CSDL</button>
                                    <button type="reset" class="btn btn-default">Làm mới</button>
                                    <a href="admin/tintuc/quanlychude" class="btn btn-default"> Trở lại</a>
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