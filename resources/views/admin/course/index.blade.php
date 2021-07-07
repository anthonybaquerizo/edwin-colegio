@extends('layouts.app')

@section('content')
    <div class="container" >
        <div class="card">
            <div class="card-header">
                Lista de Cursos
            </div>
            <div class="card-body">
                <div id="messages" ></div>
                <form action="{{ route('admin.course.index') }}" method="GET" >
                    <div class="row" >
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12" >
                            <div class="form-group" >
                                <label for="txt_dni">
                                    Nombre
                                </label>
                                <input type="text" class="form-control" name="txt_name"
                                       value="" >
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-2" >
                        <a href="{{ route('admin.course.create') }}" class="btn btn-primary mr-2" >
                            <i class="fa fa-plus" ></i> Crear nuevo curso
                        </a>
                        <button type="button" role="button" class="btn btn-danger" >
                            <i class="fa fa-search" ></i> Buscar
                        </button>
                    </div>
                    <div class="table-responsive" >
                        <table class="table table-sm table-bordered table-hover" id="tblList" >
                            <thead class="table-light" >
                            <tr>
                                <th class="text-center" >Fecha</th>
                                <th class="text-left" >Código</th>
                                <th class="text-left" >Asignatura</th>
                                <th class="text-left" >Profesor</th>
                                <th class="text-left" >Grado</th>
                                <th class="text-left" >Sección</th>
                                <th class="text-left" >Periodo</th>
                                <th class="text-left" >Descripción</th>
                                <th class="text-center" ></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($result->isNotEmpty())
                                @foreach($result as $key => $item)
                                    <tr>
                                        <td class="text-center" >
                                            @php echo date('d/m/Y', strtotime($item->created_at)); @endphp
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
                                        <td class="text-center" >
                                            <div class="dropdown" >
                                                <button type="button" role="button" class="btn btn-secondary btn-sm dropdown-toggle"
                                                        data-boundary="viewport" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-th-list" ></i> Opciones
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a href="{{ route('admin.course.edit', ['id' => $item->id]) }}" class="dropdown-item" >
                                                        <i class="fa fa-edit" ></i> Editar
                                                    </a>
                                                </div>
                                            </div>
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
