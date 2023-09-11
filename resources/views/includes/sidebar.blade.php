<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
        <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            @if(Auth::user()->user_role == 1)
                <div class="image">
                    <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                </div>
            @endif
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('articles') }}" class="nav-link <?php if(Request::is('admin/articles*')) echo ' active'; ?>">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>Articles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tags') }}" class="nav-link <?php if(Request::is('admin/tags*')) echo ' active'; ?>">
                        <i class=" nav-icon fa fa-tag"></i>
                        <p>Tags</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories') }}" class="nav-link <?php if(Request::is('admin/categories*')) echo ' active'; ?>">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>Categories</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>