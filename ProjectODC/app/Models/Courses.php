<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;


    public $timestamps = false;
    protected $fillable = [
        'IdCourses',
        'nameCourses',
        'Period',
    ];

    public function Supplier(){
        return $this->belongsToMany(Supplier::class,'SpplierCourses','IdCourses','IdSuppliers');
    }

    public function studentReg(){
        return $this->belongsToMany(Student::class,'StudentCourse','courseid','studentid');
    }

    public function studentAcc(){
        return $this->belongsToMany(Student::class,'courseStudentAcc','courseid','studentid');
    }

    public function skill(){
        return $this->belongsToMany(Skills::class,'CourseSkill','courseid','skillid');
    }

    public function prerequisteskill(){
        return $this->belongsToMany(Skills::class,'prerequistecourseskills','courseid','skillid');
    }
}
