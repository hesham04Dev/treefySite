<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\User;
use Livewire\Component;

use Livewire\WithPagination;

class ProjectsList extends Component
{
    use WithPagination;

    public ?int $userId = null;
    public ?int $limit=2;


    protected $listeners = ['enroll', 'unEnroll', 'startVerification'];

    public function enroll($projectId)
    {
        // enroll logic here
        auth()->user()->translator->enrolledProjects()->attach($projectId);
        session()->flash('success', 'Enrolled in project successfully.');
    }

    public function unEnroll($projectId)
    {
        // unenroll logic
        auth()->user()->translator->enrolledProjects()->detach($projectId);
        session()->flash('success', 'Unenrolled from project successfully.');
    }

    public function startVerification($projectId)
    {
        // redirect or show verification UI
        return redirect()->route('project.verify', $projectId);
    }

    public function render()
    {
        $data=[];
        $data["title"] = "All Projects";
        $projectsQuery = Project::query();

        if ($this->userId) {
            $user = User::find($this->userId);

            if ($user?->isTranslator()) {
                $data["title"]  = "Enrolled Projects";
                $data["href"]  = "/projects";
                $projectsQuery = $user->translator->enrolledProjects();
            } else {
                $title = "Your Projects";
                $data["href"]  = "/add_project";
                $projectsQuery = $user->projects();
            }
        }

        $projects = $projectsQuery->paginate($this->limit); // Adjust the per-page value as needed

        return view('livewire.projects-list', compact('projects', 'data'));
    }

}


