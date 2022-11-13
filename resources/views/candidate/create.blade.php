@extends('layouts.master')
@section('title', 'Add Candidates')
@section('subtitle', 'Fill out the candidate profiles below, then press the "Save" button.')

@section('content')

<div class="col-12 col-xl-8">
  <div class="card card-body border-0 shadow mb-4">
    <h2 class="h5 mb-4">General information</h2>
    <form action="{{ route('candidate.store') }}" method="post" enctype="multipart/form-data">

      @csrf
      <div class="row">
        <div class="col-md-6 mb-3">
          <div>
            <label for="first_name">Name</label>
            <input class="form-control" id="candidate_name" name="candidate_name" type="text" placeholder="Enter candidate name" required="" value="{{old('candidate_name')}}">
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
            <input class="form-control" id="candidate_email" name="candidate_email" type="email" placeholder="Enter candidate email" required="" value="{{old('candidate_email')}}">
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
            <input class="form-control" id="candidate_experience" type="number" min="1" max="100" placeholder="Enter candidate Experience" required="" name="candidate_experience" value="{{old('candidate_experience')}}">
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <div class="form-group">
            <label for="email">Applied for (Designation)</label>
            <select class="form-select mb-0" name="designation_id" id="designation_id">
              <option value="0" selected="selected">Select Designation </option>
              @if(isset($designation) && count($designation)>0)
              @foreach($designation as $designationdata)
              <option value="{{ $designationdata->designation_id }}" @if(old('designation_id')==$designationdata->designation_id) selected @endif >{{ $designationdata->designation_name }}</option>
              @endforeach
              @endif
            </select>
            @if ($errors->has('designation_id'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('designation_id') }}</strong>
            </span>
            @endif
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <div class="form-group">
            <label for="phone">Current CTC</label>
            <input class="form-control" id="phone" type="number" min="0" required="" name="current_ctc">
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
            <input class="form-control" id="phone" type="number" min="0" required="" name="expected_ctc">
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
            <option value="{{ $teamleaddata->id }}" @if(old('user_id')==$teamleaddata->id) selected @endif >{{ $teamleaddata->name }}</option>
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
        <label for="formFile" class="form-label">Upload Resume</label>
        <input class="form-control" type="file" name="resume">
        @if ($errors->has('resume'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('resume') }}</strong>
        </span>
        @endif
      </div>

      <div class="mt-3">
        <button class="btn btn-gray-800 mt-2 animate-up-2" type="submit">Save Candidate</button>
        <a class="btn btn-secondary mt-2 animate-up-2" type="button" href="{{route('candidate.index')}}">Back</a>
      </div>
    </form>
  </div>

</div>

@endsection