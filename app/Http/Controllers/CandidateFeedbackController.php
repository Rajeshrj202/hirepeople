<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Candidate;
use App\Models\User;
use App\Models\Designation;
use App\Models\CandidateFeedback;
use App\Models\Status;
use Carbon\Carbon;
use Auth;
use Storage;
use DB;

class CandidateFeedbackController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:candidate feedback', ['only' => ['show','store']]);
        $this->middleware('permission:candidate show', ['only' => ['show']]);
    }



    public function store(Request $request,$id)
    {   
        try{
            $candidate=Candidate::find($id);

            if(isset($candidate) && !empty($candidate)):

                $rules=[
                    'feedback' => 'required',
                ];

                if($candidate->status_id==3): $rules['status_id'] = 'required'; endif;
                $request->validate($rules);

                DB::beginTransaction();

                $data = $request->all();
                $data['created_by']=Auth::id();
                $data['created_at']=Carbon::now();
                $data['designation_id']=$candidate->designation_id;
                $data['candidate_id']=$candidate->candidate_id;
                $data['status_id']=!empty($request->status_id) ? $request->status_id : $candidate->status_id;
                
                
                CandidateFeedback::create($data);

                $candidate->status_id=!empty($request->status_id) ? $request->status_id : $candidate->status_id;
                $candidate->save();
                
                DB::commit();

            endif;

            return back()->with(['message' => 'Feedback Updated Successfully', 'type' => 'success']);

        }
        catch(Exception $qe){

            DB::rollback();

            return back()->with(['error' => $qe->getMessage(), 'type' => 'alert']);
        }
    }





    public function show(Request $request,$id)
    {
        
        $candidate=Candidate::findCandidate($id);

        if(isset($candidate) && !empty($candidate)):

            $data['candidatedata']=$candidate;
            $data['candidatefeedbacks']=CandidateFeedback::findByCandidate($id);
            $data['status']=Status::getSelected();
            return view('candidate.show',$data);

        endif;

        return back()->with(['message' => 'Oops! No Candidate Found', 'type' => 'alert']);


    }



    public function streampdf(Request $request,$id)
    {   
        $candidate = Candidate::findCandidate($id);
        $storagePath  = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
        ob_end_clean();
        return response()->file($storagePath.$candidate->resume_path);
        
    }

}