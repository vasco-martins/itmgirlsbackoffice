<?php

namespace App\Models;

use App\Http\Traits\WithImageUpload;
use Illuminate\Database\Eloquent\Model;


class Article extends Model
{
    use WithImageUpload;

    protected $table = "articles";

    

    protected $fillable = [
        'title',
		'body',
		'author',
		
    ];

    protected $dates = [
        'created_at'
    ];

    
    


}
