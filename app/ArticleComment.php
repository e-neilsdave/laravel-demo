<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleComment extends Model
{
    //
	protected $table = 'articlescomments';
    protected $fillable = ['article_id', 'name', 'body'];
 
    public function article()
    {
        return $this->belongsTo('App\Article');
    }
 
    
}
