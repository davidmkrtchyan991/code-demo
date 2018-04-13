@extends('components.index')

@section('content')
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div><br/>
    @endif
    <div class="col-xs-12 col-md-12">
        @foreach($checklists as $checklist)
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">
                        <strong>{{$checklist->maintenance['name']}}</strong>
                    </th>

                    <th scope="col" class="text-right"><a
                                href="{{action('ChecklistController@show', $checklist['id'])}}"
                                class="btn btn-success">Показать</a>
                        @if(!$checklist->maintenance->isKeywords())
                            <a href="{{action('ChecklistController@edit', $checklist['id'])}}"
                               class="btn btn-warning">Редактировать</a>
                        @endif
                    </th>
                </tr>
                </thead>
                <span style="display: none;">{{$i = 1}}</span>
                @foreach($checklist->items as $item )
                    <tr>
                        <td colspan="5">{{$i++}}. {{$item->name}}</td>
                    </tr>
                @endforeach
            </table>
        @endforeach
    </div>
    {{ $checklists->links() }}
@endsection