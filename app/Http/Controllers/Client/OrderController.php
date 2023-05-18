<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderPaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart') ?? [];

        return view('clients.pages.checkout', compact('cart'));
    }
    public function callbackVnPay(Request $request){
        if($request->get('vnp_ResponseCode')==="00"){
            echo"thanh taocn thanh cong";
        }else{
            echo"thanh chau thanhc tacn thi cong";
        }
        dd($request);
    }

    public function urlVnPay(Order $order,$totalBalance):string
    {
            $vnp_TxnRef = $order->id; //Mã giao dịch thanh toán tham chiếu của merchant
            $vnp_Amount = $totalBalance; // Số tiền thanh toán
            $vnp_Locale = 'vn'; //Ngôn ngữ chuyển hướng thanh toán
            $vnp_BankCode = "VNBANK"; //Mã phương thức thanh toán
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán

            $startTime = date("YmdHis");
            $expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));

            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => config('vn_pay.vnp_tmncode'),
                "vnp_Amount" => $vnp_Amount* 100,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => "Thanh toan GD:".$vnp_TxnRef,
                "vnp_OrderType" => "other",
                "vnp_ReturnUrl" => config('vn_pay.vnp_returnurl'),
                "vnp_TxnRef" => $vnp_TxnRef,
                "vnp_ExpireDate"=>$expire
            );
            // dd($inputData);
            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }

            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = config('vn_pay.vnp_url') . "?" . $query;
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, config('vn_pay.vnp_hashsecret'));
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            return $vnp_Url;
    }

    public function placeOrder(Request $request)
    {
        // dd($request);
        // $request->validate([
        //     'full_name' => 'required',
        //     'address' => 'required',
        //     'phone' => 'required',
        // ]);
        $cart = session()->get('cart') ?? [];

        $arraydata=DB::transaction(function() use($request,$cart) {
                $order=Order::create([
                    'user_id' => Auth::user()->id,
                    'address' => $request->get("address"),
                    'payment_method' => $request->get('payment_method'),
                    'status' => "pending",
                ]);
                $totalBalance=0;
                foreach($cart as $productid=>$itemt){
                    $order_itemt=OrderItem::create([
                        'order_id' => $order->id,
                        "product_id"=> $productid,
                        "qty"=> $itemt["qty"],
                        "price"=> $itemt["price"],
                        "name"=>$itemt["name"],
                    ]);
                    $totalBalance+=$itemt["price"]*$itemt["qty"];
                }
                $orderPaymentMethod=OrderPaymentMethod::create([
                    'order_id' => $order->id,
                    'payment_provider' => $request->get('payment_method'),
                    'total_balance' => $totalBalance,
                    'status' => 'pending',
                ]);
                return compact('order','totalBalance','orderPaymentMethod');
            }
        );
        if($request->get('payment_method') === "vnpay"){
            $vnp_Url=$this->urlVnPay($arraydata["order"],$arraydata["totalBalance"]);
            return Redirect::to($vnp_Url);
        }
        session()->put('cart',[]);
        return redirect()->route("index")->with("message","dat hang thanh cong");
    }
}
