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
                    <label for="avater">Profile Image</label>
                    <div class="d-flex align-items-end mb-2">
                        <img id="showImage" src="{{ asset(auth()->user()->avater) }}" width="250" class="rounded me-2">
                        {{-- <img id="showImage" src="{{ auth()->user()->avater }}" width="150" class="rounded d-block"> --}}
                    </div>
                    <input class="form-control " name="avater" type="file" id="image" />
                </div>

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
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
