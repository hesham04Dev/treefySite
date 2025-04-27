<?php

namespace App\Livewire;

use App\Models\Project;
use DB;
use Livewire\Component;

class ViewVerifications extends Component
{

    public $projectId =null;
    public $offset = 0;
    public $verifications = [];

    public $translations = [];

    public $currentIndex = 0;

    private $perPage = 50;

    public function mount(){
        $this->loadTranslations();
        $this->loadCurrentVerifications();
    }

   
    public function loadTranslations()
    {
        $project = Project::findOrFail($this->projectId);
    
        $this->translations = $project->translations()
            ->where('is_done', false)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('verifications')
                    ->whereColumn('verifications.translation_id', 'translations.id');
            })
            ->limit($this->perPage)
            ->offset($this->offset)
            ->get();
    }
    

    public  function loadCurrentVerifications(){
        // $p = Project::find($this->projectId);
        // if($p == null){
        //     return;
        // }
         if(!isset($this->translations[$this->currentIndex])){

            $this->verifications = [];
            return;

         }
        $t = $this->translations[$this->currentIndex];
        $this->verifications =  $t->verifications()->get();
    }

    public function nextTranslation(){
        $this->currentIndex++;
        if($this->currentIndex >= count($this->translations)){
            $this->currentIndex = 0;
            $this->offset += $this->perPage;
            $this->loadTranslations();
        }
        $this->loadCurrentVerifications();
    }

    public function selectVerification($verificationId){
        $verification = $this->verifications->find($verificationId);
        if($verification){
            foreach($this->verifications as $v){
                if($v->id != $verificationId){
                    $v->is_selected = false;
                    $v->save();
                }
            }
            $verification->is_selected = true;
            $verification->translation->is_done = true; 
            $verification->translation->save(); 
            $verification->save();
        }
        $this->nextTranslation();
    }

    public function render()
    {
        return view('livewire.view-verifications', ["translation"=> $this->translations[$this->currentIndex]??null]);
    }
}
