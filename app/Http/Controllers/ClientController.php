<?php

// Testing for queries

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller{
    public function index() {
        try {
           $dbconnect = DB::connection()->getPDO();
           $dbname = DB::connection()->getDatabaseName();
           echo "Connected successfully to the database. Database name is :".$dbname;
        } catch(Exception $e) {
           echo "Error in connecting to the database";
        }
     }
}