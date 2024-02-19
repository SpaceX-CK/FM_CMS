@extends('layouts.app')
@section('content')

<div class="container-fluid p-4">
  <div class="card card-radius">

    <div class="card-header" style="border: none;">
      <div class="row">
        <div class="col col-md-6">
          <h3 class="mb-0 ">Update Password</h3>
        </div>
      </div>
    </div>

    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="">Name</label>
            <p class="form-control" readonly>{{$user->name}}</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="">Email</label>
            <p class="form-control" readonly>{{$user->email}}</p>
          </div>
        </div>
      </div>
      <form id="user-edit-form" action="{{ route('user.update', $user->id)}}" method="POST">
        @csrf
        @method("PUT")
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Password*</label>
              <input type="password" name="password" class="form-control">
              <small>*Minimum 8 letters including number & symbol</small>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Confirmed Password</label>
              <input type="password" name="confirm_password" class="form-control">
              <small>*Minimum 8 letters including number & symbol</small>
            </div>
          </div>
        </div>


        <div class="col-md-3 p-0 m-0 pt-4">
          <button id="user-update-btn" class="btn btn-primary" type="submit" style="width:100%">Update</button>
        </div>
    </div>
    </form>

  </div>
</div>
@endsection

@section('js')
@endsection