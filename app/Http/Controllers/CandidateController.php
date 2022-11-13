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
use Hash;
use DB;
class CandidateController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:candidate index', ['only' => ['index']]);
        $this->middleware('permission:candidate create', ['only' => ['create','store']]);
        $this->middleware('permission:candidate edit', ['only' => ['edit','update']]);
        $this->middleware('permission:candidate assigned', ['only' => ['getAssignedCandidate']]);
        
    }

    
    public function index(Request $request)
    {   
        $candidates=Candidate::getMyCandidate($request->search);

        $data['candidate']=$candidates;

        return view('candidate.index',$data);
    }


    public function getAssignedCandidate(Request $request)
    {   
        $candidates=Candidate::getAssignedCandidate($request->search);

        $data['candidate']=$candidates;

        return view('candidate.index',$data);
    }


    public function create()
    {
        $data['designation']=Designation::getActive();
        $data['teamlead']=User::getActiveByRole('Teamlead');
        return view('candidate.create',$data);
    }


    public function store(Request $request)
    {
       
        try{

            $request->validate([
                'candidate_name' => ['required','string','max:255'],
                'candidate_email' => ['required', 'string', 'email', 'max:255', 'unique:candidate,candidate_email'],
                'candidate_experience' => ['required','numeric','min:0'],
                'current_ctc' => ['required','numeric','min:1'],
                'expected_ctc' => ['required','numeric','min:1'],
                'designation_id'=> ['required','numeric'],
                'user_id'=> ['required','numeric'],
                'resume' => 'required|mimes:pdf|max:5120'

            ]);
            DB::beginTransaction();

            $data = $request->all();
            $data['created_by']=Auth::id();
            $data['updated_by']=Auth::id();
            $data['updated_at']=Carbon::now();
            


            $candidate=Candidate::create($data);

                if ($request->hasfile('resume')) {
                    

                    $file=$request->file('resume');

                    $orignalname =$file->getClientOriginalName();

                    $extension = $file->extension();

                    $uniquefilename = 'CV-'.$candidate->candidate_id.date('Ymdhis').'.'.$extension;
                    $file->storeAs('resumes', $uniquefilename, 'public');
                    $document_path='resumes/'.$uniquefilename;
        
                    

                    if($document_path)
                    {
                        $candidate->resume_path=$document_path;
                        $candidate->save();
                    }


                }

                DB::commit();
            
                if($candidate)
                {

                return   redirect()->route('candidate.index')->with(['message' => 'Great! Candidate Created Successfully', 'type' => 'success']);

                }
                

            }
            catch(Exception $qe){

                DB::rollback();

                return redirect()->route('candidate.index')->with(['error' => $qe->getMessage(), 'type' => 'alert']);
            }
        
           
            return redirect()->route('candidate.index')->with(['message' => 'Oops! Something Went Wrong', 'type' => 'alert']);
            
    
    }



    public function edit(Request $request,$id)
    {
        
        $candidate=Candidate::findCandidate($id);

        if(isset($candidate) && !empty($candidate)):

            $data['candidatedata']=$candidate;
            $data['designation']=Designation::getActive();
            $data['status']=Status::getActive();
            $data['teamlead']=User::getActiveByRole('Teamlead');

            return view('candidate.edit',$data);

        endif;

        return back()->with(['message' => 'Oops! No Candidate Found', 'type' => 'alert']);


    }

    public function update(Request $request,$id)
    {
        try{

        $candidate=Candidate::findCandidate($id);

        if(isset($candidate) && !empty($candidate)):

            $request->validate([
                'candidate_name' => ['required','string','max:255'],
                'candidate_email' => ['required', 'string', 'email', 'max:255', 'unique:candidate,candidate_email,'.$id.',candidate_id'],
                'candidate_experience' => ['required','numeric','min:0'],
                'current_ctc' => ['required','numeric','min:1'],
                'expected_ctc' => ['required','numeric','min:1'],
                'designation_id'=> ['required','numeric'],
                'user_id'=> ['required','numeric'],
                'status_id'=> ['required','numeric'],
                'resume' => 'mimes:pdf|max:5120'

            ]);

            DB::beginTransaction();

            $data = $request->all();
            $data['updated_by']=Auth::id();
            $data['updated_at']=Carbon::now();
            $oldfile=$candidate->resume_path;

            $candidate->update($data);

                if ($request->hasfile('resume')) {
                    

                    $file=$request->file('resume');

                    $orignalname =$file->getClientOriginalName();

                    $extension = $file->extension();

                    $uniquefilename = 'CV-'.$candidate->candidate_id.date('Ymdhis').'.'.$extension;
                    $file->storeAs('resumes', $uniquefilename, 'public');
                    $document_path='resumes/'.$uniquefilename;
                    if($document_path)
                    {
                        $candidate->resume_path=$document_path;
                        $candidate->save();
                    }

                    Storage::disk('public')->delete($oldfile);
                }

            DB::commit();
            
            if($candidate)
            {

             return   redirect()->route('candidate.index')->with(['message' => 'Great! Candidate Updated Successfully', 'type' => 'success']);

            }

        endif;

        }
        catch(Exception $qe){

            DB::rollback();

            return redirect()->route('candidate.index')->with(['error' => $qe->getMessage(), 'type' => 'alert']);
        }
            
        return redirect()->route('candidate.index')->with(['message' => 'Oops! Something Went Wrong', 'type' => 'alert']);

        
    }


    


    public function delete()
    {
       $candidate=Candidate::findCandidate($id);

        if(isset($candidate) && !empty($candidate)):

            $candidate->status_id=4;
            $candidate->save();

            return back()->with(['message' => 'Great! Candidate Deactivated Successfully', 'type' => 'success']);

        endif;

        return back()->with(['message' => 'Oops! No Candidate Found', 'type' => 'alert']);
    }
}
