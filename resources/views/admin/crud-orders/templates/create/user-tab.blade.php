<div class="form-group">
    <label for="name" class="col-sm-1 control-label">Найти клиента</label>
    <div class="col-sm-9 frmSearch">
        <input type="text" id="emailToFind" autocomplete="off" value="{{old('emailToFind')}}" name="emailToFind" placeholder="@lang('custom.user.finder.placeholder')" class="form-control">
        <div id="users-suggesstion-box"></div>
    </div>
</div>

<div class="form-group">
    <label for="name" class="col-sm-1 control-label">Имя</label>
    <div class="col-sm-9">
        <input type="text" id="userName" name="userName" readonly="readonly" value="{{old('userName')}}" class="form-control">
    </div>
</div>

<div class="form-group">
    <label for="name" class="col-sm-1 control-label">Фамилия</label>
    <div class="col-sm-9">
        <input type="text" id="userSurname" name="userSurname" readonly="readonly" value="{{old('userSurname')}}" class="form-control">
    </div>
</div>

<div class="form-group">
    <label for="email" class="col-sm-1 control-label">Ел. почта</label>
    <div class="col-sm-9">
        <input type="email" id="userEmail" name="userEmail" readonly="readonly" value="{{old('userEmail')}}" class="form-control">
    </div>
</div>


<input id="findUserURL" type="hidden" disabled="disabled" value="{{action('OrderController@findUser')}}"/>
<input type="text" name="userId" id="userId" hidden value="{{old('userId')}}"/>