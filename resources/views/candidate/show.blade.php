@extends('layouts.master')
@section('title', 'Candidates Details')
@section('subtitle', 'Manage Candidates Application Feedbacks')

@section('content')

<div class="card card-body border-0 shadow mb-4 mb-xl-0">
  <div class="row align-items-center d-block d-sm-flex border-bottom pb-4 mb-4">
    <div class="col-auto mb-3 mb-sm-0">
      <div class="calendar d-flex">
        <span class="calendar-month">{{date('M',strtotime($candidatedata->updated_at))}}</span>
        <span class="calendar-day py-2">{{date('y',strtotime($candidatedata->updated_at))}}</span>
      </div>
      <p> Upated </p>
    </div>
    <div class="col">
      <a>
        <h3 class="h5 mb-1">{{$candidatedata->candidate_name}}</h3>
      </a>
      <div class="small mt-1"><b>Created By</b> : {{$candidatedata->created_by}}</div>
      <div class="small mt-1"><b>Experience</b> : {{$candidatedata->candidate_experience}} Years</div>
      <div class="small mt-1"><b>Appiled For Designation</b> : {{$candidatedata->designation_name}}</div>
      <div class="small mt-1"><b>Current Application Status</b> :
        @if($candidatedata->status_id=='1')
        <svg class="icon icon-xxs text-success me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
        @endif
        @if($candidatedata->status_id=='2')
        <svg class="icon icon-xxs text-danger me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
        </svg>
        @endif
        @if($candidatedata->status_id=='3')
        <svg class="icon icon-xxs text-danger me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
        </svg>
        @endif
        @if($candidatedata->status_id=='4')

        <svg class="icon icon-xxs text-danger me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z" clip-rule="evenodd"></path>
        </svg>
        @endif

        {{$candidatedata->status_name}}

      </div>

      <div class="small mt-1"><b>Resume</b> : <a target="_blank" href="{{route('candidate.streampdf',$candidatedata->candidate_id)}}"><svg class="icon " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
          </svg> Click to view resume</a></div>
    </div>
  </div>
</div>

<div class="col-9 mt-3">

  @if(isset($candidatefeedbacks) && count($candidatefeedbacks)>0)
  @foreach($candidatefeedbacks as $candidatefeedbacksdata)
  <div class="card border-0 shadow p-4 mb-4">
    <div class="d-flex justify-content-between align-items-center mb-2">
      <span class="font-small">
        <a href="#">
          <img class="avatar-sm img-fluid rounded-circle me-2" src="{{asset('images/profile.png')}}" alt="avatar">
          <span class="fw-bold">{{$candidatefeedbacksdata->created_by}}</span>
        </a>
        <span class="fw-normal ms-2">{{$candidatefeedbacksdata->created_at}}</span>
      </span>
      <div class="d-none d-sm-block">
        <svg class="icon icon-xs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
        </svg>
      </div>
    </div>
    <p class="m-0">{{$candidatefeedbacksdata->feedback}}</p>
    <div class="small text-dark"> Designation: {{$candidatefeedbacksdata->designation_name}}</div>
    <div class="small text-dark"> Application Status:
      @if($candidatedata->status_id=='1')
      <svg class="icon icon-xxs text-success me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
      </svg>
      @endif
      @if($candidatedata->status_id=='2')
      <svg class="icon icon-xxs text-danger me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
      </svg>
      @endif
      @if($candidatedata->status_id=='3')
      <svg class="icon icon-xxs text-danger me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
      </svg>
      @endif
      @if($candidatedata->status_id=='4')

      <svg class="icon icon-xxs text-danger me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z" clip-rule="evenodd"></path>
      </svg>
      @endif
      {{$candidatefeedbacksdata->status_name}}
    </div>
  </div>
  @endforeach
  @endif





</div>
@can('candidate feedback')

<form action="{{route('candidate.feedback.store',$candidatedata->candidate_id)}}" method="post" class="mt-4 mb-5">
  @csrf
  <textarea name="feedback" class="form-control border-0 shadow mb-4" id="message" placeholder="Your Message" rows="6" maxlength="1000" required=""></textarea>
  @if ($errors->has('feedback'))
  <span class="invalid-feedback" role="alert">
    <strong>{{ $errors->first('feedback') }}</strong>
  </span>
  @endif
  <div class="text-right align-items-center mt-3">
    @if($candidatedata->status_id=='3')
    <div class="col-md-6 mb-3">
      <div class="form-group">
        <label for="phone">Application Status</label>
        <select required class="select2 form-control  @error('status_id') {{'is-invalid'}} @enderror" id="channel-id" name="status_id">
          <option value="">Select Application Status</option>
          @if(isset($status) && count($status)>0)
          @foreach($status as $statusdata)
          <option value="{{ $statusdata->status_id }}" @if($statusdata->status_id==$candidatedata->status_id) selected @endif >{{ $statusdata->status_name }}</option>
          @endforeach
          @endif
        </select>
        @if ($errors->has('status_id'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('status_id') }}</strong>
        </span>
        @endif
      </div>
    </div>
    @else
    <div class="alert alert-danger alert-dismissible fade show">
      Candidate Application has been {{$candidatedata->status_name}} Cannot update Application Status !
    </div>
    @endif
    <div>
      <button type="submit" class="btn btn-gray-800 d-inline-flex align-items-center text-white">
        <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M7.707 3.293a1 1 0 010 1.414L5.414 7H11a7 7 0 017 7v2a1 1 0 11-2 0v-2a5 5 0 00-5-5H5.414l2.293 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
        </svg> Update FeedBack
      </button>
      @can('candidate index')
      <a class="btn btn-secondary animate-up-2" type="button" href="{{route('candidate.index')}}">Back</a>
      @endcan
      @can('candidate assigned')
      <a class="btn btn-secondary animate-up-2" type="button" href="{{route('candidate.assigned')}}">Back</a>
      @endcan
    </div>
  </div>
</form>

@endcan
@endsection