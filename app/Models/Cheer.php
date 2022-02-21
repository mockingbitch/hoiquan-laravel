<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\Client;

class Cheer extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'cheers';

    /**
     * @var string[]
     */
    protected $fillable = ['client','post','isCheer'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class,'post');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class,'client');
    }
}
