@extends('layouts.app')

@section('content')
    <div class="container" >
        <div class="card">
            <div class="card-header">
                Lista de {{ $objUserType->name }}
            </div>
            <div class="card-body">
                <div id="messages" ></div>
                <form action="{{ route('admin.user.index', ['type' => $objUserType->id]) }}" method="POST" >
                    <div class="row" >
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12" >
                            <div class="form-group" >
                                <label for="txt_dni">
                                    DNI
                                </label>
                                <input type="text" class="form-control" id="txt_dni"
                                       value="" >
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12" >
                            <div class="form-group" >
                                <label for="txt_names">
                                    Nombre y Apellido
                                </label>
                                <input type="text" class="form-control" id="txt_names"
                                       value="" >
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12" >
                            <div class="form-group" >
                                <label for="txt_username">
                                    Usuario
                                </label>
                                <input type="text" class="form-control" id="txt_username"
                                       value="" >
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-2" >
                        <a href="{{ route('admin.user.create', ['type' => $objUserType->id]) }}" class="btn btn-primary mr-2" >
                            <i class="fa fa-plus" ></i> Crear nuevo {{ $objUserType->name }}
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
                                <th class="text-center" >Nro. Documento</th>
                                <th class="text-left" >{{ $objUserType->name }}</th>
                                <th class="text-left" >Email</th>
                                <th class="text-left" >Usuario</th>
                                <th class="text-center" >Estado</th>
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
                                        <td class="text-center" >
                                            {{ $item->dni }}
                                        </td>
                                        <td class="text-left" >
                                            {{ $item->last_name }}, {{ $item->names }}
                                        </td>
                                        <td class="text-left" >
                                            {{ $item->email }}
                                        </td>
                                        <td class="text-left" >
                                            {{ $item->username }}
                                        </td>
                                        <td class="text-center" >
                                            @if ($item->status)
                                                <span class="badge badge-primary" >Activo</span>
                                            @else
                                                <span class="badge badge-danger" >Inactivo</span>
                                            @endif
                                        </td>
                                        <td class="text-center" >
                                            <div class="dropdown" >
                                                <button type="button" role="button" class="btn btn-secondary btn-sm dropdown-toggle"
                                                        data-boundary="viewport" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-th-list" ></i> Opciones
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a href="{{ route('admin.user.edit', ['id' => $item->id]) }}" class="dropdown-item" >
                                                        <i class="fa fa-edit" ></i> Editar
                                                    </a>
                                                    <button type="button" role="button" class="dropdown-item option-delete"
                                                            data-id="{{ $item->id }}" >
                                                        <i class="fa fa-trash-alt" ></i> Eliminar
                                                    </button>
                                                    @if ($item->user_type_id == 3)
                                                        <a href="{{ route('course.user', ['userId' => $item->id]) }}" class="dropdown-item" >
                                                            <i class="fa fa-th-list" ></i> Elegir Curso(s)
                                                        </a>
                                                    @endif
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
