<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Courses;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function AddStudent(Request $request)
    {
        $feild = $request ->validate([
            'name'=>'required|string',
            'email' =>'required|string|email',
            'courseName'=>'required',
        ]);

        $student = Student::create([
            'name' => $feild['name'],
            'email' => $feild['email'],
        ]);
        $courseName = $feild['courseName'];
        $name = $feild['name'];
        $courseid = Courses::where('nameCourses', $courseName)->value('IdCourses');
        if($courseid == null || !$courseid ){
            return response([
                'message' => 'Not Found Course',
            ], 404);
        }
        $studentid = Student::where('name', $name)->value('id');
        if($studentid == null || !$studentid ){
            return response([
                'message' => 'Not Found Student',
            ], 404);
        }
        $arr = [
            'courseid'=>$courseid,
            'studentid'=>$studentid,
            'taskdeleiverd'=>0,
            'attendes'=>0,
            'finshed'=>0,
        ];
        $updatestd = DB::table('StudentCourse')->insert($arr);
        return response([
            'message' => 'Student Added',
        ],201);
    }

    public function updatestudenttask(Request $request){
        $feild = $request ->validate([
            'name'=>'required|string',
            'courseName'=>'required',
        ]);
        $courseName = $feild['courseName'];
        $name = $feild['name'];
        $courseid = Courses::where('nameCourses', $courseName)->value('IdCourses');
        if($courseid == null || !$courseid ){
            return response([
                'message' => 'Not Found Course',
            ], 404);
        }
        $studentid = Student::where('name', $name)->value('id');
        if($studentid == null || !$studentid ){
            return response([
                'message' => 'Not Found Student',
            ], 404);
        }
        $arr = [
            'courseid'=>$courseid,
            'studentid'=>$studentid,
        ];
        $updattask = DB::table('StudentCourse')->where($arr)->value('taskdeleiverd');
        $arr = [
            'courseid'=>$courseid,
            'studentid'=>$studentid,
            'taskdeleiverd'=> $updattask + 1,
        ];
        $updatattend = DB::table('StudentCourse')->update($arr);
        return response([
            'message'=>'Updated Student',
        ],201);
    }

    public function updatestudentattends(Request $request){
        $feild = $request ->validate([
            'name'=>'required|string',
            'courseName'=>'required',
        ]);
        $courseName = $feild['courseName'];
        $name = $feild['name'];
        $courseid = Courses::where('nameCourses', $courseName)->value('IdCourses');
        if($courseid == null || !$courseid ){
            return response([
                'message' => 'Not Found Course',
            ], 404);
        }
        $studentid = Student::where('name', $name)->value('id');
        if($studentid == null || !$studentid ){
            return response([
                'message' => 'Not Found Student',
            ], 404);
        }
        $arr = [
            'courseid'=>$courseid,
            'studentid'=>$studentid,
        ];
        $updatattend = DB::table('StudentCourse')->where($arr)->value('attendes');
        $arr = [
            'courseid'=>$courseid,
            'studentid'=>$studentid,
            'attendes'=> $updatattend + 1,
        ];
        $updatattend = DB::table('StudentCourse')->update($arr);
        return response([
            'message'=>'Updated Student',
        ],201);
    }

    public function updatestudentfinsh(Request $request){
        $feild = $request ->validate([
            'name'=>'required|string',
            'courseName'=>'required',
        ]);
        $courseName = $feild['courseName'];
        $name = $feild['name'];
        $courseid = Courses::where('nameCourses', $courseName)->value('IdCourses');
        if($courseid == null || !$courseid ){
            return response([
                'message' => 'Not Found Course',
            ], 404);
        }
        $studentid = Student::where('name', $name)->value('id');
        if($studentid == null || !$studentid ){
            return response([
                'message' => 'Not Found Student',
            ], 404);
        }
        $arr = [
            'courseid'=>$courseid,
            'studentid'=>$studentid,
        ];
        $updatattend = DB::table('StudentCourse')->where($arr)->value('finshed');
        $arr = [
            'courseid'=>$courseid,
            'studentid'=>$studentid,
            'finshed'=> 1,
        ];
        $updatattend = DB::table('StudentCourse')->update($arr);
        return response([
            'message'=>'Updated Student',
        ],201);
    }
}
