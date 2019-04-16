@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="content">
              <?php
              if(Auth::user())
              {
                 $codeUser = Auth::user()->customer_code;
                  $finCustomer = \App\Customer::where('customer_code', $codeUser)->first();
                  if($finCustomer->package_id > 1)
                  {
                    echo "Chào $finCustomer->customer_username bạn sẽ được giảm giá 30% với tất cả các sản phẩm.";
                  }
                  else {
                    echo "";
                  }
              }
                 
                ?>
            
                <div class="row">
                    <div class="col-sm-12">
                        <h4>Thông tin giỏ hàng</h4>
                        <table class="table table-sm">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Hình ảnh</th>
                              <th scope="col">Tên sản phẩm</th>
                              <th scope="col">Giá</th>
                              <th scope="col">Số lượng</th>
                              <th scope="col">Action</th>
                              <th scope="col">Tổng giá</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <form action="{{url('dangnhap')}}" method="post" class="beta-form-checkout">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                @php $count = 1; @endphp
                                @foreach($content as $item)
                                <tr>
                                  <th scope="row">{{$count++}}</th>
                                  <td><img src="image/product/{{$item->options->img}}" width="130px" height="100px"></td>
                                  <td>{{$item->name}}</td>
                                  <td>
                                     <?php
                                     if(Auth::user())
                                     {
                                      $codeUser = Auth::user()->customer_code;
                                        $finCustomer = \App\Customer::where('customer_code', $codeUser)->first();
                                        if($finCustomer->package_id > 1)
                                        {
                                          echo number_format($item->price*100/70, 0 ,',','.'); echo '&nbsp;vnđ';
                                        }
                                        else {
                                          echo number_format($item->price, 0 ,',','.');echo '&nbsp;vnđ';
                                        }
                                     }
                                        
                                      ?>
                                  </td>
                                  <td>
                                      <input type="number" class="qty form-control" name="qty" value="{{$item->qty}}" style="width: 50%">
                                  </td>
                                  <td>
                                    <a href="script:void();" class="updatacart" id="{{$item->rowId}}"><i class="fas fa-pencil-alt fa-lg"></i></a>
                                    <a href="xoa-san-pham/{{$item->rowId}}"><i class="fas fa-times-circle fa-lg"></i></a>
                                  </td>
                                  <td>{{number_format($item->price * $item->qty, 0 ,',','.' )}}&nbsp;vnđ</td>
                                  <td>
                                    <?php
                                    if(Auth::user())
                                    {
                                       $codeUser = Auth::user()->customer_code;
                                      $finCustomer = \App\Customer::where('customer_code', $codeUser)->first();
                                      if($finCustomer->package_id > 1)
                                      {
                                        echo "Giảm (-31%)";
                                      }
                                      else {
                                        echo "";
                                      }
                                    }
                                     
                                    ?>
                                  </td>
                                </tr>
                                @endforeach
                            </form>
                          </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                    </div>
                    <div class="col-sm-4">
                        <table class="table table-bordered table-dark">
                          <thead>
                            <tr>
                              <th scope="col" style="color: red">Tổng Giá:</th>
                              <th scope="col">{{$totals}}&nbsp;vnđ</th>
                            </tr>
                          </thead>
                        </table>
                    </div>
                </div>
            <div class="thanhtoangiohang">
              @if(Auth::user())
                <a href="dathang/{{Auth::user()->id}}" >Đặt hàng</a>
              @endif
            </div>
        </div> <!-- #content -->
    </div> <!-- .container -->

@endsection

@section('script')
<script>
    $(document).ready(function(){
        $(".updatacart").click(function(){
            var rowid = $(this).attr('id');
            var qty = $(this).parent().parent().find(".qty").val();
            var token = $("input[name='_token']").val();
            $.ajax({
                    url: 'cap-nhat/'+rowid+'/'+qty,
                    type: "GET",
                    cache: false,
                    data: {"_token":token, "id":rowid, "qty":qty},
                    success:function(data){
                        if(data == "oke"){
                            alert("yes");
                        }
                    }
                });

        });
    });
</script>
@endsection
<style type="text/css">
    .thanhtoangiohang{
    float: right; 
    background-color: #66d7fa; 
    width: 100px; height: 35px; 
    font-weight: bold; 
    line-height: 35px;
    border-radius: 5px;
  }
  .thanhtoangiohang a {
    margin-left: 17px;
  }

</style>



