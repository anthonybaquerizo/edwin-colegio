<?php

namespace App\Http\Controllers\Panel;

use App\Course;
use App\CourseResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Teacher\ResourceRequest;
use App\User;
use App\UserCourse;
use App\UserCourseHour;
use App\UserCourseProm;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resource(Request $request, $courseId)
    {
        $objCourse = Course::find($courseId);
        if (empty($objCourse)) {
            abort(404);
        }
        $resources = CourseResource::all()
            ->where('course_id', '=', $objCourse->id);
        return view('teacher.resource', compact(
            'objCourse',
            'resources'
        ));
    }

    /**
     * @param ResourceRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveResource(ResourceRequest $request)
    {
        $course_id = $request->input('course_id');
        $objCourse = Course::find($course_id);
        $file = $request->file('file');
        $path = $file->store('resource');
        $objCourseResource = (new CourseResource())->fill([
            'resource_id' => null,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'file_path' => $path,
            'status' => 1,
        ]);
        $objCourseResource->course()->associate($objCourse);
        $objCourseResource->save();
        return response()->json(['message' => 'Se guardo correctamente el recurso.']);
    }

    /**
     * @param $resourceId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteResource($resourceId)
    {
        $objResource = CourseResource::find($resourceId);
        if (empty($objResource)) {
            return back();
        }
        Storage::delete($objResource->file_path);
        $objResource->delete();
        return back();
    }

    /**
     * @param $courseId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function note($courseId)
    {
        $objCourse = Course::find($courseId);
        $result = (new UserCourseProm())->getStudent($objCourse->id);
        return view('teacher.note', compact(
            'objCourse',
            'result'
        ));
    }

    /**
     * @param Request $request
     * @param $courseId
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveNote(Request $request, $courseId)
    {
        $objCourse = Course::find($courseId);
        $prom_type = $request->input('prom_type');

        $work_note1 = $request->input('work_note1');
        $work_note2 = $request->input('work_note2');
        $work_note3 = $request->input('work_note3');
        $work_investigation = $request->input('work_investigation');
        $final_exam = $request->input('final_exam');
        $prom_nt = $request->input('prom_nt');
        $prom_ti = $request->input('prom_ti');
        $prom_ef = $request->input('prom_ef');
        $prom_final = $request->input('prom_final');
        $user_id = $request->input('user_id');
        if (!empty($user_id)) {
            foreach ($user_id as $key => $value) {
                $userId = (isset($user_id[$key]) && !empty($user_id[$key])) ? $user_id[$key] : null;
                $workNote1 = (isset($work_note1[$key]) && !empty($work_note1[$key])) ? $work_note1[$key] : 0;
                $workNote2 = (isset($work_note2[$key]) && !empty($work_note2[$key])) ? $work_note2[$key] : 0;
                $workNote3 = (isset($work_note3[$key]) && !empty($work_note3[$key])) ? $work_note3[$key] : 0;
                $workInvestigation = (isset($work_investigation[$key]) && !empty($work_investigation[$key])) ? $work_investigation[$key] : 0;
                $finalExam = (isset($final_exam[$key]) && !empty($final_exam[$key])) ? $final_exam[$key] : 0;
                $promNT = (isset($prom_nt[$key]) && !empty($prom_nt[$key])) ? $prom_nt[$key] : 0;
                $promTI = (isset($prom_ti[$key]) && !empty($prom_ti[$key])) ? $prom_ti[$key] : 0;
                $promEF = (isset($prom_ef[$key]) && !empty($prom_ef[$key])) ? $prom_ef[$key] : 0;
                $promFinal = (isset($prom_final[$key]) && !empty($prom_final[$key])) ? $prom_final[$key] : 0;
                /** @var UserCourse $objUserCourse */
                $objUserCourse = UserCourse::all()
                    ->where('user_id', '=', $userId)
                    ->where('course_id', '=', $objCourse->id)
                    ->first();
                if (!empty($objUserCourse)) {
                    $objUserCourseProm = (new UserCourseProm())->fill([
                        'work_note1' => $workNote1,
                        'work_note2' => $workNote2,
                        'work_note3' => $workNote3,
                        'work_investigation' => $workInvestigation,
                        'final_exam' => $finalExam,
                        'prom_nt' => $promNT,
                        'prom_ti' => $promTI,
                        'prom_ef' => $promEF,
                        'prom_final' => $promFinal,
                        'status' => 1,
                    ]);
                    $objUserCourseProm->userCourse()->associate($objUserCourse);
                    $objUserCourseProm->save();
                    switch ($prom_type)
                    {
                        case 1:
                            $objUserCourse->prom_1 = $promFinal;
                            break;
                        case 3:
                            $objUserCourse->prom_2 = $promFinal;
                            break;
                        case 2:
                            $objUserCourse->prom_3 = $promFinal;
                            break;
                    }
                    $objUserCourse->calculateFinalProm();
                    $objUserCourse->save();
                }
            }
        }
        return response()->json(['message' => 'Nota guardada correctamente.']);
    }

}
