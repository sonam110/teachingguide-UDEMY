<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'author';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['author_id', 'author', 'author_url', 'review_points', 'review_counts', 'students', 'course_counts', 'updated'];

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
    protected $dates = ['updated'];

}