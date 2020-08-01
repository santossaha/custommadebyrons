@extends('admin.layouts.fancybox')
@section('content')
    <style>
        .profile{
            text-align: center;
        }
    </style>
    <h4 class="mb"><b>Edit Delivery Charge</b></h4>
    @if ($errors->any())
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
    @endif
    @if(Session::has('success'))
        <div class="alert alert-success profile">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>{{Session::get('success')}}</strong>
        </div>
    @endif
    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <form class="form-horizontal" action="{{route('admin::updateDeliveryCharge',$info['id'])}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Min Amount</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{$info['min_delivery_charge']}}" id="min_delivery_charge" name="min_delivery_charge" readonly placeholder="Enter Min Amount" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Max Amount</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{$info['max_delivery_charge']}}" id="max_delivery_charge" name="max_delivery_charge" placeholder="Enter Max Amount" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Delivery Charge <small>(Delivery charge will be applicable. if the less than max amount is exceeded)</small></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{$info['delivery_amount']}}" id="delivery_amount" name="delivery_amount" placeholder="Enter Delivery Amount" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12" style="text-align: center">
                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- col-lg-12-->
    </div>

@endsection
