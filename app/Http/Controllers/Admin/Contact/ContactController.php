<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Models\Admin\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            $data=Contact::where('deleted_at',NULL)->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $url_delete = "'".route('admin::delete_contact', ['id' => $data->id])."'";
                    $edit_url = route('admin::edit_contact', ['id' => $data->id]);
                    $edit ='<a href="'.$edit_url.'" class="ajax_fancybox fancybox.iframe btn btn-sm btn-primary" data-toggle="tooltip" data-original-title="Edit" data-placement="top"><span class="glyphicon glyphicon-edit"></span></a><span id="status'.$data->id.'">&nbsp;';
                    $edit.='</span>';
                    $edit.=' <a data-toggle="modal" data-target="#confirmDelete" class="btn btn-sm btn btn-danger" onclick="getDeleteRoute('.$url_delete.')"><span class="glyphicon glyphicon-trash"></span></a>&emsp;';
                    return $edit;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        $pageTitle="Contact";
        return view('admin.contact.index',compact('pageTitle'));
    }


    public function edit($id=null){
        $view = Contact::where('id', $id)->first();
        return view('admin.contact.edit', compact('view'));
    }

    public function delete($id)
    {
        Contact::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Contact us Deleted Successfully !!!');
    }
}
