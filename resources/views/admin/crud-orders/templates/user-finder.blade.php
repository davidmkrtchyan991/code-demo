<ul class="suggestion-list">

    @foreach($users as $user)

        <li onclick="window.userFinder.userFinderCallback('{{$user->toJson()}}');">
            {{$user["name"]}} {{$user["surname"]}} {{$user["email"]}}
        </li>
    @endforeach

</ul>
