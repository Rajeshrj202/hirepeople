@extends('layouts.master')
@section('title', 'Candidates List')
@section('subtitle', 'Manage the profiles of your candidates.')

@section('content')



<div class="card card-body shadow border-0 table-wrapper table-responsive">
  <div class="btn-toolbar mb-2 mb-md-0">
    <div class="d-flex ">
      <form class="navbar-search form-inline px-3" id="navbar-search-main">
        <div class="input-group input-group-merge search-bar">
          <span class="input-group-text" id="topbar-addon">
            <svg class="icon icon-xs" x-description="Heroicon name: solid/search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
            </svg>
          </span>
          <input type="text" class="form-control" id="topbarInputIconLeft" placeholder="Search By Status,Email OR Name" aria-label="Search" aria-describedby="topbar-addon" name="search" value="{{Request::get('search')}}">
        </div>
      </form>
      @can('candidate create')
      <a href="{{route('candidate.create')}}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
        <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg> New Candidate
      </a>
      @endcan
    </div>
  </div>
  <table class="table user-table table-hover align-items-center mt-4">
    <thead>
      <tr>
        <th class="border-bottom">
          <div class="form-check dashboard-check">

            <label class="form-check-label" for="userCheck55">Sr No</label>
          </div>
        </th>
        <th class="border-bottom">Name</th>
        <th class="border-bottom">Designation</th>
        <th class="border-bottom">Application Status</th>
        <th class="border-bottom">Assigned To</th>
        <th class="border-bottom">Date Created</th>
        <th class="border-bottom">Action</th>
      </tr>
    </thead>
    <tbody>
      @if(isset($candidate) && count($candidate)>0)
      @foreach($candidate as $key=>$candidatedata)
      <tr>
        <td>
          <div class="form-check dashboard-check">

            <label class="form-check-label" for="userCheck2">{{$key+1}}.</label>
          </div>
        </td>
        <td>
          <a href="#" class="d-flex align-items-center">
            <div class="avatar d-flex align-items-center justify-content-center fw-bold rounded bg-secondary me-3">
            <span>{{substr($candidatedata->candidate_name, 0, 1)}}</span>
            </div>
            <div class="d-block">
              <span class="fw-bold">{{$candidatedata->candidate_name}}</span>
              <div class="small text-gray">{{$candidatedata->candidate_email}}</div>
            </div>
          </a>
        </td>
        <td>
          <span class="fw-normal">{{$candidatedata->designation_name}}</span>
        </td>
        <td>
          <span class="fw-normal d-flex align-items-center">
            @if($candidatedata->status_id=='1')
            <svg class="icon icon-xxs text-success me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            @endif
            @if($candidatedata->status_id=='2')
            <svg class="icon icon-xxs text-danger me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
            </svg>
            @endif
            @if($candidatedata->status_id=='3')
            <svg class="icon icon-xxs text-danger me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
            </svg>
            @endif
            @if($candidatedata->status_id=='4')
            <svg class="icon icon-xxs text-warning me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z" clip-rule="evenodd"></path>
            </svg>
            @endif {{$candidatedata->status_name}} </span>
        </td>
        <td>
          <span class="fw-normal">{{$candidatedata->assigned_to}}</span>
        </td>
        <td>
          <span class="fw-normal">{{$candidatedata->created_at}}</span>
        </td>
        <td>
          @can('candidate show')
          <a class="align-items-center" href="{{route('candidate.show',$candidatedata->candidate_id)}}">
            <svg class="icon icon-xs me-2 text-dark" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
              <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
            </svg>
          </a>
          @endcan

          @can('candidate edit')
          <a class="align-items-center" href="{{route('candidate.edit',$candidatedata->candidate_id)}}">
            <svg class="icon icon-xs me-2 text-dark" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
              <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
            </svg>
          </a>
          @endcan

        </td>
      </tr>
      <tr>
        @endforeach
        @endif
    </tbody>
  </table>
  <div class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">

  </div>
</div>


@endsection