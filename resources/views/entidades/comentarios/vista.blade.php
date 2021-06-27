@foreach ($comentarios as $comentario)
    <div
        class="flex items-left  container w-50 bg-white sm:px-4 px-auto py-3 mt-4 shadow-md overflow-hidden  sm:rounded-lg" >
        <table style="font-family: Arial, Helvetica, sans-serif">
        <tbody id='comentario'>
            <tr>
                <td > {{ $comentario->autor }} Comento: </td>
                <td style="font-family:Italica" >{{  $comentario->contenido }}  </td>
                <td> {{ $comentario->created_at }}</td>
            </tr>
        </tbody>
        <br>
    </table>
    </div>
@endforeach
