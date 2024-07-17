<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseLink extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'course_links';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['course_id', 'bl', 'dr', 'ur', 'domains', 'ext', 'int', 'traffic', 'kw', 'age', 'link_type', 'ref_page', 'ref_title'];

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