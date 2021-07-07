<?php

namespace App\Http\Controllers\Panel;

use App\Course;
use App\CourseResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Teacher\ResourceRequest;
use App\User;
use App\UserCourseHour;
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
        dd($objResource);
        if (empty($objResource)) {
            return back();
        }
        Storage::delete($objResource->file_path);
        $objResource->delete();
        return back();
    }

}
