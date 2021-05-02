<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="js/pagination.js"></script>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Mail</th>
                            <th scope="col"></th>

                        </tr>
                    </thead>
                 @foreach ($resultado as $chofer)
                    
                    <tbody id='choferes'>
                        <tr>
                            <td>{{$chofer->name}}</td> 
                            <td>{{$chofer->email}}</td>
                            <td ><button type="button" class="btn btn-primary">Modificar</button>
                            <button type="button" class="btn btn-primary">Eliminar</button>

                        </td>

                        </tr>
                    </tbody>
                @endforeach
                 
                </table>

               <!--  <div class="container">
                    <nav aria-label="...">
                        <ul class="pagination pagination-lg" id="choferes-paginador">
                        </ul>
                    </nav>
                </div>
 -->
            </div>

            
        </div>
    </div>
</x-app-layout>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>