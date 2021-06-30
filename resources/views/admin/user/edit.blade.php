@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Editar {{ $objUserType->name }}
            </div>
            <div class="card-body">
                <div id="messages"></div>
                <input type="hidden" class="d-none" id="user_id" maxlength="0" readonly
                       value="{{ $objUser->id }}">
                <input type="hidden" class="d-none" id="txt_type" maxlength="0" readonly
                       value="{{ $objUserType->id }}">
                <div class="form-group" >
                    <label for="change_photo">
                        Foto del {{ $objUserType->name }}
                    </label>
                    <input type="file" class="form-control" id="photo"
                           value="" >
                    <small class="text-muted" >Solo se permite jpg o png</small>
                </div>
                <div class="form-group row">
                    <label for="txt_dni" class="col-xl-2 col-lg-2 col-md-3 col-sm-5 col-12">
                        DNI
                    </label>
                    <div class="col-xl-10 col-lg-10 col-md-9 col-sm-7 col-12">
                        <input type="text" class="form-control disabled" id="txt_dni" maxlength="8"
                               value="{{ $objUserInfo->dni }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="txt_lastname" class="col-xl-2 col-lg-2 col-md-3 col-sm-5 col-12">
                        Apellidos
                    </label>
                    <div class="col-xl-10 col-lg-10 col-md-9 col-sm-7 col-12">
                        <input type="text" class="form-control" id="txt_lastname" maxlength="100"
                               value="{{ $objUserInfo->last_name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="txt_names" class="col-xl-2 col-lg-2 col-md-3 col-sm-5 col-12">
                        Nombres
                    </label>
                    <div class="col-xl-10 col-lg-10 col-md-9 col-sm-7 col-12">
                        <input type="text" class="form-control" id="txt_names" maxlength="100"
                               value="{{ $objUserInfo->names }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="txt_email" class="col-xl-2 col-lg-2 col-md-3 col-sm-5 col-12">
                        E-mail
                    </label>
                    <div class="col-xl-10 col-lg-10 col-md-9 col-sm-7 col-12">
                        <input type="text" class="form-control" id="txt_email" maxlength="100"
                               value="{{ $objUser->email }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="txt_email" class="col-xl-2 col-lg-2 col-md-3 col-sm-5 col-12">
                        Nro. Célular
                    </label>
                    <div class="col-xl-10 col-lg-10 col-md-9 col-sm-7 col-12">
                        <input type="text" class="form-control" id="txt_phone" maxlength="50"
                               value="{{ $objUserInfo->phone }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="cbo_gender" class="col-xl-2 col-lg-2 col-md-3 col-sm-5 col-12">
                        Sexo
                    </label>
                    <div class="col-xl-10 col-lg-10 col-md-9 col-sm-7 col-12">
                        <select class="custom-select" id="cbo_gender">
                            <option value="H" @if($objUserInfo->gender === 'H') selected @endif >Hombre</option>
                            <option value="M" @if($objUserInfo->gender === 'M') selected @endif >Mujer</option>
                            <option value="O" @if($objUserInfo->gender === 'O') selected @endif >Reservado
                            </option>
                        </select>
                    </div>
                </div>
                <div class="card-title border-bottom">
                    <h5>Datos del Usuario</h5>
                </div>
                <div class="form-group row">
                    <label for="txt_email" class="col-xl-2 col-lg-2 col-md-3 col-sm-5 col-12">
                        Usuario
                    </label>
                    <div class="col-xl-10 col-lg-10 col-md-9 col-sm-7 col-12">
                        <input type="text" class="form-control" id="txt_username"
                               maxlength="100"
                               value="{{ $objUser->username }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="txt_email" class="col-xl-2 col-lg-2 col-md-3 col-sm-5 col-12">
                        Nueva Contraseña
                    </label>
                    <div class="col-xl-10 col-lg-10 col-md-9 col-sm-7 col-12">
                        <input type="text" class="form-control" id="txt_password"
                               maxlength="100"
                               value="">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" role="button" class="btn btn-danger" id="btnSaveEdit">
                        <i class="fa fa-save"></i> Guardar datos
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
