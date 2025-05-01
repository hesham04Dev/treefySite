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


    public function view_addProject()
    {
        $projectId = 0;
        return view('publisher.addProject' ,compact("projectId"));
    }

    public function view_editProject()
    {
        
        $projectId = request("project_id");
        if(auth()->user()->ownProject( $projectId )){
            return view('publisher.addProject' ,compact("projectId"));
        }
         return redirect()->route("add_project");
    }
}
