<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\HasFactory;

class FileModel extends Model
{
    use HasFactory;

    //gets the table item queried?
    protected $fillable =[
        'project_id',
        'teacher_id',
        'initial_investment',
        'student_id',
        'project_filepath',
    ];
}
