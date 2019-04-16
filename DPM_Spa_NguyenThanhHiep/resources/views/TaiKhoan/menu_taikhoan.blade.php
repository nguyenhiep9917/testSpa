<div class="col-lg-3 body_customer" style="padding-bottom:120px">
  <ul class="nav flex-column">
    <li class="nav-item">
      <a class="nav-link active" href="{{url('taikhoan/taikhoan_page ')}}"><i class="fas fa-box-usd fa-lg" ></i>Package</a>
    </li>
    <li class="nav-item">
      <?php
        $customer_code = Auth::user()->customer_code;
        $find = \App\Customer::where('customer_code', $customer_code)->first();
        $idCustomer = $find->customer_id;
        
        $finddl = \App\HoaHongDL::where('customer_id', $idCustomer)->first();
        if(isset($finddl))
        {
          echo '<a class="nav-link active" href="taikhoan/vi_ca_nhan/'.$find->customer_id.'"><i class="fas fa-box-usd fa-lg" ></i> Ví cá nhân:</a>';
        }
        else {
          echo '';
        }
      ?>
      
    </li>
    <!-- <li class="nav-item">
      <a class="nav-link" href="#"><i class="fas fa-box-usd fa-lg"></i> Ví mua hàng: </a>
    </li> -->
  </ul>
  <div class="col-lg-12">
      <h6>Thông tin cá nhân</h6>
      
     <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="{{url('taikhoan/updatathongtin-taikhoan')}}"><i class="far fa-question-circle fa-lg"></i> Cập nhật thông tin:</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="taikhoan/doimatkhau/{{Auth::user()->id}}"><i class="fas fa-user-edit fa-lg"></i> Thay đổi mặt khẩu:</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('taikhoan/danhsachdiachi-taikhoan')}}"><i class="fas fa-clipboard-list fa-lg"></i> Danh sách địa chỉ: </a>
        </li>
        <li class="nav-item">
        <?php
          $id_user = Auth::user()->id;
            echo '<a class="nav-link active" href="taikhoan/donhang-taikhoan/'.$id_user.'"><i class="fas fa-box-usd fa-lg" ></i> Theo dõi đơn hàng</a>';
        ?>
      </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('taikhoan/cayhethong-taikhoan')}}"><i class="fas fa-project-diagram fa-lg"></i> Cây hệ thống thành viên: </a>
        </li>
      </ul>
  </div>
  <div class="col-lg-12">
      <h6>Doanh số hoa hồng</h6>
     <ul class="nav flex-column">
      <!-- thành viên gói miễn phí -->
        <?php
            $code_customer_user = Auth::user()->customer_code;
            $all_customer = \App\Customer::all();
            $find_customer = \App\Customer::where('customer_code', $code_customer_user)->first();
            $id_package = $find_customer->package_id;
            
            // Thành viên MIỄN phí
            if($id_package == 1)
            {
            echo("");
            }
            
            // Thành viên thường
            if($id_package == 2)
            {
            echo(
              "
                  <li class='nav-item'>
                  <a class='nav-link' href='#'><i class='fas fa-balance-scale'></i> Hoa hồng doanh số đại lý: </a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' href='#'><i class='fas fa-balance-scale'></i> Doanh số đại lý: </a>
                </li>
               
                
                ");
            }
          // Thành viên Vip
            if($id_package == 3)
            {
            echo(
              "
                  <li class='nav-item'>
                  <a class='nav-link' href='#'><i class='fas fa-balance-scale'></i>  Hoa hồng doanh số đại lý: </a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' href='#'><i class='fas fa-balance-scale'></i> Doanh số đại lý: </a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' href='#'><i class='fas fa-balance-scale'></i> Hoa hồng tổng đại lý: </a>
                </li>
               
                ");
            }
        ?>
        
       
        
      </ul>
      <br>
      <a href="dangxuat"><i class="fas fa-sign-out-alt fa-lg"></i>Đăng xuất</a>
  </div>
</div>
