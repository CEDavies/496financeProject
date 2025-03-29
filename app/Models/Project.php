<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//model of project table
class Project extends Model
{
    protected $table = 'project';

    protected $fillable =[
        'initial_investment',
        'project_filepath',
    ];
}
