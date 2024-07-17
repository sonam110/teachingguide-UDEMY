<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Webapp_user_setting extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'webapp_user_settings';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'report_id', 'object_id', 'config'];

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