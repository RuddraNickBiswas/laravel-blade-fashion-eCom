@extends('frontend.dashboard.dashboard')


@section('sidebar_content')
    <div id="snav-content1">

   <div class="tabs mx-auto mb-0 clearfix">

                    <ul class="tab-nav tab-nav2 center clearfix">
                        <li class="inline-block"><a href="#tab-login">Profile</a></li>
                        <li class="inline-block"><a href="#tab-register">Security</a></li>
                    </ul>

                    <div class="tab-container">

                        <div class="tab-content" id="tab-login">
                            <div class="card mb-0">
                                <div class="card-body" style="padding: 40px;">
                                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')

                                        <div class="form-group">
                                            <label for="avater">Profile Image</label>
                                            <div class="d-flex align-items-end mb-2">
                                                <img id="showImage" src="{{ asset(auth()->user()->avater) }}" width="250"  class="rounded me-2">
                                                {{-- <img id="showImage" src="{{ auth()->user()->avater }}" width="150" class="rounded d-block"> --}}
                                            </div>
                                            <input class="form-control " name="avater" type="file" id="image" />
                                        </div>
                            
                                        <div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Name</label>
                                                    <input class="form-control " name="name" value = "{{ auth()->user()->name }}" />
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Email</label>
                                                    <input class="form-control " name="email" value = "{{ auth()->user()->email }}" type="email" />
                                                </div>
                                            </div>
                                        </div> 

                            

                                            <div class="col-12 form-group">
                                            </div>
                                            <button class="button button-3d button-black m-0" 
                                                name="submit" value="login" type="submit"   >Save</button>
                                          
                                    

                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content" id="tab-register">
                            <div class="card mb-0">
                                <div class="card-body" style="padding: 40px;">
                                    <h3>Reset Password</h3>

                                    <form method="POST" action="{{ route('profile.password.update') }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="col-12 form-group">
                                            <label for="register-form-name">Current Password</label>
                                            <input type="password" id="register-form-name" name="current_password" required
                                                value="" class="form-control" />
                                        </div>

                                        <div class="col-12 form-group">
                                            <label for="register-form-password">Choose Password:</label>
                                            <input type="password" id="register-form-password" name="password" :value="old('password')" required
                                                value="" class="form-control" />
                                        </div>

                                        <div class="col-12 form-group">
                                            <label for="register-form-repassword">Re-enter Password:</label>
                                            <input type="password" id="register-form-repassword"
                                               name="password_confirmation" required  value="" class="form-control" />
                                        </div>

                                        <div class="col-12 form-group">
                                            <button class="button button-3d button-black m-0" id="register-form-submit"
                                                name="register-form-submit" type="submit" value="register">Save</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>


        <form action="">
      



        </form>

    </div>
    @endsection
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                $('#image').change(function(e) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#showImage').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(e.target.files['0']);
                });
            });
        </script>
    @endpush
