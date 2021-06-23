@foreach ($comentarios as $comentario)
    <div
        class="flex items-left  container w-50 bg-white sm:px-2 px-auto py-3 mt-4 shadow-md overflow-hidden sm:rounded-lg ">
        <tbody id='comentario'>
            <tr>
                <td> {{ $comentario->autor }} Comento: </td>
                <td> {{ $comentario->contenido }}</td>
                <td> {{ $comentario->created_at }}</td>
            </tr>
        </tbody>
        <br>
        <hr border: 5; height: 2px; border-top: 1px dashed black; border-bottom: 1px dashed black;>
        <hr border: 5; height: 2px; border-top: 1px dashed black; border-bottom: 1px dashed black;>
    </div>
@endforeach
