@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Lista de Cursos
            </div>
            <div class="card-body">
                <div id="messages"></div>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover" id="tblList">
                        <thead class="table-light">
                        <tr>
                            <th class="text-center">Estado</th>
                            <th class="text-left">Código</th>
                            <th class="text-left">Asignatura</th>
                            <th class="text-left">Grado</th>
                            <th class="text-left">Sección</th>
                            <th class="text-left">Periodo</th>
                            <th class="text-left">Descripción</th>
                            <th class="text-center"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!empty($courses))
                            @foreach($courses as $key => $item)
                                <tr>
                                    <td class="text-center">
                                        @if ($item->status == 1)
                                            <span class="badge badge-secondary">Sin Calificación</span>
                                        @elseif ($item->status == 2)
                                            <span class="badge badge-success">Aprobado</span>
                                        @else
                                            <span class="badge badge-danger">Desaprobado</span>
                                        @endif
                                    </td>
                                    <td class="text-left">
                                        {{ $item->code }}
                                    </td>
                                    <td class="text-left">
                                        {{ $item->name }}
                                    </td>
                                    <td class="text-left">
                                        {{ $item->grade }}
                                    </td>
                                    <td class="text-left">
                                        {{ $item->section }}
                                    </td>
                                    <td class="text-left">
                                        {{ $item->period }}
                                    </td>
                                    <td class="text-left">
                                        {{ $item->description }}
                                    </td>
                                    <td class="text-center" >
                                        <div class="dropdown" >
                                            <button type="button" role="button" class="btn btn-secondary btn-sm dropdown-toggle"
                                                    data-boundary="viewport" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-th-list" ></i> Opciones
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a href="{{ route('teacher.courses.assistance', ['courseId' => $item->course_id]) }}" class="dropdown-item" >
                                                    <i class="fa fa-list" ></i> Asistencias de alumnos
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
