<div class="sidebar-nav navbar-collapse">
    <ul class="nav" id="side-menu">
        <li>
            <a href="{{route('dashboard.index')}}" class="{!! $feature == 'dashboard' ? 'active' : '' !!}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
        </li>
        <li>
            <a href="{{route('user.index')}}" class="{!! $feature == 'user' ? 'active' : '' !!}"><i class="fa fa-users fa-fw"></i> Usuários</a>
        </li>
        <li>
            <a href="{{route('category.index')}}" class="{!! $feature == 'category' ? 'active' : '' !!}"><i class="fa fa-list fa-fw"></i> Categorias</a>
        </li>
        <li>
            <a href="{{route('project.index')}}" class="{!! $feature == 'project' ? 'active' : '' !!}"><i class="fa fa-clipboard fa-fw"></i> Projetos</a>
        </li>
    </ul>
</div>