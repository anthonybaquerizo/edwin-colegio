@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Recursos para el curso {{ $objCourse->name }}
            </div>
            <div class="card-body">
                <div id="messages"></div>
                <form action="{{ route('teacher.courses.resource.save') }}" method="POST" id="frmGeneral" >
                    <input type="hidden" class="d-none" id="course_id" name="course_id" value="{{ $objCourse->id }}" >
                    <div class="row" >
                        <div class="form-group col-md-4 col-12" >
                            <label for="title">
                                Título
                            </label>
                            <input type="text" class="form-control"
                                   id="title" name="title" maxlength="100" value="" >
                        </div>
                        <div class="form-group col-md-8 col-12" >
                            <label for="description">
                                Descripción
                            </label>
                            <textarea name="description" id="description" class="form-control" maxlength="10000"
                                      rows="5"></textarea>
                        </div>
                        <div class="form-group col-12" >
                            <label for="file">
                                Archivo
                            </label>
                            <input type="file" class="form-control" id="file" name="file" value="" >
                        </div>
                    </div>
                </form>
                <div class="d-flex justify-content-end" >
                    <button type="button" role="button" class="btn btn-danger" id="btnSaveResource" >
                        <i class="fa fa-save" ></i> Aregar recurso
                    </button>
                </div>
                <div class="card-title border-bottom" >
                    <h5>Datos del Usuario</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover" id="tblList">
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center">Titulo</th>
                            <th class="text-left">Archivo</th>
                            <th class="text-left">Descripción</th>
                            <th class="text-center" style="width: 100px; min-width: 100px" ></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($resources->isNotEmpty())
                            @foreach($resources as $resource)
                                <tr>
                                    <td class="text-left" >
                                        {{ $resource->title }}
                                    </td>
                                    <td class="text-left" >
                                        <a href="{{ asset($resource->file_path) }}" class="btn btn-link btn-sm"
                                           download="{{ $resource->file_path }}" >
                                            <i class="fa fa-download-alt" ></i> Descargar recurso
                                        </a>
                                    </td>
                                    <td class="text-left" >
                                        {{ $resource->description }}
                                    </td>
                                    <td class="text-left" >
                                        <form action="{{ route('teacher.courses.resource.delete', ['resourceId' => $resource->id]) }}" method="POST" >
                                            <button type="submit" class="btn btn-danger btn-sm" >
                                                <i class="fa fa-trash" ></i> Eliminar
                                            </button>
                                        </form>
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
