<?php

namespace App\Observers;
use App\Helpers\Misc;
use App\Models\Article;
use Illuminate\Support\Str;

class ArticleObserver
{
    
    public function creating(Article $article)
    {
       //slug
       $article->slug = Misc::instance()->generateSlug($article->title, Article::class);
    }
    public function updating(Article $article)
    {
       // slug
       if ( $article->getOriginal('title') != $article->title) {
        $article->slug = Misc::instance()->generateSlug($article->title, Article::class);
    }
    }

}
