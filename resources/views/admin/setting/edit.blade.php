@extends('admin.layouts.fancybox')
@section('content')
    <style>
        .profile{
            text-align: center;
        }
    </style>
    <h4 class="mb"><b>Edit Setting</b></h4>
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
      @if(Session::has('error'))
        <div class="alert alert-danger profile">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>{{Session::get('error')}}</strong>
        </div>
    @endif
    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <form class="form-horizontal" action="{{route('admin::update_setting',$info['id'])}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Title</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{$info['title']}}" name="title" placeholder="Enter Site Name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Email</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" value="{{$info['email']}}" name="email" placeholder="Enter Site Email" />
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-md-3 control-label">Support Email</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" value="{{$info['support_email']}}" name="support_email" placeholder="Enter Support Email" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Mobile</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{$info['mobile']}}" name="mobile" placeholder="Enter Site Mobile" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Phone</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{$info['phone']}}" name="phone" placeholder="Enter Site Phone" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Facebook</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{$info['facebook']}}" name="facebook" placeholder="Enter Facebook Link" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Twitter</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{$info['twitter']}}" name="twitter" placeholder="Enter Twitter Link" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Goole Plus</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{$info['google_plus']}}" name="google_plus" placeholder="Enter Goole Plus Link" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Youtube</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{$info['youtube']}}" name="youtube" placeholder="Enter Youtube Link" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Copyright</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{$info['copyright']}}" name="copyright" placeholder="Enter Copyright" />
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-md-3 control-label">Address</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{$info['address']}}" name="address" placeholder="Enter Address" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Previous Image</label>
                        <div class="col-md-6">
                            <?php if($info['logo']!=''){?>
                                <img src="{{url($info['logo'])}}" height="100px" width="100px" id="blah">
                           <?php }else{?>
                            <img src="{{url('admin/img/No-Image.png')}}" height="100px" width="100px" id="blah">
                        <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Image</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control" name="image" placeholder="Choose file" id="image" />
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
