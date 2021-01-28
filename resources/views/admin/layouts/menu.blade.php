<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard-developer') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
    </a>


    <hr class="sidebar-divider my-0">
    <div class="sidebar-heading">Для заполнения</div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('article.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Статьи</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('tags.index') }}" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Теги</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="buttons.html">Buttons</a>
                <a class="collapse-item" href="cards.html">Cards</a>
            </div>
        </div>
    </li>



    <li class="nav-item">
        <a class="nav-link" href="{{ route('comments.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Комментарии</span>
        </a>
    </li>

    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('roles.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Роли</span>
        </a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Пользователи</span>
        </a>
    </li>

    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('logs') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Логи</span>
        </a>
    </li>
</ul>
