<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Ruta - ') }} {{ $ruta ->salida->nombre}} - {{ $ruta ->llegada->nombre}}
        </h2>
    </x-slot>
    @if(session()->has('rutamodificada'))

<div class="alert alert-success text-center" role="alert">
    Se ha modificado la ruta con exito
</div>

@endif


    <div class="py-8 col-md-5 mx-auto ">
        <div class="bg-white border-b border-gray-200 ">

            <div class="container p-2 ">
                <!-- a row -->
                <div class="row p-4 ">
                    <div class="col-sm font-semibold ">Lugar de salida </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ $ruta->salida->nombre}}
                        </div>
                    </div>
                </div>

                <hr />
                <!-- a row -->
                <div class="row p-4 ">
                    <div class="col-sm font-semibold ">Lugar de llegada </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{$ruta->llegada->nombre}}
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row p-4 ">
                    <div class="col-sm font-semibold ">Combi Asignada </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            <a href="{{ route('combi.info', ['combi' => $ruta->combi]) }}">

                        {{ $ruta->combi->patente  }} </a><!-- ponerle un link -->
                        </div>
                    </div>
                </div>
                <hr />

                  <!-- a row -->
                  <div class="row p-4 ">
                    <div class="col-sm font-semibold ">Tiempo estimado de viaje</div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ $ruta->tiempo}}
                        </div>
                    </div>
                </div>
                <hr />

                <!-- a row -->
                <div class="row p-4 ">
                    <div class="col-sm font-semibold ">kilometros aproximados</div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ $ruta->kms}}
                        </div>
                    </div>
                </div>
                <hr />




                <!-- a row -->
                <div class="row p-3 mt-3">
                    <div class="col-sm "> Ruta registrada el  </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ $ruta->created_at ->format('Y-m-d') }}
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
                        <button type="button" class="btn btn-primary" title="Eliminar chofer">
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
                        <a style="text-decoration:none" href="{{ route('editarruta', ['ruta' => $ruta->id])  }}">
                            <button type="button" class="btn btn-primary" title="Editar ruta">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path
                                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                </svg>
                            </button>
                            <p class="font-semibold text-sm text-gray-700">Editar Ruta </p>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Ruta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Esta seguro que desea eliminar la ruta
                    {{$ruta->id}} ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <a href="{{ route('eliminarruta',['ruta' => $ruta]) }}">
                        <button type="button" class="btn btn-danger">Eliminar</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif
</x-app-layout>
