<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class HoaHongDoanhSoDaiLy extends Model
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
            $date = getdate(); 
             $gethoahongdsdl = \App\HoaHongDL::where('customer_id', $customer->customer_id)->first();
            $data_content .='<br><p>I.Ví cá nhân</p>';
            $data_content .='<span>- Tổng tiền trong ví:       '.number_format($gethoahongdsdl->hoahongdoanhsodaily_tong, 0 ,',','.').' VNĐ</span><br>';
            $data_content .='<span>- Tổng tiền hoa hồng:    '.number_format($gethoahongdsdl->hoahongdoanhsodaily_TongHoaHong, 0 ,',','.').' VNĐ</span>';
            $data_content .='<br>';
            $data_content .='<br><p>II.Hoa hồng doanh số đại lý  ('.$date['mon'].'/'.$date['year'].')</p>';
           
            $data_content .= '
                <table class="table">
                <thead>
                    <tr>
                        <th width="5%">F</th>
                        <th width="5%">%</th>
                        <th width="15%">Doanh số</th>
                        <th width="15%">Hoa hồng</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                        F1
                        </td>
                        <td>
                        '.($gethoahongdsdl->hoahongdoanhsodaily_percentf1*100).'
                        </td>
                        <td>
                        '.number_format($gethoahongdsdl->hoahongdoanhsodaily_doanhsof1, 0, ',', '.').'
                        </td>
                        <td>
                        '.number_format($gethoahongdsdl->hoahongdoanhsodaily_hoahongtrenf1, 0 ,',','.').'
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        F2
                        </td>
                        <td>
                        '.($gethoahongdsdl->hoahongdoanhsodaily_percentf2*100).'
                        </td>
                        <td>
                        '.number_format($gethoahongdsdl->hoahongdoanhsodaily_doanhsof2,0 ,',', '.').'
                        </td>
                        <td>
                        '.number_format($gethoahongdsdl->hoahongdoanhsodaily_hoahongtrenf2, 0 ,',','.').'
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        F3
                        </td>
                        <td>
                        '.($gethoahongdsdl->hoahongdoanhsodaily_percentf3*100).'
                        </td>
                        <td>
                        '.number_format($gethoahongdsdl->hoahongdoanhsodaily_doanhsof3, 0,',', '.').'
                        </td>
                        <td>
                        '.number_format($gethoahongdsdl->hoahongdoanhsodaily_hoahongtrenf3, 0 ,',','.').'
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        F4
                        </td>
                        <td>
                        '.($gethoahongdsdl->hoahongdoanhsodaily_percentf4*100).'
                        </td>
                        <td>
                        '.number_format($gethoahongdsdl->hoahongdoanhsodaily_doanhsof4, 0,',', '.').'
                        </td>
                        <td>
                        '.number_format($gethoahongdsdl->hoahongdoanhsodaily_hoahongtrenf4, 0 ,',','.').'
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        F5
                        </td>
                        <td>
                        '.($gethoahongdsdl->hoahongdoanhsodaily_percentf5*100).'
                        </td>
                        <td>
                        '.number_format($gethoahongdsdl->hoahongdoanhsodaily_doanhsof5, 0,',', '.').'
                        </td>
                        <td>
                        '.number_format($gethoahongdsdl->hoahongdoanhsodaily_hoahongtrenf5, 0 ,',','.').'
                        </td>
                        <td>
                        </td>
                    </tr>
                </tbody>
                ';
                

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
