<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>Меню</h3>
        <ul class="nav side-menu">
            <li><a href="/">
                    <i class="fa fa-home"></i> Главная
                </a>
            </li>

            <li><a href="{{action('ProfileController@edit', $user['id'])}}">
                    <i class="fa fa-user"></i> Личные данные
                </a>
            </li>

            <li><a href="/orders">
                    <i class="fa fa-edit"></i> Список заказов
                </a>
            </li>

            <li><a href="/faq">
                    <i class="fa fa-question-circle-o" aria-hidden="true"></i> ЧаВо (FAQ)
                </a>
            </li>
        </ul>
    </div>
</div>