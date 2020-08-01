<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Admin\BillingAddress;
use App\Models\Admin\Order;
use App\Models\Admin\OrderStatus;
use App\Models\Admin\ShippingAddress;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            $data = OrderStatus::where('order_status.deleted_at', NULL)->orderby('id','desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($data) {
                    $brand_name = User::where('id',$data->user_id)->where('deleted_at',NULL)->value('name');
                    return $brand_name;
                })
                ->addColumn('email', function ($data) {
                    $brand_name = User::where('id',$data->user_id)->where('deleted_at',NULL)->value('email');
                    return $brand_name;
                })
                ->addColumn('action', function ($data) {
                    $edit_url = route('admin::edit_order', ['id' => $data->id]);
                    $edit ='<a href="'.$edit_url.'" class="ajax_fancybox fancybox.iframe btn btn-sm btn-primary" data-toggle="tooltip" data-original-title="Edit" data-placement="top"><span class="glyphicon glyphicon-edit"></span></a><span id="status'.$data->id.'">&nbsp;';
                    return $edit;
                })
                ->rawColumns(['action','name','email'])
                ->toJson();
        }
        $pageTitle="Manage Order";
        return view('admin.order.index',compact('pageTitle'));
    }

    public function edit($id = null){
        $order = OrderStatus::where('id',$id)->first();
        $userDetails = User::where('id',$order->user_id)->first();
        $billingAddress = BillingAddress::where('order_id',$order->order_id)->first();
        $shippingAddress = ShippingAddress::where('order_id',$order->order_id)->first();
        $listOrders = Order::where('order_id',$order->order_id)->get();
        return view('admin.order.edit',compact('userDetails','billingAddress','shippingAddress','listOrders','order'));
    }

    public function print_order($id=null){
        $order = OrderStatus::where('id',$id)->first();
        $userDetails = User::where('id',$order->user_id)->first();
        $billingAddress = BillingAddress::where('order_id',$order->order_id)->first();
        $shippingAddress = ShippingAddress::where('order_id',$order->order_id)->first();
        $listOrders = Order::where('order_id',$order->order_id)->get();
        return view('admin.order.invoice',compact('userDetails','billingAddress','shippingAddress','listOrders','order'));
    }
}
