<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'tel',
        'post',
        'address',
        'password',
    ];


    //パスワードをハッシュ化して保存
    public function setPasswordAttribute($value){
        $this->attributes['password']=bcrypt($value);
    }
}