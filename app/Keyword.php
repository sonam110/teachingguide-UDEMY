<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'keyword';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['keyword_id', 'keyword', 'topic_id', 'topic', 'category', 'frequency', 'volume', 'traffic_category', 'avg_rating', 'avg_reviews'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

}