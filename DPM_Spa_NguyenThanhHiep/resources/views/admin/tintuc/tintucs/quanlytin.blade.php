@extends('admin.layout.index')

@section('content')
<div class="card">
        <h3>quản lý tin tức</h3>
        <div class="card-body">
            <!-- <div class="alert alert-info" role="alert">
                <form action="#" method="post">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Lọc theo khoa:</span>
                        </div>
                        <select class="form-control custom-select" id="MaKhoa" name="MaKhoa">
                            <option value="">-- Chọn --</option>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="fal fa-filter"></i> Lọc dữ liệu</button>
                        </div>
                    </div>
                </form>
            </div> -->
            <div class="col-lg-12">
                @if(Session::has('flash_message'))
                    <div class="alert alert-{!! Session::get('flash_lever') !!}">
                        {!! Session::get('flash_message') !!}
                    </div>
                @endif
            </div>
            <p>
                <a href="admin/tintuc/quanlytin/them" class="btn btn-default" style="background-color: #8ce4e8; border-radius: 3px;"> <i class="fas fa-plus"></i>   Thêm</a>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalImport"><i class="fal fa-upload"></i> Nhập từ Excel</button>
                <a href="#" class="btn btn-warning"><i class="fal fa-download"></i> Xuất ra Excel</a> (<a href="#">Tải file mẫu</a>)
            </p>
            <table id="DataList" class="table table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th width="5%">Mã tin</th>
                        <th width="25%">Tiêu đề tin</th>
                        <th width="55%">Nội dung tóm tắc</th>
                        <th width="15%">Trạng thái</th>
                        <th width="5%">Sửa</th>
                        <th width="5%">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $value)
                        <tr>
                            <td>{{$value->cmsnews_id}}</td>
                            <!-- <td>{{$value->cmssubject_id}}</td> -->
                           <!--  @foreach($chude as $val)
                            @if($value->cmsnews_id == $val->cmssubject_id)
                                <td>{{$val->cmssubject_name}}</td>
                            @endif
                            @endforeach -->
                            <td>{{$value->cmsnews_title}}</td>
                            <td>{{$value->cmsnews_shortcontent}}</td>
                            <td></td>
                            <td class="text-center"><a href="admin/tintuc/suatintuc/{{$value->cmsnews_id}}" ><i class="fas fa-edit"></i></a>s</td>
                            <td class="text-center">
                                <a href="admin/tintuc/xoatintuc/{{$value->cmsnews_id}}" onclick="return xacnhanxoa('Bạn có chắc là muốn xóa không!')">
                                    <i class="fas fa-trash-alt" style="color: red"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection