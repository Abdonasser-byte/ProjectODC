<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Courses;
use App\Models\Skills;

class StudentController extends Controller
{
    public function StudentReg (Request $request )
    {
        $fields = $request->validate([
            'courseName' => 'required|string',
            'SetOfSkill.*'=>'required|string|distinct',
        ]);
        $courseName = $fields['courseName'];
        $SetOfSkill = $fields ['SetOfSkill'];
        $courseid = Courses::where('nameCourses', $courseName)->value('IdCourses');
        if($courseid == null || !$courseid ){
            return response([
                'message' => 'Not Found Course',
            ], 404);
        }
        $prerequisteskillsneeded = DB::table('prerequistecourseskills')->where('courseid', $courseid)->get();
        $ifdontexistsomskill =  1 ;
        foreach($prerequisteskillsneeded as $item){
            $ifdontexistsomskill = 1;
            foreach($SetOfSkill as $skillatstudent)
            {
                $skillatstudent=Skills::where('nameSkills', $skillatstudent)->value('IdSkills');
                if($skillatstudent == $item->skillid)$ifdontexistsomskill =0;
            }
            if($ifdontexistsomskill == 1) break;
        }
        if($ifdontexistsomskill == 1) {
            return response([
                'message' => 'REJECTED',
            ], 201);
        }else {
            return response([
                'message' => 'ACC IN COURSE',
            ], 201);
        }
    }
}
