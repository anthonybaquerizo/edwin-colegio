@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Editar curso
            </div>
            <div class="card-body">
                <div id="messages"></div>
                <form action="{{ route('admin.course.update', ['id' => $objCourse->id]) }}" method="POST"
                      id="frmGeneral">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-sm-4 col-12">
                            <label for="grade_id">
                                Grado
                            </label>
                            <select name="grade_id" id="grade_id" class="custom-select">
                                <option value="">Elegir</option>
                                @if($grades->isNotEmpty())
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->id }}"
                                                @if ($objCourse->course_grade_id == $grade->id) selected @endif >
                                            {{ $grade->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-sm-4 col-12">
                            <label for="section_id">
                                Sección
                            </label>
                            <select name="section_id" id="section_id" class="custom-select">
                                <option value="">Elegir</option>
                                @if($sections->isNotEmpty())
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}"
                                                @if ($objCourse->course_section_id == $section->id) selected @endif >
                                            {{ $section->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-sm-4 col-12">
                            <label for="period_id">
                                Sección
                            </label>
                            <select name="period_id" id="period_id" class="custom-select">
                                <option value="">Elegir</option>
                                @if($periods->isNotEmpty())
                                    @foreach($periods as $period)
                                        <option value="{{ $period->id }}"
                                                @if ($objCourse->course_period_id == $period->id) selected @endif >
                                            {{ $period->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-sm-4 col-12">
                            <label for="teacher_id">
                                Profesor
                            </label>
                            <select name="teacher_id" id="teacher_id" class="custom-select">
                                <option value="">Elegir</option>
                                @if(!empty($teachers))
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}"
                                                @if ($objCourse->user_teacher_id == $teacher->id) selected @endif >
                                            {{ $teacher->info->last_name }} {{ $teacher->info->names }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-sm-4 col-12">
                            <label for="name">
                                Nombre
                            </label>
                            <input type="text" class="form-control"
                                   maxlength="100" id="name" name="name"
                                   value="{{ $objCourse->name }}">
                        </div>
                        <div class="col-12">
                            <label for="description">
                                Descripción
                            </label>
                            <textarea id="description" name="description"
                                      rows="5"
                                      class="form-control">{{ $objCourse->description }}</textarea>
                        </div>
                        <div class="col-12" >
                            <label for="syllable">
                                Sílabo
                            </label>
                            <input type="file" class="form-control" id="syllable" name="syllable" value="" >
                        </div>
                    </div>
                    <div class="card-title border-bottom mt-3">
                        <h5>Horario</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered" id="tblCourseDates">
                            <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th style="width: 100px; min-width: 100px" ></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (!empty($dates))
                                @php $position = 0; @endphp
                                @foreach ($dates as $key => $value)
                                    <tr data-position="@php echo $position @endphp">
                                        <td>
                                            <div class="form-group">
                                                <input type="date" class="form-control"
                                                       id="course_date_value[@php echo $position @endphp]"
                                                       name="course_date_value[@php echo $position @endphp]"
                                                       value="{{ $value->date->format('Y-m-d') }}"/>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="time" class="form-control"
                                                       id="course_date_start[@php echo $position @endphp]"
                                                       name="course_date_start[@php echo $position @endphp]"
                                                       value="{{ $value->hour_start }}"/>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="time" class="form-control"
                                                       id="course_date_end[@php echo $position @endphp]"
                                                       name="course_date_end[@php echo $position @endphp]"
                                                       value="{{ $value->hour_end }}"/>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" role="button"
                                                    class="btn btn-danger btn-sm option-course-hour-delete">
                                                <i class="fa fa-trash"></i> Eliminar
                                            </button>
                                            <input type="hidden" class="d-none"
                                                   id="course_date_operation[@php echo $position @endphp]"
                                                   name="course_date_operation[@php echo $position @endphp]"
                                                   value="1">
                                        </td>
                                    </tr>
                                    @php ++$position @endphp
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="4">
                                    <button type="button" role="button" class="btn btn-secondary btn-sm"
                                            id="btnAddCourseDate">
                                        <i class="fa fa-plus"></i> Agregar fecha
                                    </button>
                                </th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" role="button" class="btn btn-danger" id="btnSaveCourse">
                        <i class="fa fa-save"></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
