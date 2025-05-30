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
    public ?int $limit = 10;


    protected $listeners = ['enroll', 'unEnroll', 'startVerification'];

    public function enroll($projectId)
    {
        // enroll logic here
        auth()->user()->translator->enrolledProjects()->attach($projectId);
        session()->flash('success', __('done'));
    }

    public function unEnroll($projectId)
    {
        // unenroll logic
        auth()->user()->translator->enrolledProjects()->detach($projectId);
        session()->flash('success', __('done'));
    }

    public function startVerification($projectId)
    {
        // redirect or show verification UI
        return redirect()->route('project.verify', $projectId);
    }

    public function render()
    {
        $data = [];
        $data["title"] = __("all_projects");
        $projectsQuery = Project::query();

        if ($this->userId) {
            $user = User::find($this->userId);

            if ($user?->isTranslator()) {
                $data["title"] = __("enrolled_projects");
                $data["href"] = "/projects";
                // $projectsQuery = $user->translator->enrolledProjects();

                $projectsQuery = Project::whereIn('id', $user->translator->getTranslationsForVerify(false)
                    ->select('p.id')
                    ->distinct());
            } else {
                $title = __("your_projects");
                $data["href"] = "/add_project";
                $projectsQuery = $user->projects();
                $projectsQuery = $projectsQuery
                
                ->whereRaw("(projects.is_disabled = 0 OR projects.user_id = ?)", [auth()->user()->id]);
            }
        }
        //  remove disabled projects if not the owner
      
        $projects = $projectsQuery->paginate($this->limit); // Adjust the per-page value as needed

        return view('livewire.projects-list', compact('projects', 'data'));
    }

}


