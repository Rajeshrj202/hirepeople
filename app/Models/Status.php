<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Status extends Model
{
   
	protected $table = 'status';
	protected $primaryKey = 'status_id';
    public $timestamps = false;
    
    protected $fillable = [
        'status_id',
		'status_name',
		'created_by',
		'created_at',
		'updated_by',
		'updated_at',
		'isactive'
		
    ];


   public static function getActive()
   {
   	 	return  Status::where('isactive',1)->get();
   }

  
   
}
