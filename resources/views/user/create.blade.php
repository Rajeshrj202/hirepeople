@extends('layouts.master')
@section('title', 'Add Users')
@section('subtitle', 'Fill out the user profiles below, then press the "Save" button.')

@section('content')

<div class="col-12 col-xl-8">
  <div class="card card-body border-0 shadow mb-4">
    <h2 class="h5 mb-4">General information</h2>
    <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">

      @csrf
      <div class="row">
        <div class="col-md-6 mb-3">
          <div>
            <label for="first_name">Name</label>
            <input class="form-control" id="name" name="name" type="text" placeholder="Enter User name" required="" value="{{old('name')}}">
            @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <div>
            <label for="email">Email</label>
            <input class="form-control" id="email" name="email" type="email" placeholder="Enter User email" required="" value="{{old('email')}}">
            @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
          </div>
        </div>

      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <div>
            <label for="last_name">Password</label>
            <input class="form-control" id="password" type="password" min="1" max="100" placeholder="Enter Password" required="" name="password">
            @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <div>
            <label for="last_name">Confirm Password</label>
            <input class="form-control" id="password_confirmation" type="text" min="1" max="100" placeholder="Confirm password" required="" name="password_confirmation">
            @if ($errors->has('password_confirmation'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
            @endif
          </div>
        </div>
      </div>




      <div class="col-md-6 mb-3">
        <div class="form-group">
          <label for="phone">Assign Role</label>
          <select required class="select2 form-control  @error('role') {{'is-invalid'}} @enderror" id="channel-id" name="role">
            <option value="">Select Role</option>
            @if(isset($roles) && count($roles)>0)
            @foreach($roles as $rolesdata)
            <option value="{{ $rolesdata->name }}" @if(old('role')==$rolesdata->name) selected @endif >{{ $rolesdata->name }}</option>
            @endforeach
            @endif
          </select>
          @if ($errors->has('role'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('role') }}</strong>
          </span>
          @endif
        </div>
      </div>

      <div class="mt-3">
        <button class="btn btn-gray-800 mt-2 animate-up-2" type="submit">Save User</button>
        <a class="btn btn-secondary mt-2 animate-up-2" type="button" href="{{route('user.index')}}">Back</a>
      </div>
    </form>
  </div>

</div>

@endsection