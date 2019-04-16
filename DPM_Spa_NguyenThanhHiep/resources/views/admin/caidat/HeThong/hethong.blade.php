
@extends('admin.layout.index')

@section('content')
	<div class="row">
           <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row" id="content">
                    <div id="page-wrapper">
                        <div class="container-fluid" style="background-color: white; margin: 0 5;">
                            <div class="col-lg-12">
                            	<div class="col-lg-12">
									@if(Session::has('flash_message'))
										<div class="alert alert-{!! Session::get('flash_lever') !!}">
											{!! Session::get('flash_message') !!}
										</div>
									@endif
								</div>
                                <h1 class="page-header">Cài Đặt Hệ Thống</h1>
                                </div>
                                <!-- /.col-lg-12 -->
                                <div class="col-lg-7" style="padding-bottom:120px">
                                <form enctype="multipart/form-data" action="admin/caidat/updatahethong/spa" method="POST">
                                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="title">
										<h3>Tiêu đề</h3>
									</div>
                                    <div class="form-group">
                                        <label for="title">Tên tiêu đề<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input class="form-control" name="title" value="{{$title->content}}"  />
                                    </div>
                                    <div class="form-group">
                                        <label for="package_description_normal">Logo<span class="text-danger font-weight-bold">*</span></label><br>
                                        <img src="image/logo/{{$logo->content}}" width="140px" height="120px"><br>
                                        <div class="row">
                                            <div class="col-lg-9">
                                                <input type="file" name="logo">
                                            </div>
                                            <div class="col-lg-3">
                                                 <a href="admin/caidat/xoalogo/logo"><i class="fas fa-trash-alt" style="color: red"></i> Xóa</a>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="form-group">
                                        <label for="gioithieu">Giới thiệu<span class="text-danger font-weight-bold">*</span></label><br>
                                        <textarea name="gioithieu" class="form-control" id="editor1" >
                                        	{{$gioithieu->content}}
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="package_description_normal">Logo khuyến mãi<span class="text-danger font-weight-bold">*</span></label><br>
                                        <img src="image/logo/{{$logokhuyenmai->content}}" width="120px" height="100px"><br>
                                        <div class="row">
                                            <div class="col-lg-9">
                                                <input type="file" name="logokhuyenmai">
                                            </div>
                                            <div class="col-lg-3">
                                                 <a href="admin/caidat/xoalogokhuyenmai/logokhuyenmai"><i class="fas fa-trash-alt" style="color: red"></i> Xóa</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tieudekhuyenmai">Tiêu đề khuyến mãi<span class="text-danger font-weight-bold">*</span></label><br>
                                        <textarea name="tieudekhuyenmai" class="form-control" id="editor1" >
                                        	{{$tieudekhuyenmai->content}}
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="noidungkhuyenmai">Nội dung khuyến mãi<span class="text-danger font-weight-bold">*</span></label><br>
                                        <textarea name="noidungkhuyenmai" class="form-control" rows="10" cols="80" >
                                        	{{$noidungkhuyenmai->content}}
                                        </textarea>
                                    </div>
                                    <hr>
                                    <h4>Thông tin</h4>
                                    <div class="form-group">
                                        <label for="email">Email<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input type="text" class="form-control" name="email" value="{{$email->content}}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Số điện thoại<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input type="text" class="form-control" name="phone" value="{{$phone->content}}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="tongdai">Tổng đài<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input type="text" class="form-control" name="tongdai" value="{{$tongdai->content}}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="gioilamviec">Giờ làm việc<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input type="text" class="form-control" name="gioilamviec" value="{{$gioilamviec->content}}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="thoigianlamviec">Thời gian làm việc<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input type="text" class="form-control" name="thoigianlamviec" value="{{$thoigianlamviec->content}}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="linkfacaebook">Link facebook<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input type="text" class="form-control" name="linkfacaebook" value="{{$linkfacaebook->content}}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="diachi">Đại chỉ<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input type="text" class="form-control" name="diachi" value="{{$diachi->content}}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="keymap">Key google map<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input type="text" class="form-control" name="keymap" value="{{$keymap->content}}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="maping">Google map lng<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input type="text" class="form-control" name="maping" value="{{$maping->content}}" />
                                    </div>
                                    <br>

                                   <!--  <a href="admin/product/danhsach" class="btn btn-default" style="text-align: center; background-color: green; color: white;">Cập nhật</a> -->
                                   <button type="submit" class="btn btn-default">Cập nhật vào CSDL</button>
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
