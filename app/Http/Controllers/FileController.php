<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getFile($filename)
    {
        return response()->download(storage_path($filename), null, [], null);
    }
}
