@extends('layouts.master')
@section('title', 'Users List')
@section('subtitle', 'Manage the profiles of your users.')

@section('content')



<div class="card card-body shadow border-0 table-wrapper table-responsive">
  <div class="row justify-content-between align-items-center">
    <div class="col-lg-8 col-sm-12 ">
      <form class="navbar-search form-inline px-3" id="navbar-search-main">
        <div class="input-group input-group-merge search-bar">
          <span class="input-group-text" id="topbar-addon">
            <svg class="icon icon-xs" x-description="Heroicon name: solid/search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
            </svg>
          </span>
          <input type="text" class="form-control" id="topbarInputIconLeft" placeholder="Search By Email OR Name" aria-label="Search" aria-describedby="topbar-addon" name="search" value="{{Request::get('search')}}">
        </div>
      </form>
    </div>

    @can('user create')
    <div class="col-12 col-lg-4 col-xs-12 d-md-flex mt-1 text-center">
      <a href="{{route('user.create')}}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
        <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg> New User
      </a>
    </div>
    @endcan
  </div>

<table class="table user-table table-hover align-items-center  mt-4">
  <thead>
    <tr>
      <th class="border-bottom">Sr No </th>
      <th class="border-bottom">Name</th>
      <th class="border-bottom">Status</th>
      <th class="border-bottom">Roles</th>
      <th class="border-bottom">Date Created</th>
      <th class="border-bottom">Action</th>
    </tr>
  </thead>
  <tbody>
    @if(isset($user) && count($user)>0)
    @foreach($user as $key=>$userdata)
    <tr>
      <td>
        <div class="form-check dashboard-check">

          <label class="form-check-label" for="userCheck2">{{$key+1}}.</label>
        </div>
      </td>
      <td>
        <a class="d-flex align-items-center">
          <div class="avatar d-flex align-items-center justify-content-center fw-bold rounded bg-secondary me-3">
            <span>{{substr($userdata->name, 0, 1)}}</span>
          </div>
          <div class="d-block">
            <span class="fw-bold">{{$userdata->name}}</span>
            <div class="small text-gray">{{$userdata->email}}</div>
          </div>
        </a>
      </td>

      <td>
        <span class="fw-normal d-flex align-items-center">
          @if($userdata->isactive=='1')
          <svg class="icon icon-xxs text-success me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
          </svg> Active
          @else
          <svg class="icon icon-xxs text-danger me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
          </svg> Inactive
          @endif
        </span>
      </td>
      <td>
        <span class="fw-normal">{{$userdata->getRoleNames()}}</span>
      </td>

      <td>
        <span class="fw-normal">{{$userdata->created_at}}</span>
      </td>
      <td>
        @can('user edit')
        <a class="align-items-center" href="{{route('user.edit',$userdata->id)}}">
          <svg class="icon icon-xs me-2 text-dark" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
          </svg> </a>
        @endcan

      </td>
    </tr>
    <tr>
      @endforeach
      @endif
  </tbody>
</table>

</div>


@endsection