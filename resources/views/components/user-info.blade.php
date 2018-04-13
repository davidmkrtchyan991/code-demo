<?php /**/
$user = auth()->user() /**/ ?>

@if($user)
    <!-- menu profile quick info -->
    <div class="profile clearfix">
        <div class="profile_pic">
            <img src="/images/img.jpg" alt="..." class="img-circle profile_img">
        </div>
        <div class="profile_info">
            <span>Добро пожаловать</span>
            <h2>{{$user['name']}} {{$user['surname']}}</h2>
            <i class="glyphicon glyphicon-user"></i>@lang('roles.'.$user->getCurrentRole()->name.'.label')
        </div>
    </div>
@endif