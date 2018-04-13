<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>Меню</h3>
        <ul class="nav side-menu">
            <li>
                <a href="/">
                    <i class="fa fa-home"></i>Главная</a>
            </li>
            <hr/>
            <li><a href="{{action('ProfileController@edit', $user['id'])}}">
                    <i class="fa fa-user"></i> Личные данные
                </a>
            </li>
            <hr/>
            <li>
                <a href="/orders">
                    <i class="fa fa-edit"></i>Назначить чек листы оптимизатору</a>
            </li>
            <hr/>
            <li>
                <a href="/admin/statistics">
                    <i class="fa fa-pie-chart"></i>Статистика</a>
            </li>
        </ul>
    </div>
</div>

