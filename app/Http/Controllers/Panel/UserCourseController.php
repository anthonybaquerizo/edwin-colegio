<?php

namespace App\Http\Controllers\Panel;

use App\Course;
use App\Http\Controllers\Controller;
use App\User;
use App\UserCourse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserCourseController extends Controller
{

    /**
     * @param $userId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function course($userId)
    {
        $objUser = User::find($userId);
        if (empty($objUser)) {
            abort(404);
        }
        $courses = (new Course())->search('');
        $result = collect();
        if ($courses->isNotEmpty()) {
            foreach ($courses as $item) {
                $exists = (new UserCourse())->verify($objUser->id, $item->id);
                if (empty($exists)) {
                    $result->push($item);
                }
            }
        }
        return view('user_course', compact(
            'objUser',
            'result'
        ));
    }

    /**
     * @param Request $request
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $userId)
    {
        $course_check = $request->input('course_check');
        $objUser = User::find($userId);
        if (empty($objUser)) {
            return response()->json(['message' => 'El usuario no pudo ser encontrado.'], 500);
        }
        if (!empty($course_check)) {
            foreach ($course_check as $value) {
                $objCourse = Course::find($value);
                if (!empty($objCourse)) {
                    $exists = (new UserCourse())->verify($objUser->id, $objCourse->id);
                    if (empty($exists)) {
                        $objUserCourser = (new UserCourse())->fill([
                            'prom_1' => 0,
                            'prom_2' => 0,
                            'prom_3' => 0,
                            'prom_final' => 0,
                            'status' => 1,
                        ]);
                        $objUserCourser->user()->associate($objUser);
                        $objUserCourser->course()->associate($objCourse);
                        $objUserCourser->save();
                    }
                }
            }
        }
        return response()->json(['message' => 'Se asignado las matriculas correctamente.']);
    }

}
