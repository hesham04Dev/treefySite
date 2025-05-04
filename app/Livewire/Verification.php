<?php

namespace App\Livewire;

use App\Models\ActiveTranslation;
use App\Models\Project;
use App\Models\UpdatedTranslation;
use App\Models\User;
use Livewire\Component;
use function Aws\load_compiled_json;
class Verification extends Component
{
    public ?int $project_id = null;

    public string $editableTranslation = '';

    public $project = null;
    public $translation = null;

    public $insufficientPointsUsers = [];

    public $user = null;

    public $allTranslations = [];
    public int $currentIndex = 0;

    public $projectOwner = null;

    public function mount()
    {
        $this->user = auth()->user();
        if($this->project_id){
            $this->project = Project::find($this->project_id);
            $this->projectOwner = User::find($this->project->user_id);
        }
        
        $this->loadTranslations();
        $this->loadCurrentTranslation();
    }
    public function render()
    {
        return view('livewire.verification', [
            'translation' => $this->translation,
        ]);
    }

    public function loadTranslations()
    {

        $query = $this->user->translator->getTranslationsForVerify();

        if ($this->project_id) {
            $query->where("p.id", $this->project_id);
        }
        if(!empty($this->insufficientPointsUsers)){
            $query->whereNotIn("u.id",$this->insufficientPointsUsers);
        }
        // dd($this->insufficientPointsUsers);

        $this->allTranslations = $query->limit(50)->get();
    }

    public function loadCurrentTranslation()
    {
        if (isset($this->allTranslations[$this->currentIndex])) {
            $this->translation = $this->allTranslations[$this->currentIndex];
            if(!$this->project_id){
                $this->project = Project::find($this->translation->project_id);
                $this->projectOwner = User::find($this->project->user_id);
            }
            if($this->project->points_per_word > 0){
                $reservedPoints = ActiveTranslation::getReservedPoints($this->projectOwner->id) + $this->project->points_per_word; 
                
                if($this->projectOwner->points < $reservedPoints){
                    $this->insufficientPointsUsers[] = $this->projectOwner->id;
                    $this->reload(true);
                    if(!($this->translation)){
                        return;
                    }
                    
                }
            }
            
            $this->editableTranslation = $this->translation->value;
            $this->_setActiveTranslation($this->user->id);

        } else {
            $this->translation = null;
            $this->reload();
           
        }
    }

    public function markAsCorrect($translationId)
    {
        $this->_setVerification($translationId);
        $this->_removeActiveTranslation($translationId);
        $this->addPointsToTranslator();
        $this->nextTranslation();
    }

    private function _setVerification($translationId)
    {
        $verification = \App\Models\Verification::create([
            'translator_id' => auth()->user()->id,
            'translation_id' => $translationId,
            'is_correct' => $this->editableTranslation == $this->translation->value,
        ]);
        if($this->project->points_per_word == 1){
            $this->translation->is_done=1;
            $this->translation->save();
        }
        $verifications = $this->getVerifications();
        if($this->project->points_per_word == count($verifications)){
            if($this->allVerificationsSame()){
                if($verifications[0]->updatedTranslation){
                    $this->translation->value = $verifications[0]->updatedTranslation->value;
                }
                $this->translation->is_done=1;
                $this->translation->save();
            }
            
        }
        $this->_setUpdatedTranslation($verification->id);

    }

    private function _setUpdatedTranslation($verificationId)
    {
        if ($this->editableTranslation != $this->translation->value) {
            UpdatedTranslation::create([
                'verification_id' => $verificationId,
                'value' => $this->editableTranslation,
            ]);
        }

    }

    private function _removeActiveTranslation($translationId)
    {
        ActiveTranslation::where('translator_id', auth()->user()->id)
            ->where('translation_id', $translationId)
            ->delete();
    }

    private function _setActiveTranslation($userId)
    {
        $activeTranslation = ActiveTranslation::firstOrNew([
            'translator_id' => $userId,
            'translation_id' => $this->translation->id,
        ]);
        $activeTranslation->locked_at = now();
        $activeTranslation->save();
    }

    public function skip($translationId)
    {
        $this->_removeActiveTranslation($translationId);
        $this->nextTranslation();
    }

    public function nextTranslation()
    {
        $this->currentIndex++;
        $this->loadCurrentTranslation();
    }

    public function reload($forceReloadCurrentTranslation = false)
    {
        $reloadCurrentTranslation = false;
        if (($this->currentIndex >= count($this->allTranslations)) && $this->currentIndex > 0) {
            $reloadCurrentTranslation = true;
        }
        $this->currentIndex = 0;
        $this->loadTranslations();
        if(empty($this->loadTranslations())){
            $this->translation = null;
            return ;
        }
        if ($forceReloadCurrentTranslation || $reloadCurrentTranslation) {
            $this->loadCurrentTranslation();
        }
    }

    private function addPointsToTranslator()
    {
        if ($this->project->points_per_word > 0) {
            $this->user->addPoints($this->project->points_per_word);
            $this->projectOwner->removePoints($this->project->points_per_word);

            // $transaction = 
            // 

            //  if from paypal the credit_user is null and type is paypal id
            //  if from verification the type is verification
            //  if from adding new image the type is add_image
            //  if from sending points the type is send_points
            // transaction::create([debit_user_id , credit_user_id, amount, transaction_type_id])


        }
    }

    private function getVerifications()
    {
        return \App\Models\Verification::where('translation_id', $this->translation->id)
            ->get();
    }

    private function allVerificationsSame($verifications){
        $allCorrect = true;
        $allIncorrect = true;
        foreach($verifications as $verification){
            if(!$verification->is_correct){
                $allCorrect = false;
            }else{
                $allIncorrect = false;
            }
            
        }
        if($allCorrect){
            return true;
        }else if($allIncorrect){
            $old = null;
            foreach($verifications as $verification){
                if($old == null){
                    $old = $verification->updatedTranslation->value;
                }
                else if($old != $verification->updatedTranslation->value){
                    return false;
                }
                
            }
            return true;
        }

        return false;
    }




}
