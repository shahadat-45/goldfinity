<?php

namespace App\Http\Controllers;

use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Orderproduct;
use App\Models\Comment;
use App\Models\Product;
use DB;
use App\Models\Admin;
use Cart;
use Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrderController extends Controller
{

    public function pressorder(Request $request)
    {
//        dd($request->all());
        $products = Cart::content();


        $tansID = uniqid();
        if (!Session::has('cart')) {
            return redirect('/empty-cart');
        } elseif (Cart::count() == 0) {
            return redirect('/empty-cart');
        } else {
            $admin = Admin::whereHas('roles', function ($q) {
                $q->where('name', 'user');
            })->where('status', 'Active')->inRandomOrder()->first();

            $order = new Order();
            $order->user_id = $request->user_id;
            $order->store_id = 1;
            $order->invoiceID = $this->uniqueID();
            $order->transID = $tansID;
            $order->subTotal = $request->subTotal;
            $order->deliveryCharge = $request->deliveryCharge;
            $order->orderDate = date('Y-m-d');
            $order->customerNote = '';
            if (isset($admin)) {
                $order->admin_id = $admin->id;
            } else {
                $admin = Admin::findOrfail(1);
                $order->admin_id = $admin->id;
            }
            $result = $order->save();
            if ($result) {
                $customer = new Customer();
                $customer->order_id = $order->id;
                $customer->customerName = $request->customerName;
                $customer->customerPhone = $request->customerPhone;
                $customer->customerAddress = $request->customerAddress;
                $customer->save();
                foreach ($products as $product) {
                    $orderProducts = new Orderproduct();
                    $orderProducts->order_id = $order->id;
                    $orderProducts->product_id = $product->id;
                    $orderProducts->productCode = $product->code;
                    if ($product->options['color'] == 'undefined') {
                    } else {
                        $orderProducts->color = $product->options['color'];
                    }

                    if ($product->options['size'] == 'undefined') {
                    } else {
                        $orderProducts->size = $product->options['size'];
                    }

                    if ($product->options['weight']) {
                        $orderProducts->weight = $product->options['weight'];
                    }
                    
                    if ($product->options['karats']) {
                        $orderProducts->karats = $product->options['karats'];
                    }

                    $orderProducts->productName = $product->name;
                    $orderProducts->quantity = $product->qty;

                    $orderProducts->productPrice = $product->price;
                    $orderProducts->save();
                }

                $notification = new Comment();
                $notification->order_id = $order->id;
                $notification->comment = $order->invoiceID.' Order Has Been Created for '.$admin->name;
                $notification->admin_id = $order->admin_id;
                $notification->save();
                Cart::destroy();
                Session::put('ordersubtotal', $request->subTotal);
                Session::put('orderdeliverycharge', $request->deliveryCharge);
                Session::put('order_id', $order->id);


                if ($request->paymentMethod == 'sslcommerz') {
                    $order = Order::where('transID', $tansID)->first();
                    $order->payment_type_id = 6;
                    $order->status = 'Payment Pending';
                    $order->save();

                    $post_data = array();
                    $post_data['total_amount'] = $request->subTotal + $request->deliveryCharge; # You cant not pay less than 10
                    $post_data['currency'] = "BDT";
                    $post_data['tran_id'] = $tansID; // tran_id must be unique

                    # CUSTOMER INFORMATION
                    $post_data['cus_name'] = $request->customerName;
                    $post_data['cus_email'] = 'customer@mail.com';
                    $post_data['cus_add1'] = $request->customerAddress;
                    $post_data['cus_add2'] = '';
                    $post_data['cus_city'] = 'Dhaka';
                    $post_data['cus_state'] = 'Dhaka';
                    $post_data['cus_postcode'] = '';
                    $post_data['cus_country'] = 'Bangladesh';
                    $post_data['cus_phone'] = $request->customerPhone;
                    $post_data['cus_fax'] = "123456";

                    # SHIPMENT INFORMATION
                    $post_data['ship_name'] = $request->customerName;
                    $post_data['ship_add1'] = $request->customerAddress;
                    $post_data['ship_add2'] = '';
                    $post_data['ship_city'] = 'Dhaka';
                    $post_data['ship_state'] = 'Dhaka';
                    $post_data['ship_postcode'] = '';
                    $post_data['ship_phone'] = $request->customerPhone;
                    $post_data['ship_country'] = 'Bangladesh';

                    $post_data['shipping_method'] = "NO";
                    $post_data['product_name'] = "multivendor";
                    $post_data['product_category'] = "Goods";
                    $post_data['product_profile'] = "physical-goods";

                    $sslc = new SslCommerzNotification();
                    # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
                    $payment_options = $sslc->makePayment($post_data, 'hosted');


                    
                    
                    if (!is_array($payment_options)) {
                        print_r($payment_options);
                        $payment_options = array();
                    }
                }

                toastr()->info('Order Press Successfully', 'Complete', ["positionClass" => "toast-top-center"]);
                return redirect('order-received');
            } else {
                Customer::where('order_id', '=', $order->id)->delete();
                Orderproduct::where('order_id', '=', $order->id)->delete();
                Comment::where('order_id', '=', $order->id)->delete();
                Order::where('id', '=', $order->id)->delete();
                $response['status'] = 'failed';
                $response['message'] = 'Unsuccessful to press order';
            }
        }
    }

    public function uniqueID()
    {
        $lastOrder = Order::latest('id')->first();
        if ($lastOrder) {
            $orderID = $lastOrder->id + 1;
        } else {
            $orderID = 1;
        }

        return 'BG77'.$orderID;
    }

    public function updatepaymentmethood(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        $order->Payment = $request->payment_option;
        $order->update();
        Session::put('successfulor', 'successfulor');
        return redirect('order/complete');
    }

    public function getorder()
    {
        $from = date('Y-m-d'.' 00:00:00', time()); //need a space after dates.
        $to = date('Y-m-d'.' 24:60:60', time());


        $now = Carbon::now();
        $yesterday = Carbon::now()->subDays(5);

        $orders = DB::table('orders')->orderBy('id', 'DESC')->whereBetween('created_at',
            [$yesterday, $now])->take(200)->get();

        $orders->map(function ($order) {
            $order->products = DB::table('orderproducts')
                ->leftjoin('products', 'orderproducts.product_id', '=', 'products.id')
                ->where('orderproducts.order_id', $order->id)->select('products.*', 'orderproducts.*')->get();
            return $order;
        });

        $orders->map(function ($order) {
            $order->customers = DB::table('customers')->where('customers.order_id', $order->id)->select('customers.id',
                'customers.order_id', 'customers.customerName', 'customers.customerPhone',
                'customers.customerAddress')->get();
            return $order;
        });

        return response()->json($orders, 201);
    }

    public function getproduct()
    {
        $products = Product::select('id', 'ProductName', 'ProductSlug', 'ProductSku', 'ProductRegularPrice',
            'ProductSalePrice', 'ProductImage', 'ViewProductImage', 'status')->where('status', 'Active')->get();
        $response = [
            'status' => 's',
            'products' => $products,
        ];
        return $products;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}