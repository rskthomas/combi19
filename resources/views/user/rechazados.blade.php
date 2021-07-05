<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Viajeros rechazados') }}
        </h2>

    </x-slot>

    @if (!isset($resultado) or $resultado->isEmpty())
    <div class="alert alert-success text-center" role="alert">
        <span>No hay choferes rechazados </span>
    </div>

    @else


    <div class="mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3 ">


                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Mail</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Rechazado hasta</th>

                        </tr>
                    </thead>
                    @foreach ($resultado as $usuario)

                    <tbody id='viajero'>
                        <tr>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>Rechazado</td>
                            <td>{{ $usuario->bloqueado }}</td>

                        </tr>
                    </tbody>

                @endforeach
                </table>


            </div>

        </div>
    </div>

    @endif
</x-app-layout>
