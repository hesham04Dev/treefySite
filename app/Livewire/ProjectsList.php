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

        $projects = $projectsQuery->paginate(2); // Adjust the per-page value as needed

        return view('livewire.projects-list', compact('projects', 'data'));
    }

}


