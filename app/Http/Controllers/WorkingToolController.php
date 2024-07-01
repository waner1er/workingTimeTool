<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkingToolController extends Controller
{
    public function app()
    {
        return view('working-tool.app');
    }
}
