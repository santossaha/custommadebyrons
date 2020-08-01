@extends('admin.layouts.fancybox')
@section('content')
    <style>
        .profile{
            text-align: center;
        }
    </style>
    <h4 class="mb"><b>Add Admin</b></h4>
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

    <!-- BASIC FORM ELELEMNTS -->
    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <form class="form-horizontal" action="{{route('admin::save_admin')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="name" placeholder="Enter Name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Email</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" placeholder="Enter Email" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Phone</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Gender</label>
                        <div class="col-md-6">
                           <select class="form-control" name="gender">
                               <option>Select Gender</option>
                               <option value="Male">Male</option>
                               <option value="Female">Female</option>
                           </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Password</label>
                        <label><span onclick="pass_gen()" data-toggle="modal" data-target="#password_generate"  class="label label-primary">Generate password</span></label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Confirm Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Enter confirm password" />
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-md-3 control-label">Image</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control" name="image" placeholder="Choose file" />
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
    </div>
    <div id="password_generate" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center">Password Generator</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input class="form-control gen_password_field" readonly type="text" id="copyTarget" value="Text to Copy">
                </div>
                <div class="modal-footer text-center">
                    <button type="button" id="regenerate_password" class="btn btn-warning" onClick="reg_pass()">Re-Generate</button>
                    <button type="button" id="copyButton" class="btn btn-success">Copy & Paste</button>
                </div>
            </div>

        </div>
    </div>
    @push('scripts')
    <script>
        function pass_gen()
        {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for (var i = 0; i < 8; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));
            $('#copyTarget').val(text);
           // $('#password_generate').modal('show');
        }
 function reg_pass(){
    var text = "";
    var possible = "!#$%^&ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for (var i = 0; i < 8; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));
    $('#copyTarget').val(text);
  }
  function copyToClipboard(elem) {
            // create hidden text element, if it doesn't already exist
            var targetId = "_hiddenCopyText_";
            var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
            var origSelectionStart, origSelectionEnd;
            if (isInput) {
                // can just use the original source element for the selection and copy
                target = elem;
                origSelectionStart = elem.selectionStart;
                origSelectionEnd = elem.selectionEnd;
            } else {
                // must use a temporary form element for the selection and copy
                target = document.getElementById(targetId);
                if (!target) {
                    var target = document.createElement("textarea");
                    target.style.position = "absolute";
                    target.style.left = "-9999px";
                    target.style.top = "0";
                    target.id = targetId;
                    document.body.appendChild(target);
                }
                target.textContent = elem.textContent;
            }
            // select the content
            var currentFocus = document.activeElement;
            target.focus();
            target.setSelectionRange(0, target.value.length);

            // copy the selection
            var succeed;
            try {
                succeed = document.execCommand("copy");
            } catch(e) {
                succeed = false;
            }
            // restore original focus
            if (currentFocus && typeof currentFocus.focus === "function") {
                currentFocus.focus();
            }

            if (isInput) {
                // restore prior selection
                elem.setSelectionRange(origSelectionStart, origSelectionEnd);
            } else {
                // clear temporary content
                target.textContent = "";
            }
            return succeed;
        }
         $('#copyButton').click(function(){
            //alert('1');
            var new_password = $('#copyTarget').val();
            //alert(new_password);
            $('input[name=password]').val(new_password);
            $('input[name=cpassword]').val(new_password);
        });
        document.getElementById("copyButton").addEventListener("click", function() {
            copyToClipboard(document.getElementById("copyTarget"));
            setTimeout(function(){ $(".close").click(); }, 1);
        });
    </script>
    @endpush
@endsection
