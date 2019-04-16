<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class HoaHongTongDaiLy extends Model
{
    
	public $html = '';

	 /**
     * @param array $customer
     * @return string
     */
    function getCustomer(\App\Customer $customer){
    	$url = url('/');
        if (isset($customer->customer_id)) {
            $html_basicnode = '<div class="img-person">';
            if ($customer->package_id == 2) {
                $html_basicnode .= '<div class="img-person"><img src="' . $url . '/image/avatar/man-normal.svg" /></div>';
            } elseif ($customer->package_id == 3) {
                $html_basicnode .= '<div class="img-person"><img src="' . $url . '/image/avatar/man-vip.svg" /></div>';
            } else {
                $html_basicnode .= '<div class="img-person"><img src="' . $url . '/image/avatar/man-free.svg" /></div>';
            }

            $html_basicnode .='</div>';

			$name = $customer->customer_name;
			if ($customer->customer_name == '') $name = $customer->customer_username;

            $html_basicnode .='<p title="'. $customer->customer_username  .'" class="name">' . $name .'</p>';
            $data_content = '';
            $data_content .= '<div style="min-width: 500px;">';

           

            $data_content .= '- Tài khoản: ' . $customer->customer_username . '<br/>';
            $data_content .= '- Họ và tên: ' . $customer->customer_name . '<br/>';
            $data_content .= '- Giới tính: ';
            if ($customer->customer_sex == 1)
            {
                $data_content .= 'Nam<br/>';
            }
            else if ($customer->customer_sex == 0)
            {
                $data_content .= 'Nữ<br/>';
            }
            else
            {
                $data_content .= 'Khác<br/>';
            }
         //   $data_content .= '- Ngày sinh: ' . date("d/m/Y",  $customer->customer_dateofbirth ) . '<br/>';
            $data_content .= '- Điện thoại: ' . $customer->customer_phone . '<br/>';
            $data_content .= '- Email: ' . $customer->customer_email . '<br/>';

            $data_content .='<br><p>Hoa hồng doanh số đại lý</p>';
            $gethoahongdsdl = \App\HoaHongDL::all();
           foreach ($gethoahongdsdl as $value) {
               if($value->customer_id == $customer->customer_id)
               {

                $data_content .= 'F &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; % &nbsp; &nbsp; &nbsp; &nbsp;   &nbsp; Doanh số &nbsp;    &nbsp; &nbsp; &nbsp; &nbsp; Tiền <br>
                ';


                // $data_content .= '- Doanh sô cá nhân: ' . $value->hoahongdoanhsodaily_doanhsocanhan . '<br/>';
               }
           }
           

            // Nua lay hoa hong ra cho nay
            $data_content .='</div>';

            $html ='<div class="person person-vip">';
                $html .="<a href='#' title='THÔNG TIN CHI TIẾT' data-toggle='popover' data-placement='right' data-trigger='hover' data-content='". $data_content."'>";
                    $html .= $html_basicnode;
                $html .="</a>";
            $html .='</div>';

            return $html;
        }
    }


    /**
     * @param $customer
     */
    function dequyCayHethong(\App\Customer $customer){
        $childrens = \App\Customer::where("customer_parent", $customer->customer_id)->get();
        $this->html .= '<div class="hv-item">';
        if ($childrens->count() > 0) {
            $this->html .= '<div class="hv-item-parent">';
        }
            $this->html .= $this->getCustomer($customer);
        if ($childrens->count() > 0) {
            $this->html .= '</div>';
        }

        if ($childrens->count() > 0) {
            $this->html .= '<div class="hv-item-children">';
            foreach ($childrens as $children) {
                $this->html .= '<div class="hv-item-child"><input type="hidden" name="id_customer[]" value="' .  $children->customer_id . '" />';
                $this->dequyCayHethong($children);
                $this->html .= '</div>';
            }
            $this->html .= '</div>';
        }
        
        $this->html .= '</div>';
    }

    /**
     * @param $customer
     * @return string
     */
    function cayHeThong(\App\Customer  $customer){
        $this->dequyCayHethong($customer);
        return $this->html;
    }


   
}
