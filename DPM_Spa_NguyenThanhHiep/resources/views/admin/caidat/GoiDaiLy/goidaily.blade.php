
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
                                <form enctype="multipart/form-data" action="admin/caidat/goidaily" method="POST">
                                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="title">
										<h3>FREE</h3>
									</div>
                                    <div class="form-group">
                                        <label for="package_name_free">Tên gói<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input class="form-control" name="package_name_free" value="{{$data_Package_FREE->package_name}}"  />
                                    </div>
                                    <div class="form-group">
                                        <label for="package_description_free">Mô tả ngắn<span class="text-danger font-weight-bold">*</span></label><br>
                                        <textarea name="package_description_free" class="form-control" rows="10" cols="80" >{{$data_Package_FREE->package_description}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="package_description_short_free">Thông tin gói<span class="text-danger font-weight-bold">*</span></label><br>
                                        <textarea name="package_description_short_free" class="form-control" rows="10" cols="80" >{{$data_Package_FREE->package_description_short}}
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="package_price">Giá<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input type="number" class="form-control" name="package_price_free" value="{{$data_Package_FREE->package_price}}" />
                                    </div>
                                    
                                    <br>
                                   <!-- Gói thường --> 
                                   <div class="title">
										<h3>NORMAL</h3>
									</div>
                                    <div class="form-group">
                                        <label for="package_name_normal">Tên gói<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input class="form-control" name="package_name_normal" value="{{$data_Package_NORMAL->package_name}}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="package_description_normal">Mô tả ngắn<span class="text-danger font-weight-bold">*</span></label><br>
                                        <textarea name="package_description_normal" class="form-control" rows="10" cols="80" >{{$data_Package_NORMAL->package_description}}
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="package_description_short_normal">Thông tin gói<span class="text-danger font-weight-bold">*</span></label><br>
                                        <textarea name="package_description_short_normal" class="form-control" rows="10" cols="80" >{{$data_Package_NORMAL->package_description_short}}
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="package_price_normal">Giá<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input type="number" class="form-control" name="package_price_normal" value="{{$data_Package_NORMAL->package_price}}" />
                                    </div>
                                    <br>
                                    <!-- Gói thường --> 
                                   <div class="title">
										<h3>VIP</h3>
									</div>
                                    <div class="form-group">
                                        <label for="package_name_vip">Tên gói<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input class="form-control" name="package_name_vip" value="{{$data_Package_VIP->package_name}}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="package_description_vip">Mô tả ngắn<span class="text-danger font-weight-bold">*</span></label><br>
                                        <textarea name="package_description_vip" class="form-control" rows="10" cols="80" >{{$data_Package_VIP->package_description}}
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="package_description_short_vip">Thông tin gói<span class="text-danger font-weight-bold">*</span></label><br>
                                        <textarea name="package_description_short_vip" class="form-control" rows="10" cols="80">{{$data_Package_VIP->package_description_short}}
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="package_price_vip">Giá<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input type="number" class="form-control" name="package_price_vip" value="{{$data_Package_VIP->package_price}}"/>
                                    </div>
                                    <br>

                                    <button type="submit" class="btn btn-default">Cập nhật</button>
                                    <a href="admin/product/danhsach" class="btn btn-default"> Trở lại</a>
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
