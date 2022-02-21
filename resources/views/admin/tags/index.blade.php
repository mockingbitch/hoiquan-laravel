<table>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>description</th>
    </tr>
    @foreach($tags as $tag)
    <tr>
        <td>{{$tag->id}}</td>
        <td>{{$tag->name}}</td>
        <td>{{$tag->description}}</td>
    </tr>
    @endforeach

</table>
