<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Tag;

class Post extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'posts';
    /**
     * @var string[]
     */
    protected $fillable = ['title','tag','client','content','slug','featured_image','status','cheers'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class,'client','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag()
    {
        return $this->belongsTo(Tag::class,'client');
    }
}
