<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Skills;
use App\Models\Suppliers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminAdminController extends Controller
{
    public function Addcourse(Request $request){
        $feild = $request ->validate([
            'courseperiod'=>'required|string',
            'nameCourses'=>'required',
        ]);
        $courses = Courses::create([
            'nameCourses' =>$feild['nameCourse'],
            'Period' => $feild['courseperiod'],
        ]);
        return response([
            'message'=>'Course Added',
        ],201);
    }

    public function AddSupplier(Request $request){
        $feild = $request ->validate([
            'nameSuppliers'=>'required|string',
        ]);
        $suppliers = Suppliers::create([
            'nameSuppliers' =>$feild['nameSuppliers'],
        ]);
        return response([
            'message'=>'Supplier Added',
        ],201);
    }

    public function SupplierCourse(Request $request){
        $feild = $request ->validate([
            'suppliersname'=>'required|string',
            'coursename'=>'required',
            'costofcourse'=>'required',
        ]);
        $suppliersname=$feild['suppliersname'];
        $coursename=$feild['coursename'];
        $costofcourse=$feild['costofcourse'];
        $supplierid = Suppliers::where('nameSuppliers', $suppliersname)->value('IdSuppliers');
        if($supplierid == null || !$supplierid ){
            return response([
                'message' => 'Not Found Suppliers',
            ], 404);
        }
        $courseid= Courses::where('nameCourses', $coursename)->value('IdCourses');
        if($courseid == null || !$courseid ){
            return response([
                'message' => 'Not Found Course',
            ], 404);
        }
        $arr=[
            'supplierid'=>$supplierid,
            'CourseId'=>$courseid,
            'PriceOfCourse'=>$costofcourse,
            'ODCpaid'=>0,
        ];
        $addsupp = DB::table('SpplierCourses')->insert($arr);
        return response([
            'message'=>'Supplier Course Added',
        ],201);
    }

    public function PaidToCompany(Request $request){
        $feild = $request ->validate([
            'suppliersname'=>'required',
            'coursename'=>'required|distinct',
            'cost' =>'required',
        ]);
        $suppliersname=$feild['suppliersname'];
        $coursename=$feild['coursename'];
        $cost=$feild['cost'];
        $supplierid = Suppliers::where('nameSuppliers', $suppliersname)->value('IdSuppliers');
        if($supplierid == null || !$supplierid ){
            return response([
                'message' => 'Not Found Suppliers',
            ], 404);
        }
        $courseid= Courses::where('nameCourses', $coursename)->value('IdCourses');
        if($courseid == null || !$courseid ){
            return response([
                'message' => 'Not Found Course',
            ], 404);
        }
        $arr=[
            'supplierid'=>$supplierid,
            'CourseId'=>$courseid,
        ];
        $updatestd = DB::table('SpplierCourses')->where($arr)->value('ODCpaid');
        $arr=[
            'supplierid'=>$supplierid,
            'CourseId'=>$courseid,
            'ODCpaid'=>$cost + $updatestd,
        ];
        $updatestd = DB::table('SpplierCourses')->update($arr);
        return response([
            'message'=>'Done Paid Operation',
        ],201);
    }

    public function AddSkills(Request $request){
        $feild = $request ->validate([
            'nameSkills'=>'required',
        ]);
        $skill = Skills::create([
            'nameSkills'=>$feild['nameSkills'],
        ]);
        return response([
            'message'=>'Skills Added',
        ],201);
    }

    public function prerequistecourse(Request $request){
        $feild = $request ->validate([
            'coursename'=>'required',
            'skills.*'=>'required|distinct',
        ]);
        $coursename = $feild['coursename'];
        $skills=$feild['skills'];
        $courseid= Courses::where('nameCourses', $coursename)->value('IdCourses');
        if($courseid == null || !$courseid ){
            return response([
                'message' => 'Not Found Course',
            ], 404);
        }
        foreach($skills as $skill){
            $skillid= Skills::where('nameSkills', $skill)->value('IdSkills');
            $arr=[
                'courseid'=>$courseid,
                'skillid'=>$skillid,
            ];
            $updatestd = DB::table('prerequistecourseskills')->insert($arr);
        }
    }

    public function courseskills(Request $request){
        $feild = $request ->validate([
            'coursename'=>'required',
            'skills.*'=>'required|distinct',
        ]);
        $coursename = $feild['coursename'];
        $skills=$feild['skills'];
        $courseid= Courses::where('nameCourses', $coursename)->value('IdCourses');
        if($courseid == null || !$courseid ){
            return response([
                'message' => 'Not Found Course',
            ], 404);
        }
        foreach($skills as $skill){
            $skillid= Skills::where('nameSkills', $skill)->value('IdSkills');
            $arr=[
                'courseid'=>$courseid,
                'skillid'=>$skillid,
            ];
            $updatestd = DB::table('CourseSkill')->insert($arr);
        }
    }

    public function AddAdmin($request){
        $feild=$request->validate([
        'Fname'=>'required',
        'Lname'=>'required',
        'email'=>'required|email',
        'password'=>'required',
        ]);
        $user=User::create([
        'Fname'=>$feild['Fname'],
        'Lname'=>$feild['Lname'],
        'admin'=>1,
        'adminadmin'=>0,
        'email'=>$feild['email'],
        'password'=>$feild['password'],
        ]);
        return response([
            'message'=>'Added Admin',
        ],201);
    }
}
