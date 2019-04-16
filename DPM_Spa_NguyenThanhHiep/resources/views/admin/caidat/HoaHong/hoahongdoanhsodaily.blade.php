
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
                                <div class="col-lg-10" style="padding-bottom:120px">
                                <form enctype="multipart/form-data" action="admin/caidat/caidathoahongdsdl/{1}" method="POST">
                                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="title">
										<h3>I. Điều kiện & Phần trăm hoa hồng doanh số đại lý</h3>
										<h4>1.Đại lý thường</h4>
									</div>
                                    <div class="form-group">
                                    	<div class="col-lg-3">
                                        	<label for="package_name_free">Doanh số cá nhân: (đồng)</label>
                                        </div>
                                        <div class="col-lg-9">
                                        	<input class="form-control" name="doanhsocanhandkthuong" value="{{$doanhsocanhandkthuong->content}}"  /><br>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                    	<div class="col-lg-3">
                                        	<label for="package_name_free">Hoặc số F1 VIP/tháng:</label>
                                        </div>
                                        <div class="col-lg-9">
                                        	<input class="form-control" name="hoahongdaily_sof1vipdkthuong" value="{{$hoahongdaily_sof1vipdkthuong->content}}"  /><br>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                    	<div class="col-lg-3">
                                        	<label for="package_name_free">Bậc 1:</label>
                                        </div>
                                        <div class="col-lg-9">
                                        	<input class="form-control" name="hoahongdaily_percentf1" value="{{$hoahongdaily_percentf1->content}}"  /><br>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                    	<div class="col-lg-3">
                                        	<label for="package_name_free">Bậc 2:</label>
                                        </div>
                                        <div class="col-lg-9">
                                        	<input class="form-control" name="hoahongdaily_percentf2" value="{{$hoahongdaily_percentf2->content}}"  /><br>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                    	<div class="col-lg-3">
                                        	<label for="package_name_free">Bậc 3:</label>
                                        </div>
                                        <div class="col-lg-9">
                                        	<input class="form-control" name="hoahongdaily_percentf3" value="{{$hoahongdaily_percentf3->content}}"  /><br>
                                        </div>
                                    </div>
                                    <h4>2. Đại lý VIP</h4>
                                     <div class="form-group">
                                    	<div class="col-lg-3">
                                        	<label for="package_name_free">Doanh số cá nhân: (đồng)</label>
                                        </div>
                                        <div class="col-lg-9">
                                        	<input class="form-control" name="hoahongdaily_doanhsocanhandkVIP" value="{{$hoahongdaily_doanhsocanhandkVIP->content}}"  /><br>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                    	<div class="col-lg-3">
                                        	<label for="package_name_free">Hoặc số F1 VIP/tháng:</label>
                                        </div>
                                        <div class="col-lg-9">
                                        	<input class="form-control" name="hoahongdaily_sof1vipdkvip" value="{{$hoahongdaily_sof1vipdkvip->content}}"  /><br>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                    	<div class="col-lg-3">
                                        	<label for="package_name_free">Bậc 4:</label>
                                        </div>
                                        <div class="col-lg-9">
                                        	<input class="form-control" name="hoahongdaily_percentf4" value="{{$hoahongdaily_percentf4->content}}"  /><br>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                    	<div class="col-lg-3">
                                        	<label for="package_name_free">Bậc 5:</label>
                                        </div>
                                        <div class="col-lg-9">
                                        	<input class="form-control" name="hoahongdaily_percentf5" value="{{$hoahongdaily_percentf5->content}}"  /><br>
                                        </div>
                                    </div>
                                    
<!-- 
                                    <a href="admin/product/danhsach" class="btn btn-default" style="text-align: center; background-color: green; color: white;">Cập nhật</a> -->
                                    <button type="submit" class="btn btn-default" style="text-align: center; background-color: green; color: white;">Cập nhật</button>
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
