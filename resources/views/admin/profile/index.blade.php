@extends('admin.layouts.fancybox')
@section('content')
<style>

</style>
<h4 class="mb"><b>Admin Profile</b></h4>
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
    <!-- BASIC FORM ELELEMNTS -->
    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <form class="form-horizontal style-form" action="{{route('admin::profile_update')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$userById->id}}">
                    <div class="row">
                        <div class="col-sm-4 image-div">
                            <label class="col-sm-2 col-sm-2 control-label profile">Previous Image</label>
                        </div>
                        <div class="col-sm-4 image-div">
                            <div class="col-sm-10">
                                @if($userById->image!='')
                                    <img src="{{url('/')}}/admin/img/admin_profile/{{$userById->image}}" height="200px" width="200px" id="blah">
                                @else
                                    <img src="{{url('/')}}/admin/img/No-Image.png" height="200px" width="200px" id="blah">
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-4 image-div">
                            <input type="file" name="image" id="file" class="inputfile" />
                            <label for="file">Choose a image</label>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label profile">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control profile" value="{{$userById['name']}}" placeholder="Enter The Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control profile" value="{{$userById['email']}}" placeholder="Enter The Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Phone</label>
                        <div class="col-sm-10">
                            <input type="text" name="phone" class="form-control profile" value="{{$userById['phone']}}" placeholder="Enter The Phone Number">
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Gender</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="gender" id="gender">
                                <option>Select Gender</option>
                                <option value="Male" <?php if($userById['gender']=='Male'){ echo 'selected';}?>>Male</option>
                                <option value="Female" <?php if($userById['gender']=='Female'){ echo 'selected';}?>>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">User Type</label>
                        <div class="col-sm-10">
                            <input class="form-control profile" id="disabledInput" type="text" value="{{$userById['role']}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12" style="text-align: center">
                            <input type="submit" class="btn btn-theme" style="text-align: center" value="Update Profile">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- col-lg-12-->
    </div>
    @push('scripts')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }
            reader.readAsDataURL(input.files[0]);
            }
        }
        $("#file").change(function() {
            readURL(this);
        });  
    </script>
    @endpush
@endsection
