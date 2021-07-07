@extends('layouts.app')

@section('content')
    <div class="container" >
        <div class="card">
            <div class="card-header">
                Editar curso
            </div>
            <div class="card-body">
                <div id="messages" ></div>
                <form action="{{ route('admin.course.update', ['id' => $objCourse->id]) }}" method="POST" id="frmGeneral" >
                    @method('put')
                    <div class="row" >
                        <div class="col-xl-4 col-lg-4 col-sm-4 col-12" >
                            <label for="grade_id">
                                Grado
                            </label>
                            <select name="grade_id" id="grade_id" class="custom-select" >
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
                        <div class="col-xl-4 col-lg-4 col-sm-4 col-12"  >
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
                        <div class="col-xl-4 col-lg-4 col-sm-4 col-12" >
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
                        <div class="col-xl-4 col-lg-4 col-sm-4 col-12" >
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
                        <div class="col-xl-4 col-lg-4 col-sm-4 col-12" >
                            <label for="name">
                                Nombre
                            </label>
                            <input type="text" class="form-control"
                                   maxlength="100" id="name" name="name"
                                   value="{{ $objCourse->name }}" >
                        </div>
                        <div class="col-12" >
                            <label for="description">
                                Descripción
                            </label>
                            <textarea id="description" name="description"
                                      rows="5"
                                      class="form-control"  >{{ $objCourse->description }}</textarea>
                        </div>
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
