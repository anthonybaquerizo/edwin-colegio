@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <span>Notas del curso de {{ $objCourse->name }}</span>
                    <a href="{{ route('course.user.show', ['courseId' => $objCourse->id]) }}"
                       class="btn btn-link btn-sm">
                        regresar al curso
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div id="messages"></div>
                <div class="table-responsive mt-3">
                    <table class="table table-sm table-bordered">
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center" colspan="3">Nota de Trabajo</th>
                            <th class="text-center" rowspan="2">Trabajo de Investigación</th>
                            <th class="text-center" rowspan="2">Examen Final</th>
                            <th class="text-center" colspan="4">Notas del Sistema</th>
                        </tr>
                        <tr>
                            <td class="text-center">Nota 1</td>
                            <td class="text-center">Nota 2</td>
                            <td class="text-center">Nota 3</td>
                            <td class="text-center">NT</td>
                            <td class="text-center">TI</td>
                            <td class="text-center">EF</td>
                            <td class="text-center">P01</td>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!empty($notes))
                            @foreach($notes as $key => $note)
                                @if ($key == 0)
                                    <tr>
                                        <th colspan="10" >PROMEDIO 01</th>
                                    </tr>
                                @endif
                                @if ($key == 1)
                                    <tr>
                                        <th colspan="10" >PROMEDIO 02</th>
                                    </tr>
                                @endif
                                @if ($key == 2)
                                    <tr>
                                        <th colspan="10" >PROMEDIO 03</th>
                                    </tr>
                                @endif
                                <tr data-position="{{ $key }}">
                                    <td class="text-left">
                                        {{ $note->work_note1 }}
                                    </td>
                                    <td class="text-left">
                                        {{ $note->work_note2 }}
                                    </td>
                                    <td class="text-left">
                                        {{ $note->work_note3 }}
                                    </td>
                                    <td class="text-left">
                                        {{ $note->work_investigation }}
                                    </td>
                                    <td class="text-left">
                                        {{ $note->final_exam }}
                                    </td>
                                    <td class="text-left">
                                        {{ $note->prom_nt }}
                                    </td>
                                    <td class="text-left">
                                        {{ $note->prom_ti }}
                                    </td>
                                    <td class="text-left">
                                        {{ $note->prom_ef }}
                                    </td>
                                    <td class="text-left">
                                        {{ $note->prom_final }}
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
