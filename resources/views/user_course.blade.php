@extends('layouts.app')

@section('content')
    <div class="container" >
        <div class="card">
            <div class="card-header">
                Asignar cursos a {{ $objUser->info->last_name }} {{ $objUser->info->names }}
            </div>
            <div class="card-body">
                <div id="messages" ></div>
                    <div class="d-flex justify-content-start mb-2" >
                        <button type="button" role="button" class="btn btn-primary mr-2" id="btnUserCourse" >
                            <i class="fa fa-save" ></i> Asignar Cursos
                        </button>
                    </div>
                <form action="{{ route('course.user.store', ['userId' => $objUser->id]) }}" method="POST" id="frmGeneral" >
                    <div class="table-responsive" >
                        <table class="table table-sm table-bordered table-hover" id="tblList" >
                            <thead class="table-light" >
                            <tr>
                                <th class="text-center" ></th>
                                <th class="text-left" >Código</th>
                                <th class="text-left" >Asignatura</th>
                                <th class="text-left" >Profesor</th>
                                <th class="text-left" >Grado</th>
                                <th class="text-left" >Sección</th>
                                <th class="text-left" >Periodo</th>
                                <th class="text-left" >Descripción</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($result->isNotEmpty())
                                @foreach($result as $key => $item)
                                    <tr>
                                        <td class="text-center" >
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                       id="course_check_{{ $key }}" name="course_check[]"
                                                       value="{{ $item->id }}" >
                                                <label class="custom-control-label" for="course_check_{{ $key }}"></label>
                                            </div>
                                        </td>
                                        <td class="text-left" >
                                            {{ $item->code }}
                                        </td>
                                        <td class="text-left" >
                                            {{ $item->name }}
                                        </td>
                                        <td class="text-left" >
                                            {{ $item->teacher }}
                                        </td>
                                        <td class="text-left" >
                                            {{ $item->grade }}
                                        </td>
                                        <td class="text-left" >
                                            {{ $item->section }}
                                        </td>
                                        <td class="text-left" >
                                            {{ $item->period }}
                                        </td>
                                        <td class="text-left" >
                                            {{ $item->description }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
