<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function view_Verification()
    {   
        $projectId = request("project_id");

        return view('publisher.viewVerification' ,compact("projectId"));
    }
}
