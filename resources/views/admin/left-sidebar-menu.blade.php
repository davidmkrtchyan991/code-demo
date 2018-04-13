<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>Меню</h3>
        <ul class="nav side-menu">
            <li>
                <a href="/">
                    <i class="fa fa-home"></i>Главная</a>
            </li>
            <hr/>
            <li>
                <a href="/orders/create">
                    <i class="fa fa-edit"></i>Регистрация заказа</a>
            </li>
            <li>
                <a href="/orders">
                    <i class="fa fa-edit"></i>Список заказов</a>
            </li>
            <hr/>
            <li>
                <a href="/admin/users/clients">
                    <i class="fa fa-address-book"></i>Список клиентов</a>
            </li>
            <hr/>
            <li>
                <a href="/admin/users/create">
                    <i class="fa fa-user"></i>Создать пользователя</a>
            </li>
            <li>
                <a href="/admin/users">
                    <i class="fa fa-user"></i>Список пользователей</a>
            </li>
            <hr/>

            <li>
                <a href="/admin/checklists/create">
                    <i class="fa fa-edit"></i>Создать чеклист</a>
            </li>
            <li>
                <a href="/admin/checklists"><i class="fa fa-list"></i>Редактировать чеклисты</a>
            </li>
            <hr/>
            {{--<li>--}}
            {{--<a href="#">История платежей</a>--}}
            {{--</li>--}}

            <li>
                <a href="/admin/maintenance/create"><i class="fa fa-edit"></i>@lang("maintenance.add.label")</a>
            </li>

            <li>
                <a href="/admin/maintenance/createKeywords"><i class="fa fa-edit"></i>@lang("maintenance.add.keywords.label")</a>
            </li>

            <li>
                <a href="/admin/maintenance"><i class="fa fa-list"></i>@lang("maintenance.list.label")</a>
            </li>

            <hr/>

            <li>
                <a href="/admin/tariff/create"><i class="fa fa-edit"></i>@lang("tariff.add.label")</a>
            </li>
            <li>
                <a href="/admin/tariff"><i class="fa fa-list"></i>@lang("tariff.list.label")</a>
            </li>
            <hr/>

            <li>
                <a href="/admin/statistics">
                    <i class="fa fa-pie-chart"></i>Статистика</a>
            </li>
        </ul>
    </div>
</div>