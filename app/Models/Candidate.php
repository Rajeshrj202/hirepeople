<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
class Candidate extends Model
{
   
	protected $table = 'candidate';
	protected $primaryKey = 'candidate_id';
    public $timestamps = false;
    
    protected $fillable = [
        'candidate_id',
		'status_id',
		'designation_id',
		'user_id',
		'candidate_name',
		'candidate_email',
		'candidate_experience',
		'current_ctc',
		'expected_ctc',
		'resume_path',
		'created_by',
		'created_at',
		'updated_by',
		'updated_at'
    ];


   public static function getAssignedCandidate($search)
   {
   	 	return  Candidate::
   	 			  join('status','status.status_id','candidate.status_id')
   	 			->join('designations','designations.designation_id','candidate.designation_id')
   	 			->join('users','users.id','candidate.user_id')
   	 			->where('candidate.user_id',Auth::id())
   	 			->where(function ($query) use ($search) {
   	 				$query->Where('candidate_name', 'like', '%' . $search . '%')
   	 					  ->orWhere('candidate_email', 'like', '%' . $search . '%')
   	 					  ->orWhere('status.status_name', 'like', '%' . $search . '%');
   	 			})
   	 			->select(
   	 				'candidate.candidate_id',
   	 				'candidate.user_id',
   	 				'candidate.candidate_name',
   	 				'candidate.candidate_email',
   	 				'candidate.candidate_experience',
					'candidate.current_ctc',
					'candidate.expected_ctc',
					'candidate.resume_path',
					'candidate.created_at',
					'candidate.updated_at',
					'designations.designation_id',
   	 				'designations.designation_name',
   	 				'status.status_name',
   	 				'status.status_id',
   	 				'users.name as assigned_to'


   	 				)
   	 			->orderBy('candidate.candidate_id','Desc')
   	 			->get();
   }

   public static function getMyCandidate($search)
   {
   	 	return  Candidate::
   	 			  join('status','status.status_id','candidate.status_id')
   	 			->join('designations','designations.designation_id','candidate.designation_id')
   	 			->join('users','users.id','candidate.user_id')
   	 			->where(function ($query) use ($search) {
   	 				$query->Where('candidate_name', 'like', '%' . $search . '%')
   	 					  ->orWhere('candidate_email', 'like', '%' . $search . '%')
   	 					  ->orWhere('status.status_name', 'like', '%' . $search . '%');
   	 			})
   	 			->select(
   	 				'candidate.candidate_id',
   	 				'candidate.user_id',
   	 				'candidate.candidate_name',
   	 				'candidate.candidate_email',
   	 				'candidate.candidate_experience',
					'candidate.current_ctc',
					'candidate.expected_ctc',
					'candidate.resume_path',
					'candidate.created_at',
					'candidate.updated_at',
					'designations.designation_id',
   	 				'designations.designation_name',
   	 				'status.status_name',
   	 				'status.status_id',
   	 				'users.name as assigned_to'


   	 				)
   	 			->orderBy('candidate.candidate_id','Desc')
   	 			->get();
   }


   public static function findCandidate($id)
   {
   	 	return  Candidate::
   	 			  join('status','status.status_id','candidate.status_id')
   	 			->join('users','users.id','candidate.created_by')
   	 			->join('designations','designations.designation_id','candidate.designation_id')
   	 			->where('candidate.candidate_id',$id)
   	 			->select(
   	 				'candidate.candidate_id',
   	 				'candidate.user_id',
   	 				'candidate.candidate_name',
   	 				'candidate.candidate_email',
   	 				'candidate.candidate_experience',
					'candidate.current_ctc',
					'candidate.expected_ctc',
					'candidate.resume_path',
					'candidate.created_at',
					'candidate.updated_at',
					'designations.designation_id',
   	 				'designations.designation_name',
   	 				'status.status_name',
   	 				'status.status_id',
   	 				'users.name as created_by'


   	 				)
   	 			->first();
   }


   public static function findMyCandidate($id)
   {

		$user=Auth::user();
		$userid=null;
		if((in_array('teamlead',$user->getRoleNames()->toArray())))
		{
			$userid=$user->id;
		}
   	 	return  Candidate::
   	 			  join('status','status.status_id','candidate.status_id')
   	 			->join('users','users.id','candidate.created_by')
   	 			->join('designations','designations.designation_id','candidate.designation_id')
   	 			->where('candidate.candidate_id',$id)
				->where(function ($query) use ($userid) {

					if(isset($userid) && !empty($userid)):
						$query->where('candidate.user_id',$userid);
					endif;
					
				})
   	 			->select(
   	 				'candidate.candidate_id',
   	 				'candidate.user_id',
   	 				'candidate.candidate_name',
   	 				'candidate.candidate_email',
   	 				'candidate.candidate_experience',
					'candidate.current_ctc',
					'candidate.expected_ctc',
					'candidate.resume_path',
					'candidate.created_at',
					'candidate.updated_at',
					'designations.designation_id',
   	 				'designations.designation_name',
   	 				'status.status_name',
   	 				'status.status_id',
   	 				'users.name as created_by'


   	 				)
   	 			->first();
   	}


   public static function CountStatistics()
   {
		$user=Auth::user();
		$userid=null;
		if((in_array('teamlead',$user->getRoleNames()->toArray())))
		{
			$userid=$user->id;
		}
   	 	return  Candidate::where(function ($query) use ($userid) {

			if(isset($userid) && !empty($userid)):
				$query->where('candidate.user_id',$userid);
			endif;
			
		})
		->select(
			DB::raw('count(Case When candidate.status_id=3 then 1 Else null End) as pending'),
			DB::raw('count(Case When candidate.status_id=4 then 1 Else null End) as closed'),
			DB::raw('count(Case When candidate.status_id=1 then 1 Else null End) as approved'),
			DB::raw('count(Case When candidate.status_id=2 then 1 Else null End) as rejected'),
			DB::raw('count(*) as allcount'),
			
			)
		->first();
   }


   
   
}
