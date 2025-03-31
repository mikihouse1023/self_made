<?php

namespace App\Models;
/*↓Laravelで認証機能を実装する際に必須*/
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//ModelからAuthenticatableに変更し、Userモデルを認証可能なモデルとして動作させる
class User extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'stamps',
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