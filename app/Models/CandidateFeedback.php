<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class CandidateFeedback extends Model
{
   
	protected $table = 'candidate_feedback';
	protected $primaryKey = 'candidate_feedback_id ';
    public $timestamps = false;
    
    protected $fillable = [
        'candidate_feedback_id',
		'candidate_id',
		'isactive',
		'feedback',
		'status_id',
		'designation_id',
		'created_by',
		'created_at'
    ];



    public static function findByCandidate($id)
    {
   	 	return  CandidateFeedback::
   	 			  join('status','status.status_id','candidate_feedback.status_id')
   	 			->join('candidate','candidate.candidate_id','candidate_feedback.candidate_id')
   	 			->join('users','users.id','candidate_feedback.created_by')
   	 			->join('designations','designations.designation_id','candidate_feedback.designation_id')
   	 			->where('candidate_feedback.candidate_id',$id)
   	 			->select(
   	 				'candidate.candidate_id',
   	 				'candidate.user_id',
   	 				'candidate.candidate_name',
   	 				'candidate.candidate_email',
   	 				'candidate.candidate_experience',
					'candidate.current_ctc',
					'candidate.expected_ctc',
					'candidate.resume_path',
					'designations.designation_id',
   	 				'designations.designation_name',
   	 				'status.status_name',
   	 				'status.status_id',
   	 				'users.name as created_by',
   	 				'candidate_feedback.feedback',
   	 				'candidate_feedback.created_at'
					

   	 				)
   	 			->get();
   }
   
}
