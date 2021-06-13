<div class="card" id="listaproductos" hidden>

@if ($productos->isEmpty())
        <div class="alert alert-success text-center" role="alert">
            <span> Por el momento no tenemos productos disponibles, disculpe las molestias </span>
        </div>

    @else

    <div class="card-body">
        <h5 class="card-title">Seleccione los Productos que desea Agregar</h5>
        
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Nombre </th>
                    <th scope="col">Precio</th>
                    <th scope="col"> </th>
                    <th scope="col"> Cantidad </th>
                    <th scope="col"> Total</th>

                </tr>

            </thead>
            @foreach ($productos as $producto)

            <tbody id='{{$producto->id}}'>
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    {{-- Decidir si la descripcion se muestra solo en el show o aca, lo dejo en el show solamente, me parece mejor --}}
                    <td>{{ $producto->precio }}</td>


                    <!-- BOTONES -->
                    <td>
                    <button type="button" class="btn " title="agregar" id="addProducto" onclick="agregar('{{$producto->id}}','{{$producto->precio}}')">
                        <svg id="add" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg>

                    </button>
                    <button type="button" class="btn " title="sacar" id="subsProducto"  onclick="substraer('{{$producto->id}}','{{$producto->precio}}')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                        </svg>

                    </button>

                    </td>
                    <td> 
                   
                        <input type="text" class="form-control-plaintext" id="cantidad{{$producto->id}}" value="0" disabled>

                    </td>
                    <td> 
                   
                   <input type="text" class="form-control-plaintext" id="total{{$producto->id}}" value="0" disabled>

               </td>
                </tr>
            </tbody>
            @endforeach
        </table>

    </div>

    @endif
</div>
