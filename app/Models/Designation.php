<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Designation extends Model
{
   
	protected $table = 'designations';
	protected $primaryKey = 'designation_id';
    public $timestamps = false;
    
    protected $fillable = [
        'designation_id',
		'designation_name',
		'created_by',
		'created_at',
		'updated_by',
		'updated_at'
    ];


   public static function getActive()
   {
   	 	return  Designation::where('isactive',1)->get();
   }

  
   
}
