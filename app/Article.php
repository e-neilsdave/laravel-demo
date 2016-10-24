<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
	protected $table = 'articles';
    protected $fillable = ['title', 'category', 'sub_id', 'user_id'];
 
    public function user()
    {
        return $this->belongsTo('App\User');
    }
	public function articlecomment()
    {
        return $this->hasMany('App\ArticleComment');
    }
}
