@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Profile</h1>
        <hr>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('edit-profile-post') }}" method="POST" class="form example">
            @csrf

            <div class="form-group">
                <label class="col-md-3 control-label">Username:</label>
                <div class="col-md-8">
                    <input name="name" class="form-control" type="text" value="{{ old('name', $user->name) }}">
                    @error('name')
                    <label style="color: brown">{{ $message }}</label>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Email:</label>
                <div class="col-md-8">
                    <input name="email" class="form-control" type="text" value="{{ old('email', $user->email) }}">
                    @error('email')
                    <label style="color: brown">{{ $message }}</label>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label"></label>
                <div class="col-md-8">
                    <input type="submit" class="btn btn-primary" value="Save Changes">
                    <input type="reset" class="btn btn-default" value="Cancel">
                </div>
            </div>
        </form>
    </div>
    <hr>
@endsection
