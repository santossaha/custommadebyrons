<?php

namespace App\Http\Controllers\Admin\Delivery;

use App\Models\Admin\Delivery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class DeliveryController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            $data=Delivery::orderBy('id','desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $edit_url = route('admin::editDeliveryCharge', ['id' => $data->id]);
                    $edit ='<a href="'.$edit_url.'" class="ajax_fancybox fancybox.iframe btn btn-sm btn-primary" data-toggle="tooltip" data-original-title="Edit" data-placement="top"><span class="glyphicon glyphicon-edit"></span></a><span id="status'.$data->id.'">&nbsp;';
                    return $edit;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        $pageTitle="Deliver Charge";
        return view('admin.delivery_charge.index',compact('pageTitle'));
    }

    public function edit($id){
        $info = Delivery::where('id', $id)->first();
        return view('admin.delivery_charge.edit', compact('info'));
    }
    public function update(Request $request,$id)
    {
        $msg = [
            'max_delivery_charge.required' => 'Enter Max Amount.',
            'delivery_amount.required' => 'Enter Delivery Charge.',
        ];
        $this->validate($request, [
            'max_delivery_charge' => 'required',
            'delivery_amount' => 'required',
            //'image' => 'mimes:jpeg,jpg,png|required|false'
        ], $msg);

        Delivery::where('id',$id)->update([
            'max_delivery_charge' => $request->get('max_delivery_charge'),
            'delivery_amount' =>$request->get('delivery_amount'),
        ]);
        return redirect()->back()->with('success', 'Delivery Charge Updated Successfully !!!');
    }
}
