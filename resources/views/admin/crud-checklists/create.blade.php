@extends('components.index')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br/>
    @endif
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div><br/>
    @endif
    <form method="post" action="{{url('admin/checklists')}}" class="form-horizontal input-append" role="form">
        {{csrf_field()}}

        <div class="form-group">
            <label for="tariff" class="col-sm-3 control-label">@lang("checklist.tariffs.label")</label>
            <div class="col-sm-9">
                <select data-placeholder="@lang("checklist.tariffs.label")" multiple name="tariff[]" id="tariff[]" class="chosen-select form-control" required>
                    <option value=""></option>
                    @foreach ($tariffs as $tariff)
                        <option value="{{$tariff['id']}}">
                            {{$tariff['name']}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="maintenance" class="col-sm-3 control-label">Имя чеклиста</label>
            <div class="col-sm-9">
                <select name="maintenance" id="maintenance" class="form-control">
                    <option value=""></option>
                    @foreach ($maintenances as $maintenance)
                        <option value="{{$maintenance['id']}}">
                            @lang($maintenance['name'])
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <input type="hidden" name="count" value="1"/>
        <div class="form-group" id="fields">
            <label class="col-sm-3 control-label" for="field1">Добавить поле</label>
            <div class="controls" id="profs">
                <div id="field" class="col-sm-9">
                    <input autocomplete="off" class="input form-control" id="field1" name="prop[]" type="text"
                           placeholder="" data-items="8"/>
                    <button id="b1" class="btn add-more" type="button">+</button>
                </div>
            </div>
            <br>
            <small>Нажмите + для добавления пункта</small>
        </div>

        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-3 pull-right">
                <button type="submit" class="btn btn-primary btn-block">Создать чеклист</button>
            </div>
        </div>
    </form>
@endsection

