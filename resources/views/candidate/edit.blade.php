@extends('layouts.master')
@section('title', 'Edit Candidates')
@section('subtitle', 'After updating the candidate profiles below, click "Update" button.')

@section('content')

<div class="col-12 col-xl-8">
  <div class="card card-body border-0 shadow mb-4">
    <h2 class="h5 mb-4">General information</h2>
    <form action="{{ route('candidate.update',$candidatedata->candidate_id) }}" method="post" enctype="multipart/form-data">

      @csrf
      <div class="row">
        <div class="col-md-6 mb-3">
          <div>
            <label for="first_name">Name</label>
            <input class="form-control" id="candidate_name" name="candidate_name" type="text" placeholder="Enter candidate name" required="" value="{{$candidatedata->candidate_name}}">
            @if ($errors->has('candidate_name'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('candidate_name') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <div>
            <label for="candidate_email">Email</label>
            <input class="form-control" id="candidate_email" name="candidate_email" type="email" placeholder="Enter candidate email" required="" value="{{$candidatedata->candidate_email}}">
            @if ($errors->has('candidate_email'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('candidate_email') }}</strong>
            </span>
            @endif
          </div>
        </div>

      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <div>
            <label for="last_name">Experience (yrs)</label>
            <input class="form-control" id="candidate_experience" type="number" min="1" max="100" placeholder="Enter candidate Experience" required="" name="candidate_experience" value="{{$candidatedata->candidate_experience}}">
            @if ($errors->has('candidate_experience'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('candidate_experience') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <div class="form-group">
            <label for="email">Applied for (Designation)</label>
            <select class="form-select mb-0" name="designation_id" id="designation_id">
              <option value="0" selected="selected">Select Designation </option>
              @if(isset($designation) && count($designation)>0)
              @foreach($designation as $designationdata)
              <option value="{{ $designationdata->designation_id }}" @if($designationdata->designation_id==$candidatedata->designation_id) selected @endif>{{ $designationdata->designation_name }}</option>
              @endforeach
              @endif
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <div class="form-group">
            <label for="phone">Current CTC</label>
            <input class="form-control" id="phone" type="number" min="1" required="" name="current_ctc" value="{{$candidatedata->current_ctc}}">
            @if ($errors->has('current_ctc'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('current_ctc') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <div class="form-group">
            <label for="phone">Expected CTC</label>
            <input class="form-control" id="phone" type="number" min="1" required="" name="expected_ctc" value="{{$candidatedata->expected_ctc}}">
            @if ($errors->has('expected_ctc'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('expected_ctc') }}</strong>
            </span>
            @endif
          </div>
        </div>
      </div>



      <div class="col-md-6 mb-3">
        <div class="form-group">
          <label for="phone">Assigned Team Lead</label>
          <select required class="select2 form-control  @error('user_id') {{'is-invalid'}} @enderror" id="channel-id" name="user_id">
            <option value="">Select Team Lead</option>
            @if(isset($teamlead) && count($teamlead)>0)
            @foreach($teamlead as $teamleaddata)
            <option value="{{ $teamleaddata->id }}" @if($teamleaddata->id==$candidatedata->user_id) selected @endif >{{ $teamleaddata->name }}</option>
            @endforeach
            @endif
          </select>
          @if ($errors->has('user_id'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('user_id') }}</strong>
          </span>
          @endif
        </div>
      </div>


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


      <div class="col-md-6 mb-3">
        <label for="formFile" class="form-label">Upload Resume</label>
        <input class="form-control" type="file" name="resume">
        @if ($errors->has('resume'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('resume') }}</strong>
        </span>
        @endif
      </div>

      <div class="bold">Resume : <a target="_blank" href="{{route('candidate.streampdf',$candidatedata->candidate_id)}}"><svg class="icon " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
          </svg> Click to view Resume</a></div>

      <div class="mt-3">
        <button class="btn btn-gray-800 mt-2 animate-up-2" type="submit">Update Candidate</button>
        <a class="btn btn-secondary mt-2 animate-up-2" type="button" href="{{route('candidate.index')}}">Back</a>
      </div>
    </form>
  </div>

</div>

@endsection