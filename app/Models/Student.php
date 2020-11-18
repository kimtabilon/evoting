<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_number', 
        'firstname', 
        'lastname', 
        'middlename', 
        'course', 
        'year_level', 
        'barangay',
        'municipality',
        'province',
    ];
}
