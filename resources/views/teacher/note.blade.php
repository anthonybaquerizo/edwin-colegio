@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <span>Notas para {{ $objCourse->name }}</span>
                    <a href="{{ route('teacher.courses') }}"
                       class="btn btn-link btn-sm">
                        regresar al curso
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div id="messages"></div>
                <form action="{{ route('teacher.courses.note.save', ['courseId' => $objCourse->id]) }}"
                      method="POST" id="frmGeneral" >
                    <div class="form-group" >
                        <label for="prom_type">
                            Elegir periodo
                        </label>
                        <select name="prom_type" id="prom_type" class="custom-select" >
                            <option value="1">Promedio 01</option>
                            <option value="2">Promedio 02</option>
                            <option value="3">Promedio 03</option>
                        </select>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-sm table-bordered">
                            <thead class="bg-light" >
                            <tr>
                                <th class="text-center" rowspan="2" >N°</th>
                                <th class="text-center" rowspan="2" >Alumno</th>
                                <th class="text-center" colspan="3" >Nota de Trabajo</th>
                                <th class="text-center" rowspan="2" >Trabajo de Investigación</th>
                                <th class="text-center" rowspan="2" >Examen Final</th>
                                <th class="text-center" colspan="4" >Notas del Sistema</th>
                            </tr>
                            <tr>
                                <td class="text-center" >Nota 1</td>
                                <td class="text-center" >Nota 2</td>
                                <td class="text-center" >Nota 3</td>
                                <td class="text-center" >NT</td>
                                <td class="text-center" >TI</td>
                                <td class="text-center" >EF</td>
                                <td class="text-center" >P01</td>
                            </tr>
                            </thead>
                            <tbody>
                            @if (!empty($result))
                                @foreach($result as $key => $value)
                                    <tr data-position="{{ $key }}" >
                                        <td class="text-center" >
                                            {{ $key + 1 }}
                                        </td>
                                        <td class="text-left" >
                                            {{ $value->student }}
                                        </td>
                                        <td class="text-left" >
                                            <div class="form-group" >
                                                <input type="text" class="form-control calculate-nt"
                                                       id="work_note1[{{ $key }}]" name="work_note1[{{ $key }}]"
                                                       value="" >
                                            </div>
                                        </td>
                                        <td class="text-left" >
                                            <div class="form-group" >
                                                <input type="text" class="form-control calculate-nt"
                                                       id="work_note2[{{ $key }}]" name="work_note2[{{ $key }}]"
                                                       value="" >
                                            </div>
                                        </td>
                                        <td class="text-left" >
                                            <div class="form-group" >
                                                <input type="text" class="form-control calculate-nt"
                                                       id="work_note3[{{ $key }}]" name="work_note3[{{ $key }}]"
                                                       value="" >
                                            </div>
                                        </td>
                                        <td class="text-left" >
                                            <div class="form-group" >
                                                <input type="text" class="form-control calculate-ti"
                                                       id="work_investigation[{{ $key }}]" name="work_investigation[{{ $key }}]"
                                                       value="" >
                                            </div>
                                        </td>
                                        <td class="text-left" >
                                            <div class="form-group" >
                                                <input type="text" class="form-control calculate-ef"
                                                       id="final_exam[{{ $key }}]" name="final_exam[{{ $key }}]"
                                                       value="" >
                                            </div>
                                        </td>
                                        <td class="text-left" >
                                            <div class="form-group" >
                                                <input type="text" class="form-control" readonly
                                                       id="prom_nt[{{ $key }}]" name="prom_nt[{{ $key }}]"
                                                       value="" >
                                            </div>
                                        </td>
                                        <td class="text-left" >
                                            <div class="form-group" >
                                                <input type="text" class="form-control" readonly
                                                       id="prom_ti[{{ $key }}]" name="prom_ti[{{ $key }}]"
                                                       value="" >
                                            </div>
                                        </td>
                                        <td class="text-left" >
                                            <div class="form-group" >
                                                <input type="text" class="form-control" readonly
                                                       id="prom_ef[{{ $key }}]" name="prom_ef[{{ $key }}]"
                                                       value="" >
                                            </div>
                                        </td>
                                        <td class="text-left" >
                                            <div class="form-group" >
                                                <input type="text" class="form-control" readonly
                                                       id="prom_final[{{ $key }}]" name="prom_final[{{ $key }}]"
                                                       value="" >
                                            </div>
                                            <input type="hidden" class="d-none"
                                                   id="user_id[{{ $key }}]" name="user_id[{{ $key }}]"
                                                   value="{{ $value->user_id }}" >
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
                    <button type="button" role="button" class="btn btn-danger" id="btnSaveNote">
                        <i class="fa fa-save"></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
