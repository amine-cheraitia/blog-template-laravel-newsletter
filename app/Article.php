<?php

namespace App;

use Carbon\Carbon; //me
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = [];
    protected $filliable = ['id', 'title', 'sub_title', 'slug', 'body', 'published_at', 'user_id']; //les champ qui devront étre remplis



    /*
    |----------------------------------------------------------------------------------------------------
    |spécial controlleur pour le slug
    |----------------------------------------------------------------------------------------------------
    */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /*
    |----------------------------------------------------------------------------------------------------
    |accesor
    |----------------------------------------------------------------------------------------------------
    */
    public function getDatePublicationAttribute()

    {
        //return Carbon::parse($this->published_at)->format('d/m/Y');
        return Carbon::parse($this->published_at)->diffForHumans();
    }

    public function getTitleSearchedAttribute()
    {
        $q = request('q');
        return str_replace($q, '<mark>' . $q . '</mark>', $this->title);
    }

    public function getSubTitleSearchedAttribute()
    {
        $q = request('q');
        return str_replace($q, '<mark>' . $q . '</mark>', $this->sub_title);
    }

    /*
    |----------------------------------------------------------------------------------------------------
    |mutatos
    |----------------------------------------------------------------------------------------------------
    */

    public function setSlugAttribute()
    {
        $this->attributes['slug'] = \Str::slug($this->title);
    }

    /*
    |----------------------------------------------------------------------------------------------------
    |relation
    |----------------------------------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /*
    |----------------------------------------------------------------------------------------------------
    |scope
    |----------------------------------------------------------------------------------------------------
    */

    public function scopeRecherche($query)
    {
        $q = request('q');
        return $query->where('title', 'like', "%$q%")->orWhere('sub_title', 'like', "%$q%")->orWhere('body', 'like', "%$q%");
    }
}