@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Matricula asignada <br>
                <div class="btn-group" >
                    <a href="{{ route('course.user.hour', ['courseId' => $objCourse->id]) }}" class="btn btn-secondary btn-sm" >
                        <i class="fa fa-angle-right"></i> Mis asistencias
                    </a>
                    <a href="{{ route('course.user.hour', ['courseId' => $objCourse->id]) }}" class="btn btn-secondary btn-sm" >
                        <i class="fa fa-angle-right"></i> Mis Notas
                    </a>
                    <a href="{{ route('user.resources', ['courseId' => $objCourse->id]) }}" class="btn btn-secondary btn-sm" >
                        <i class="fa fa-angle-right"></i> Recursos
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div id="messages"></div>
                <div class="accordion" id="accordionCourse">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Información
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                             data-parent="#accordionCourse">
                            <div class="card-body">
                                <div class="table table-responsive" >
                                    <table class="table table-sm" >
                                        <tr>
                                            <td class="text-left" >Grado</td>
                                            <td class="text-left" >
                                                {{ $objCourse->grade->name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left" >Seción</td>
                                            <td class="text-left" >
                                                {{ $objCourse->section->name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left" >Periodo</td>
                                            <td class="text-left" >
                                                {{ $objCourse->period->name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left" >Profesor</td>
                                            <td class="text-left" >
                                                {{ $objCourse->teacher->info->last_name }} {{ $objCourse->teacher->info->names }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left" >Código</td>
                                            <td class="text-left" >
                                                {{ $objCourse->code }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left" >Nombre</td>
                                            <td class="text-left" >
                                                {{ $objCourse->name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left" >Descripción</td>
                                            <td class="text-left" >
                                                {{ $objCourse->description }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                    Formulas
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                             data-parent="#accordionCourse">
                            <div class="card-body">
                                <div class="table-responsive" >
                                    <table class="table table-sm" >
                                        <tr>
                                            <td class="text-left" >
                                                Promedio 01
                                            </td>
                                            <td class="text-left" >
                                                0.2 * NT + 0.3 * TI + 0.5 * EF
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left" >
                                                Promedio 02
                                            </td>
                                            <td class="text-left" >
                                                0.2 * NT + 0.3 * TI + 0.5 * EF
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left" >
                                                Promedio 03
                                            </td>
                                            <td class="text-left" >
                                                0.2 * NT + 0.3 * TI + 0.5 * EF
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left" >
                                                Promedio Final
                                            </td>
                                            <td class="text-left" >
                                                (PROM01 + PROM02 + PROM03) / 3
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                    Horario
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                             data-parent="#accordionCourse">
                            <div class="card-body">
                                <div class="table table-responsive" >
                                    <table class="table table-sm table-bordered" >
                                        <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Horas</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if ($objCourse->hours->isNotEmpty())
                                            @foreach($objCourse->hours as $objHour)
                                                <tr>
                                                    <td class="text-left" >{{ $objHour->date->format('d/m/Y') }}</td>
                                                    <td class="text-left" >{{ $objHour->hour_start }} - {{ $objHour->hour_end }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapseFour" aria-expanded="false"
                                        aria-controls="collapseFour">
                                    Sílabo
                                </button>
                            </h2>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                             data-parent="#accordionCourse">
                            <div class="card-body">
                                @if (empty($objCourse->syllable))
                                    <h3>NO CUENTA CON UN SÍLABO</h3>
                                @else
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item"
                                                src="{{ asset($objCourse->syllable) }}" allowfullscreen>
                                        </iframe>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
