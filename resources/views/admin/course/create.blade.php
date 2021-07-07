@extends('layouts.app')

@section('content')
    <div class="container" >
        <div class="card">
            <div class="card-header">
                Crear nuevo curso
            </div>
            <div class="card-body">
                <div id="messages" ></div>
                <form action="{{ route('admin.course.store') }}" method="POST" id="frmGeneral" >
                    <div class="row" >
                        <div class="col-xl-4 col-lg-4 col-sm-4 col-12" >
                            <label for="grade_id">
                                Grado
                            </label>
                            <select name="grade_id" id="grade_id" class="custom-select" >
                                <option value="">Elegir</option>
                                @if($grades->isNotEmpty())
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
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
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
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
                                        <option value="{{ $period->id }}">{{ $period->name }}</option>
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
                                        <option value="{{ $teacher->id }}">
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
                                   value="" >
                        </div>
                        <div class="col-12" >
                            <label for="description">
                                Descripción
                            </label>
                            <textarea id="description" name="description"
                                      rows="5"
                                      class="form-control"  ></textarea>
                        </div>
                    </div>
                    <div class="card-title border-bottom mt-3" >
                        <h5>Horario</h5>
                    </div>
                    <div class="table-responsive" >
                        <table class="table table-sm table-bordered" id="tblCourseDates" >
                            <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th style="width: 100px; min-width: 100px" ></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="4" >
                                    <button type="button" role="button" class="btn btn-secondary btn-sm" id="btnAddCourseDate" >
                                        <i class="fa fa-plus" ></i> Agregar fecha
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
