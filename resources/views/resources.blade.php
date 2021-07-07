@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Recursos del curso {{ $objCourse->name }}
            </div>
            <div class="card-body">
                <div id="messages"></div>
                <div class="accordion" id="accordionCourse">
                    @if ($resources->isNotEmpty())
                        @foreach($resources as $key => $resource)
                            <div class="card">
                                <div class="card-header" id="heading{{ $key }}">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left" type="button"
                                                data-toggle="collapse"
                                                data-target="#collapse-{{ $key }}" aria-expanded="true"
                                                aria-controls="collapse-{{ $key }}">
                                            {{ $resource->title }}
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapse-{{ $key }}" class="collapse show" aria-labelledby="heading{{ $key }}"
                                     data-parent="#accordionCourse">
                                    <div class="card-body">
                                        <p>
                                            {{ $resource->description }}
                                        </p>
                                        <div class="d-flex justify-content-end" >
                                            <a href="{{ asset($resource->file_path) }}" class="btn btn-link btn-sm"
                                               download="{{ $resource->file_path }}" >
                                                <i class="fa fa-download" ></i> Descargar recurso
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
