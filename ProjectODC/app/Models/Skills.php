<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'nameSkills',
    ];
    public function course(){
        return $this->belongsToMany(Courses::class,'CourseSkill','skillid','courseid');
    }
    public function prerequistecourse(){
        return $this->belongsToMany(Courses::class,'prerequistecourseskills','skillid','courseid');
    }
}
