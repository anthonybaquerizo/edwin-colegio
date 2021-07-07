@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <span>Asistencia para {{ $objCourse->name }}</span>
                    <a href="{{ route('teacher.courses') }}"
                       class="btn btn-link btn-sm">
                        regresar al curso
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div id="messages"></div>
                <form action="{{ route('teacher.courses.assistance', ['courseId' => $objCourse->id]) }}">
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="">Fecha</label>
                            <select name="date" id="date" class="custom-select">
                                @if (!empty($dates))
                                    @foreach($dates as $value)
                                        <option value="{{ $value->date }}"
                                                @if($date == $value->date) selected @endif >
                                            {{ $value->date }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger btn-sm mb-3">
                        <i class="fa fa-sync-alt"></i> Ver Asistencias
                    </button>
                </form>
                <form action="{{ route('teacher.courses.assistance.save') }}" method="POST" id="frmGeneral" >
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                            <tr>
                                <th class="text-left">Alumno</th>
                                <th class="text-left">Estado</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (!empty($assistance))
                                @foreach($assistance as $value)
                                    <tr>
                                        <td class="text-left">
                                            {{ $value->student }}
                                        </td>
                                        <td class="text-left">
                                            <select name="assistance_status[]" id="assistance_status[]"
                                                    class="custom-select">
                                                <option value="0" @if($value->status == 0) selected @endif >Faltó
                                                </option>
                                                <option value="1" @if($value->status == 1) selected @endif >Asistió
                                                </option>
                                                <option value="2" @if($value->status == 2) selected @endif >Tardanza
                                                </option>
                                            </select>
                                            <input type="hidden" class="d-none"
                                                   id="assistance_id[]" name="assistance_id[]"
                                                   value="{{ $value->id }}">
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" role="button" class="btn btn-danger" id="btnSaveAssistance">
                        <i class="fa fa-save"></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
