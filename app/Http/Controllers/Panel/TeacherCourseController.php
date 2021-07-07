<?php

namespace App\Http\Controllers\Panel;

use App\Course;
use App\Http\Controllers\Controller;
use App\User;
use App\UserCourseHour;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherCourseController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function courses(Request $request)
    {
        $courses = (new User())->searchTeacherCourses(Auth::user()->id);
        return view('teacher.courses', compact(
            'courses'
        ));
    }

    /**
     * @param Request $request
     * @param $courseId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function assistance(Request $request, $courseId)
    {
        $objCourse = Course::find($courseId);
        if (empty($objCourse)) {
            abort(404);
        }
        $dates = (new Course())->assistanceDate($courseId);
        $date = $request->input('date');
        $assistance = [];
        if (!empty($date)) {
            $cDate = Carbon::createFromFormat('d/m/Y', $date, 'America/lima');
            $assistance = (new Course())->assistance($courseId, $cDate->format('Y-m-d'));
        }
        return view('teacher.assistance', compact(
            'objCourse',
            'dates',
            'date',
            'assistance'
        ));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveAssistance(Request $request)
    {
        $assistance_id = $request->input('assistance_id');
        $assistance_status = $request->input('assistance_status');
        if (!empty($assistance_id)) {
            foreach ($assistance_id as $key => $value) {
                $id = (isset($assistance_id[$key])) ? $assistance_id[$key] : null;
                $status = (isset($assistance_status[$key])) ? $assistance_status[$key] : 0;
                $objUserCourseHor = UserCourseHour::find($id);
                if (!empty($objUserCourseHor)) {
                    $objUserCourseHor->status = $status;
                    $objUserCourseHor->save();
                }
            }
        }
        return response()->json(['message' => 'Se actualizo la asistencia correctamente.']);
    }

}
