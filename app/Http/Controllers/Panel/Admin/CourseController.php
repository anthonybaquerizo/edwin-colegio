<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Course;
use App\CourseGrade;
use App\Coursehour;
use App\CoursePeriod;
use App\CourseSection;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Admin\Course\CreateRequest;
use App\Http\Requests\Panel\Admin\Course\UpdateRequest;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $dates = Coursehour::all()->where('course_id', '=', $objCourse->id);
        return view('admin.course.edit', compact(
            'objCourse',
            'grades',
            'sections',
            'periods',
            'teachers',
            'dates'
        ));
    }

    /**
     * @param CreateRequest $request
     */
    public function store(CreateRequest $request)
    {
        try {

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

            $file = $request->file('syllable');
            if ($file->getClientOriginalExtension() !== 'pdf') {
                throw new \Exception('El formato de PDF es incorrecto.');
            }
            $path = $file->store('course');
            $objCourse->syllable = $path;

            DB::beginTransaction();

            $objCourse->save();

            $course_date_value = $request->input('course_date_value');
            $course_date_start = $request->input('course_date_start');
            $course_date_end = $request->input('course_date_end');
            $course_date_operation = $request->input('course_date_operation');
            if (empty($course_date_value)) {
                throw new \Exception('Debe ingresar el horario del curso.');
            }

            // Se eliminan
            (new Coursehour())->newQuery()
                ->where('course_id', '=', $objCourse->id)
                ->delete();

            foreach ($course_date_value as $key => $value) {
                $date = (isset($course_date_value[$key])) ? $course_date_value[$key] : null;
                $start = (isset($course_date_start[$key])) ? $course_date_start[$key] : null;
                $end = (isset($course_date_end[$key])) ? $course_date_end[$key] : null;
                $operation = (isset($course_date_operation[$key])) ? $course_date_operation[$key] : 0;
                if ($operation == 1) {
                    $line = 'Línea ' . ($key + 1) . ': ';
                    if (empty($date)) {
                        throw new \Exception($line . 'Debe ingresar la fecha.');
                    }
                    if (empty($start)) {
                        throw new \Exception($line . 'Debe ingresar el inicio de la fecha.');
                    }
                    if (empty($end)) {
                        throw new \Exception($line . 'Debe ingresar el final de la fecha.');
                    }
                    $objCourseHour = (new Coursehour())->fill([
                        'date' => $date,
                        'hour_start' => $start,
                        'hour_end' => $end,
                        'status' => 1
                    ]);
                    $objCourseHour->course()->associate($objCourse);
                    $objCourseHour->save();
                }
            }
            DB::commit();
            return response()->json(['message' => 'Curso creado correctamente']);

        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
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

            DB::beginTransaction();

            $objCourse->save();

            $course_date_value = $request->input('course_date_value');
            $course_date_start = $request->input('course_date_start');
            $course_date_end = $request->input('course_date_end');
            $course_date_operation = $request->input('course_date_operation');
            if (empty($course_date_value)) {
                throw new \Exception('Debe ingresar el horario del curso.');
            }

            // Se eliminan
            (new Coursehour())->newQuery()
                ->where('course_id', '=', $objCourse->id)
                ->delete();

            foreach ($course_date_value as $key => $value) {
                $date = (isset($course_date_value[$key])) ? $course_date_value[$key] : null;
                $start = (isset($course_date_start[$key])) ? $course_date_start[$key] : null;
                $end = (isset($course_date_end[$key])) ? $course_date_end[$key] : null;
                $operation = (isset($course_date_operation[$key])) ? $course_date_operation[$key] : 0;
                if ($operation == 1) {
                    $line = 'Línea ' . ($key + 1) . ': ';
                    if (empty($date)) {
                        throw new \Exception($line . 'Debe ingresar la fecha.');
                    }
                    if (empty($start)) {
                        throw new \Exception($line . 'Debe ingresar el inicio de la fecha.');
                    }
                    if (empty($end)) {
                        throw new \Exception($line . 'Debe ingresar el final de la fecha.');
                    }
                    $objCourseHour = (new Coursehour())->fill([
                        'date' => $date,
                        'hour_start' => $start,
                        'hour_end' => $end,
                        'status' => 1
                    ]);
                    $objCourseHour->course()->associate($objCourse);
                    $objCourseHour->save();
                }
            }
            DB::commit();
            return response()->json(['message' => 'Curso actualizado correctamente']);

        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

}
