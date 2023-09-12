@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="">{{ __('Profile') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">{{ __('Profile') }}</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ Session::get('message') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <section class="col-lg-12 connectedSortable am-profile">
                    <div class="card">
                        <form action="{{ route('profile.update') }}" method="post">
                            @csrf
                            @method('patch')

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">  
                                            <label>Name <span style="color: red;">*</span><span></span></label>
                                            <input type="text" class="form-control"  name="name" id="name" placeholder="Name" value="{{Auth::user()['name']}}">
                                            @if($errors->has('name'))
                                                <div class="error">{{ $errors->first('name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Email <span style="color: red;">*</span><span></span></label>
                                            <input type="text" class="form-control" placeholder="Email" name="email" id="email" value="{{Auth::user()['email']}}">
                                            @if($errors->has('email'))
                                                <span class="error">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label>Password <span></span></label>
                                        <div class="form-group">
                                            <div class="input-group input-group-merge form-password-toggle"> 
                                                <input type="password" class="form-control form-control-merge"  name="password" placeholder="Password" id="password" value="" >
                                                <div class="input-group-append">
                                                    <span class="input-group-text cursor-pointer"><i  class="fa fa-eye icon"></i></span>
                                                </div>
                                            </div>
                                            @if($errors->has('password'))
                                                <span class="error">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                    </div> 
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Confirm Password <span></span></label>
                                            <div class="input-group input-group-merge form-password-toggle">
                                                <input type="password" class="form-control form-control-merge"  name="confirm_password" placeholder="Confirm Password" id="confirm_password" value="" >
                                                <div class="input-group-append">
                                                    <span class="input-group-text cursor-pointer"><i  class="fa fa-eye icon-conf"></i></span>
                                                </div>
                                            </div>
                                            @if($errors->has('confirm_password'))
                                                <span class="error">{{ $errors->first('confirm_password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <div class=""> 
                                                <label for="banner_image">Profile Image 
                                            </label>
                                            </div>
                                            
                                            @php
                                            $profile_image = asset('uploads/download.png');
                                            if(file_exists(Auth::user()['profile_image']))
                                            {
                                                $profile_image = asset(Auth::user()['profile_image']);
                                            }
                                            @endphp

                                            <div class="custom-file">
                                                   <label for="upload_image">
                                                    <img src="{{$profile_image}}" id="uploaded_image" class="img-responsive img-circle" />
                                                    <div class="overlay">
                                                        <div class="text">Click to Change Profile Image</div>
                                                    </div>
                                                    <input type="file" name="image" class="image" accept=".jpg, .jpeg, .png, .webp" id="upload_image" style="display:none" />
                                                </label>
                                             </div>
                                             <div class="profile_image_error" style="color:red"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success update-profile">Update</button>
                                <a href="{{ route('articles') }}" class="btn btn-danger">Exit</a>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Image Before Upload</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="" id="sample_image" />
                        </div>
                        <div class="col-md-4">
                            <div class="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="crop" class="btn btn-success">Update</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Exit</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
<script src="https://unpkg.com/cropperjs@1.5.13/dist/cropper.js"></script>

<script type="text/javascript">
    $(document).ready(function(){

        $('.icon').click(function () {
            $('#password').attr('type', 'text');
            setTimeout(function(){ 
                $('#password').attr('type', 'password');
            }, 200); 
        });
        $('.icon-conf').click(function () {
            $('#confirm_password').attr('type', 'text');
            setTimeout(function(){ 
                $('#confirm_password').attr('type', 'password');
            }, 200); 
        });

    var $modal = $('#modal');

    var image = document.getElementById('sample_image');

    var cropper;

    $('#upload_image').change(function(event){
        var files = event.target.files;

        var done = function(url){
            image.src = url;
            $modal.modal('show');
        };

        if(files && files.length > 0)
        {
            reader = new FileReader();
            reader.onload = function(event)
            {
                done(reader.result);
            };
            reader.readAsDataURL(files[0]);
        }
    });

    $modal.on('shown.bs.modal', function() {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            preview:'.preview',
        });
    }).on('hidden.bs.modal', function(){
        cropper.destroy();
        cropper = null;
    });

    $('#crop').click(function(){
        canvas = cropper.getCroppedCanvas({
            width:400,
            height:400
        });

        canvas.toBlob(function(blob){
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function(){
                var base64data = reader.result;
                $.ajax({
                headers : {'X-CSRF-Token': $('input[name="_token"]').val()},
                type: 'POST',
                url: "{{route('profile.image.update')}}",
                data:{image:base64data},
                    success:function(data)
                    {
                        $modal.modal('hide');
                        $('#uploaded_image').attr('src', data);
                        location.reload();
                    }
                });
            };
        });
    });
});
</script>
@endsection