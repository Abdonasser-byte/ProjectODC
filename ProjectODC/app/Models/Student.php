<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'email',
    ];
    public function courseReg(){
        return $this->belongsToMany(Courses::class,'StudentCourse','studentid','courseid');
    }
    public function courseAcc(){
        return $this->belongsToMany(Courses::class,'courseStudentAcc','studentid','courseid');
    }
}
