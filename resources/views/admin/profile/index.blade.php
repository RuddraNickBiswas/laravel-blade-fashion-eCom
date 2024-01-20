@extends('admin.layouts.master')

@section('page-title', 'Profile')

@section('content')
 

            <div class="card card-primary">
                <div class="card-header">
                    <h4>Profile Setting</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <div id="image-preview" class="image-preview">
                                <label for="image-upload" id="image-label">Choose File</label>
                                <input type="file" name="avater" id="image-upload" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}"
                                required>
                        </div>

                        <button class="btn btn-primary" type="submit">save</button>
                    </form>

                </div>
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <h4>Profile Security</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.profile.password.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" name="current_password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                        <button class="btn btn-primary" type="submit">save</button>

                    </form>


                </div>
            </div>

            <div class="section-body">
            </div>
     

    @push('script')
        <script>
            $(document).ready(function(){
                $('.image-preview').css({
                    'background-image' : 'url({{ asset(auth()->user()->avater)}})',
                    'background-size' :'cover',
                    'background-position' :'center center',
                    
                })
            })
        </script>
    @endpush

@endsection
