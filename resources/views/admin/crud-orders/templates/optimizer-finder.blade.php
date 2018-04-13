<ul class="suggestion-list">

    @foreach($optimizers as $optimizer)
        <li onclick="window.optimizerFinder.optimizerFinderCallback('{{$optimizer->toJson()}}');">
            {{$optimizer["name"]}} {{$optimizer["surname"]}} {{$optimizer["email"]}}
        </li>
    @endforeach

</ul>
