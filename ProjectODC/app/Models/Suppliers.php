<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'IdSuppliers',
        'nameSuppliers',
    ];
    public function Courses(){
        return $this->belongsToMany(Course::class,'SpplierCourses','IdSuppliers','IdCourses');
    }
}
