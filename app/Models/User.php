<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'password',
        'points',
        'is_banned',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    public function isTranslator() {
        return $this->translator()->exists();
    }

    public function language() {
        return $this->hasOne(Language::class, "id", "default_lang");
    }

    public function translator() {
        return $this->hasOne(Translator::class,"user_id");
    }
    public function projects(){
        return $this->hasMany(Project::class);
    }
    public function ownProject($projectId){
        return $this->projects()->where('id',$projectId)->exists();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function reservePoints($points,$save = true)
    {
        $this->points -= $points;
        $this->reserved_points += $points;
        if($save){
            $this->save();
        }
    }
    public function releaseReservedPoints($points , $save = true)
    {
        $this->points += $points;
        $this->reserved_points -= $points;
        if($save){
            $this->save();
        }
    }
     
    public function removeReservedPoints($points,$save =true)
    {
        $this->reserved_points -= $points;
        if($save){
            $this->save();
        }
    }

    public function addPoints($points, $save = true)
    {
        $this->points += $points;
        if($save){
            $this->save();
        }
    }
    public function removePoints($points, $save = true)
    {
        $this->points -= $points;
        if($save){
            $this->save();
        }
    }
}
