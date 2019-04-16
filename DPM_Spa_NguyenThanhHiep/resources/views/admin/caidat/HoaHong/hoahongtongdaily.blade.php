
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
                                <form enctype="multipart/form-data" action="admin/caidat/goidaily" method="POST">
                                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="title">
										<h3>Điều kiện hoa hồng tổng đại lý</h3>
									</div>
                                    <strong style="margin-left: 250px">Mức hưởng 5%</strong>
                                    <div class="form-group">
                                    	<div class="col-lg-3">
                                        	<label for="package_name_free">Số đại lý bậc 1 Vip trong 2 tháng:</label>
                                        </div>
                                        <div class="col-lg-9">
                                        	<input class="form-control" name="package_name_free" value=""  /><br>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                    	<div class="col-lg-3">
                                        	<label for="package_name_free">Số đại lý bậc 2 Vip trong 2 tháng:</label>
                                        </div>
                                        <div class="col-lg-9">
                                        	<input class="form-control" name="package_name_free" value=""  /><br>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                    	<div class="col-lg-3">
                                        	<label for="package_name_free">Số đại lý Vip trong 2 tháng:</label>
                                        </div>
                                        <div class="col-lg-9">
                                        	<input class="form-control" name="package_name_free" value=""  /><br>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                    	<div class="col-lg-3">
                                        	<label for="package_name_free">Doanh số cá nhân:</label>
                                        </div>
                                        <div class="col-lg-9">
                                        	<input class="form-control" name="package_name_free" value=""  /><br>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                    	<div class="col-lg-3">
                                        	<label for="package_name_free">Số Đại lý bậc 1 Vip trong 1 tháng:</label>
                                        </div>
                                        <div class="col-lg-9">
                                        	<input class="form-control" name="package_name_free" value=""  /><br>
                                        </div>
                                    </div>
                                    <strong style="margin-left: 250px">Mức hưởng 3%</strong>
                                     <div class="form-group">
                                    	<div class="col-lg-3">
                                        	<label for="package_name_free">Số đại lý bậc 1 Vip trong 2 tháng:</label>
                                        </div>
                                        <div class="col-lg-9">
                                        	<input class="form-control" name="package_name_free" value=""  /><br>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                    	<div class="col-lg-3">
                                        	<label for="package_name_free">Số đại lý bậc 2 Vip trong 2 tháng:</label>
                                        </div>
                                        <div class="col-lg-9">
                                        	<input class="form-control" name="package_name_free" value=""  /><br>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                    	<div class="col-lg-3">
                                        	<label for="package_name_free">Số đại lý Vip trong 2 tháng:</label>
                                        </div>
                                        <div class="col-lg-9">
                                        	<input class="form-control" name="package_name_free" value=""  /><br>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                    	<div class="col-lg-3">
                                        	<label for="package_name_free">Doanh số cá nhân:</label>
                                        </div>
                                        <div class="col-lg-9">
                                        	<input class="form-control" name="package_name_free" value=""  /><br>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-3">
                                            <label for="package_name_free">Số Đại lý bậc 1 Vip trong 1 tháng:</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input class="form-control" name="package_name_free" value=""  /><br>
                                        </div>
                                    </div>

                                    <strong style="margin-left: 250px">Mức hưởng 2%</strong>
                                     <div class="form-group">
                                        <div class="col-lg-3">
                                            <label for="package_name_free">Số đại lý bậc 1 Vip trong 2 tháng:</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input class="form-control" name="package_name_free" value=""  /><br>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-lg-3">
                                            <label for="package_name_free">Số đại lý bậc 2 Vip trong 2 tháng:</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input class="form-control" name="package_name_free" value=""  /><br>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-lg-3">
                                            <label for="package_name_free">Số đại lý Vip trong 2 tháng:</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input class="form-control" name="package_name_free" value=""  /><br>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-lg-3">
                                            <label for="package_name_free">Doanh số cá nhân:</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input class="form-control" name="package_name_free" value=""  /><br>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-3">
                                            <label for="package_name_free">Số Đại lý bậc 1 Vip trong 1 tháng:</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input class="form-control" name="package_name_free" value=""  /><br>
                                        </div>
                                    </div>
                                    
                                    <a href="admin/product/danhsach" class="btn btn-default" style="text-align: center; background-color: green; color: white;">Cập nhật</a>
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
