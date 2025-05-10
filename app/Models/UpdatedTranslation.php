<?php

namespace App\Models;

use App;
use App\Services\GeminiService;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Http;
use League\CommonMark\CommonMarkConverter;

class UpdatedTranslation extends Model
{
    protected $fillable = ['verification_id', 'value'];

    public function translateToUserLang(){
        $gemini = new GeminiService();
        // dd($this->language()->code);
        $textLang = $this->language()->code ;
        $userLang = App::getLocale();// auth()->user()->language->code ;
        if($textLang == $userLang){
            return "";
        }
        $response = $gemini->translate($this->value , $textLang, $userLang);
        // dd($this->value , $textLang, $userLang);

      $c = new CommonMarkConverter();
    return  $c->convertToHtml($response);
    }

    public function language() {
        return DB::table('translations')
            ->join('verifications', 'translations.id', '=', 'verifications.translation_id')
            ->join('languages', 'translations.language_id', '=', 'languages.id')
            ->where('verifications.id', $this->verification_id)
            ->select('languages.*')
            ->first();
    }
    
}
