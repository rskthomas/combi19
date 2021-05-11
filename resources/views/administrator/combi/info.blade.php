<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Combi - ') }} {{ $combi ->patente }}
        </h2>
    </x-slot>


@if(session()->has('bajaerronea'))

<div class="alert alert-warning text-center" role="alert">
<span>Antes de eliminar la combi debe desasignar la ruta</span>
</div>

@endif

@if(session()->has('tieneruta'))

<div class="alert alert-warning text-center" role="alert">
<span>Antes de eliminar la combi debe eliminar la ruta</span>
</div>

@endif

@if(session()->has('choferanclado'))

<div class="alert alert-warning text-center" role="alert">
<span>No se puede cambiar el chofer - tiene una ruta asignada</span>
</div>

@endif

@if(session()->has('tienechofer'))

<div class="alert alert-warning text-center" role="alert">
<span>No se puede eliminar la combi, tiene un chofer asignado</span>
</div>

@endif

    @if(session()->has('combimodificado'))

    <div class="alert alert-success text-center" role="alert">
        Se ha modificado la combi con exito
    </div>

    @endif
    <div class="py-8 col-md-5 mx-auto ">
        <div class="bg-white border-b border-gray-200 ">

            <div class="container p-2 ">
                <!-- a row -->
                <div class="row p-4 ">
                    <div class="col-sm font-semibold ">Patente </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ $combi->patente }}
                        </div>
                    </div>
                </div>
                <hr />
                <!-- a row -->
                <div class="row p-4 ">
                    <div class="col-sm font-semibold ">Modelo </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ $combi->modelo }}
                        </div>
                    </div>
                </div>
                <hr />
                <!-- a row -->
                <div class="row p-4 ">
                    <div class="col-sm font-semibold ">Cantidad de asientos </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ $combi->asientos }}
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row p-4 ">
                    <div class="col-sm font-semibold ">Tipo de combi </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ $combi->tipo_de_combi }}
                        </div>
                    </div>
                </div>
                <hr />
                <!-- a row -->
                <div class="row p-4 ">
                    <div class="col-sm font-semibold ">Chofer</div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            @isset($combi->chofer)
                            <a href="{{ route('profile', ['user' => $combi->chofer]) }}">
                            {{ $combi->chofer->name }}</a>
                            @else
                              Libre
                            @endisset
                        </div>
                    </div>
                </div>
                <hr />
                <!-- a row -->
                <div class="row p-4 ">
                    <div class="col-sm font-semibold ">Ruta asignada</div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            @isset($combi->ruta)
                            <a href="{{ route('inforuta', ['ruta' => $combi->ruta]) }}">
                            {{ $combi->ruta->id}}</a>
                            @else
                              <p>No hay ruta asiganada</p>
                            @endisset
                        </div>
                    </div>
                </div>
                <hr />
                <!-- a row -->
                <div class="row p-3 mt-3">
                    <div class="col-sm "> Combi registrada el </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ $combi->created_at ->format('Y-m-d') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (Auth::user()->hasRole('administrator'))

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">
                    <!-- Eliminar-->
                    <div class="text-center p-4 ">
                    <a href="#ventanaModal" style="text-decoration:none" data-toggle="modal">
                        <button type="button" class="btn btn-primary" title="Eliminar combi">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-trash" viewBox="0 0 16 16">
                                <path
                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                <path fill-rule="evenodd"
                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                            </svg>
                        </button>
                        <p class="font-semibold text-sm text-gray-700">Eliminar Combi </p>
                    </a>
                </div>
                </th>

                <th scope="col">
                    <div class="text-center p-4 ">
                        <a style="text-decoration:none" href="{{ route('combi.edit', ['combi' => $combi]) }}">
                            <button type="button" class="btn btn-primary" title="Editar chofer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path
                                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                </svg>
                            </button>
                            <p class="font-semibold text-sm text-gray-700">Editar Combi </p>
                        </a>
                    </div>

                </th>

            </tr>
        </thead>
    </table>
    <!-- Modal -->
    <div class="modal fade" id="ventanaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Chofer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Esta seguro que desea eliminar la combi ?
                    {{ $combi->patente }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <form action="{{ route('combi.delete', ['combi' => $combi]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif
</x-app-layout>
