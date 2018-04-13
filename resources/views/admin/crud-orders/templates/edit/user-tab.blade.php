@if($order->isEditable&& !$order->id)
    <div class="form-group">
        <label for="name" class="col-sm-1 control-label">Найти клиента</label>
        <div class="col-sm-9 frmSearch">
            <input type="text" id="emailToFind" autocomplete="off" name="emailToFind" placeholder="Ел. почта" class="form-control">
            <div id="users-suggesstion-box"></div>
        </div>
    </div>
@endif

<div class="form-group">
    <label for="name" class="col-sm-1 control-label">Имя</label>
    <div class="col-sm-9">
        <input type="text" id="userName" name="userName" value="{{$order->user->name}}" readonly="readonly" class="form-control">
    </div>
</div>

<div class="form-group">
    <label for="name" class="col-sm-1 control-label">Фамилия</label>
    <div class="col-sm-9">
        <input type="text" id="userSurname" name="userSurname" value="{{$order->user->surname}}" readonly="readonly"
               placeholder="" class="form-control"
               autofocus>
    </div>
</div>

<div class="form-group">
    <label for="email" class="col-sm-1 control-label">Ел. почта</label>
    <div class="col-sm-9">
        <input type="email" id="userEmail" name="userEmail" value="{{$order->user->email}}" readonly="readonly"
               placeholder="" class="form-control">
    </div>
</div>

@if($order->isEditable)
    <input id="findUserURL" type="hidden" disabled="disabled" value="{{action('OrderController@findUser')}}"/>
    <input type="text" name="userId" id="userId" hidden value="{{old('userId')}}"/>
@endif