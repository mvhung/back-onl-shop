<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserIdentity extends Model
{
    use HasFactory;

    protected $table ='user_identities';
    protected $fillable = ['id','email','password','first_name','role'];
}
