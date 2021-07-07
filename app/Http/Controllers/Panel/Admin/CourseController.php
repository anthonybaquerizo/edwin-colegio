<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Course;
use App\CourseGrade;
use App\CoursePeriod;
use App\CourseSection;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Admin\Course\CreateRequest;
use App\Http\Requests\Panel\Admin\Course\UpdateRequest;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function index(Request $request)
    {
        $result = (new Course())->search(
            $request->input('txt_name')
        );
        return view('admin.course.index', [
            'result' => $result,
        ]);
    }

    /**
     * Vista para crear nuevo curso
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $grades = CourseGrade::all()->where('status', '=', 1);
        $sections = CourseSection::all()->where('status', '=', 1);
        $periods = CoursePeriod::all()->where('status', '=', 1);
        $teachers = User::getTeacher();
        return view('admin.course.create', compact(
            'grades',
            'sections',
            'periods',
            'teachers'
        ));
    }

    public function show($id)
    {

    }

    /**
     * Vista para crear nuevo curso
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $objCourse = Course::find($id);
        if (empty($objCourse)) {
            abort(404);
        }
        $grades = CourseGrade::all()->where('status', '=', 1);
        $sections = CourseSection::all()->where('status', '=', 1);
        $periods = CoursePeriod::all()->where('status', '=', 1);
        $teachers = User::getTeacher();
        return view('admin.course.edit', compact(
            'objCourse',
            'grades',
            'sections',
            'periods',
            'teachers'
        ));
    }

    /**
     * @param CreateRequest $request
     */
    public function store(CreateRequest $request)
    {
        $objGrade = CourseGrade::find($request->input('grade_id'));
        $objSection = CourseSection::find($request->input('section_id'));
        $objPeriod = CoursePeriod::find($request->input('period_id'));
        $objTeacher = User::find($request->input('teacher_id'));
        $objCourse = (new Course())->fill([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'status' => 1,
        ]);
        $objCourse->createCode();
        $objCourse->grade()->associate($objGrade);
        $objCourse->section()->associate($objSection);
        $objCourse->period()->associate($objPeriod);
        $objCourse->teacher()->associate($objTeacher);
        $objCourse->save();
        return response()->json(['message' => 'Curso creado correctamente']);
    }

    /**
     * @param CreateRequest $request
     */
    public function update(UpdateRequest $request, $id)
    {
        $objCourse = Course::find($id);
        if (empty($objCourse)) {
            return response()->json(['message' => 'El curso no pudo ser encontrado.'], 500);
        }
        $objGrade = CourseGrade::find($request->input('grade_id'));
        $objSection = CourseSection::find($request->input('section_id'));
        $objPeriod = CoursePeriod::find($request->input('period_id'));
        $objTeacher = User::find($request->input('teacher_id'));
        $objCourse->fill([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'status' => 1,
        ]);
        $objCourse->createCode();
        $objCourse->grade()->associate($objGrade);
        $objCourse->section()->associate($objSection);
        $objCourse->period()->associate($objPeriod);
        $objCourse->teacher()->associate($objTeacher);
        $objCourse->save();
        return response()->json(['message' => 'Curso actualizado correctamente']);
    }

}
