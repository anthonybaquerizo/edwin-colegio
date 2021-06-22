@extends('layouts.app')

@section('content')
    <div class="container" >
        <div class="card">
            <div class="card-header">
                Datos Basicos
            </div>
            <div class="card-body">
                <div id="appHome" ></div>
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                        <div class="text-center" style="width: 100%; height: 260px" >
                            @if (!empty(Auth::user()->info->photo_path))
                                <img src="{{ asset(Auth::user()->info->photo_path) }}"
                                     class="img-thumbnail" alt="Logo Usuario"
                                     style="width: auto; height: auto; max-width: 100%; max-height: 100%;" >
                            @else
                                <img src="https://img2.freepng.es/20190602/qht/kisspng-clip-art-school-student-pupil-boy-5cf488ebcac7d5.8566665615595297078306.jpg"
                                     class="img-thumbnail" alt="Logo Usuario"
                                     style="width: auto; height: auto; max-width: 100%; max-height: 100%;" >
                            @endif
                        </div>
                        <div class="form-group" >
                            <input type="file" class="form-control" id="change_photo"
                                   value="" >
                            <small class="text-muted" >Solo se permite jpg o png</small>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                        <div class="form-group row">
                            <label for="txt_dni" class="col-xl-2 col-lg-2 col-md-3 col-sm-5 col-12">
                                DNI
                            </label>
                            <div class="col-xl-10 col-lg-10 col-md-9 col-sm-7 col-12">
                                <input type="text" class="form-control disabled" id="txt_dni" maxlength="8"
                                       value="{{ Auth::user()->info->dni }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txt_lastname" class="col-xl-2 col-lg-2 col-md-3 col-sm-5 col-12">
                                Apellidos
                            </label>
                            <div class="col-xl-10 col-lg-10 col-md-9 col-sm-7 col-12">
                                <input type="text" class="form-control" id="txt_lastname" maxlength="100"
                                       value="{{ Auth::user()->info->last_name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txt_names" class="col-xl-2 col-lg-2 col-md-3 col-sm-5 col-12">
                                Nombres
                            </label>
                            <div class="col-xl-10 col-lg-10 col-md-9 col-sm-7 col-12">
                                <input type="text" class="form-control" id="txt_names" maxlength="100"
                                       value="{{ Auth::user()->info->names }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txt_email" class="col-xl-2 col-lg-2 col-md-3 col-sm-5 col-12">
                                E-mail
                            </label>
                            <div class="col-xl-10 col-lg-10 col-md-9 col-sm-7 col-12">
                                <input type="text" class="form-control" id="txt_email" maxlength="100"
                                       value="{{ Auth::user()->email }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txt_email" class="col-xl-2 col-lg-2 col-md-3 col-sm-5 col-12">
                                Nro. Célular
                            </label>
                            <div class="col-xl-10 col-lg-10 col-md-9 col-sm-7 col-12">
                                <input type="text" class="form-control" id="txt_phone" maxlength="50"
                                       value="{{ Auth::user()->info->phone }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cbo_gender" class="col-xl-2 col-lg-2 col-md-3 col-sm-5 col-12">
                                Sexo
                            </label>
                            <div class="col-xl-10 col-lg-10 col-md-9 col-sm-7 col-12">
                                <select class="custom-select" id="cbo_gender" >
                                    <option value="H" @if (Auth::user()->info->gender === 'H') selected @endif >Hombre</option>
                                    <option value="M" @if (Auth::user()->info->gender === 'M') selected @endif >Mujer</option>
                                    <option value="O" @if (Auth::user()->info->gender === 'O') selected @endif >Reservado</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-title border-bottom" >
                            <h5>Datos del Usuario</h5>
                        </div>
                        <div class="form-group row">
                            <label for="txt_email" class="col-xl-2 col-lg-2 col-md-3 col-sm-5 col-12">
                                Usuario
                            </label>
                            <div class="col-xl-10 col-lg-10 col-md-9 col-sm-7 col-12">
                                <input type="text" class="form-control" id="txt_username"
                                       maxlength="0" readonly
                                       value="{{ Auth::user()->username }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txt_email" class="col-xl-2 col-lg-2 col-md-3 col-sm-5 col-12">
                                Nueva Contraseña
                            </label>
                            <div class="col-xl-10 col-lg-10 col-md-9 col-sm-7 col-12">
                                <input type="text" class="form-control" id="txt_password" maxlength="100"
                                       value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer" >
                <div class="d-flex justify-content-end" >
                    <button type="button" role="button" class="btn btn-danger" id="btnUpdate" >
                        <i class="fa fa-sync-alt" ></i> Actualizar datos
                    </button>
                </div>
            </div>
        </div>
        <div class="card mt-4" >
            <div class="card-header">
                Plan de Estudio
            </div>
            <div class="card-body">
                <div class="table table-responsive" >
                    <table class="table table-bordered" >
                        <thead class="bg-light" >
                        <tr>
                            <th class="text-center" >Periodo</th>
                            <th>Grado</th>
                            <th>Sección</th>
                            <th>Turno</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="table-active" >
                            <td class="text-center" >
                                2021
                            </td>
                            <td class="" >
                                1 Secundaria
                            </td>
                            <td class="" >
                                A
                            </td>
                            <td class="" >
                                Tarde
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" >
                                2020
                            </td>
                            <td class="" >
                                6 Primaria
                            </td>
                            <td class="" >
                                A
                            </td>
                            <td class="" >
                                Tarde
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" >
                                2019
                            </td>
                            <td class="" >
                                5 Primaria
                            </td>
                            <td class="" >
                                A
                            </td>
                            <td class="" >
                                Tarde
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
