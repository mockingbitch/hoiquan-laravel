<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Post;

class Client extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'clients';

    /**
     * @var string[]
     */
    protected $fillable = ['name','birth','email','phone','karma','respect','password','avatar','class','status','token','remember_token'];

    public function post()
    {
        return $this->hasMany(Post::class);
    }
}
