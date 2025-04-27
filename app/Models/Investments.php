<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investments extends Model
{
    protected $table = 'investments'; // Ensure this matches your database table name
    protected $fillable = ['name', 'duration_year', 'interest_type', 'interest_rate'];
}
