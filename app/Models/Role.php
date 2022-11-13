<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Role extends Model
{
   
	protected $table = 'roles';
	protected $primaryKey = 'id';
    public $timestamps = false;
    
    protected $fillable = [
        
        'id',
		'name',
		'guard_name',
		'created_at',
		'updated_at'

	];


  
  
   
}
