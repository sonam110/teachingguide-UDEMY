<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Monitor_course;

class Course extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'course';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['course_id', 'category', 'title', 'rank', 'lectures', 'hours', 'minutes', 'instructor', 'level', 'badge', 'topic', 'last_price', 'reviews', 'rating', 'students', 'course_url', 'last_updated', 'updated', 'revenue', 'sales'];

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
    protected $dates = ['last_updated', 'updated'];

    public function getCourseInfo()
    {
        return $this->belongsTo(Monitor_course::class, 'course_id', 'course_id');
    }
    public function getCouponInfo()
    {
        return $this->belongsTo(Monitor_course::class, 'course_id', 'course_id');
    }

}