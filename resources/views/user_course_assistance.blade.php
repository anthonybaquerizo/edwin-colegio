@extends('layouts.app')

@section('content')
    <div class="container" >
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between" >
                    <span>Mis asistencias</span>
                    <a href="{{ route('course.user.show', ['courseId' => $objUserCourse->course_id]) }}"
                       class="btn btn-link btn-sm" >
                        regresar al curso
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div id="appHome" ></div>
                <div class="table-responsive" >
                    <table class="table table-sm table-bordered" >
                        <thead>
                        <tr>
                            <th class="text-center" >Fecha</th>
                            <th class="text-center" >Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!empty($objUserCourse->assistance->isNotEmpty()))
                            @foreach($objUserCourse->assistance as $objAssistance)
                                <tr>
                                    <td class="text-center" >
                                        <h3 class="text-danger" >
                                            {{ $objAssistance->hour->date->day }}
                                        </h3>
                                        {{ $objAssistance->hour->date->monthName }} del {{ $objAssistance->hour->date->year }}
                                    </td>
                                    <td class="text-center" >
                                        @if ($objAssistance->status == 1)
                                            Asistió
                                        @elseif ($objAssistance->status == 2)
                                            Tardanza
                                        @else
                                            <span class="text-danger" >Faltó</span>
                                        @endif
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
