<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

$servername = "localhost";
$username="root";
$password = "";
$dbname = "financial_advisor";

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        //connecting to database
        $conn = new mysqli($servername,$username,$password,$dbname);
        if($conn->connection_error){
            die("Connection failed: " + $conn->connection_error);
        }

        // Validate the uploaded file
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Handle the file upload
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            // Store the file in the 'uploads' directory
            $path = $request->file('file')->store('/uploads');

            // Return the file path or any response as needed
            return response()->json(['path' => $path], 200);
        }

        return response()->json(['message' => 'No file uploaded or invalid file'], 400);
    }
}
