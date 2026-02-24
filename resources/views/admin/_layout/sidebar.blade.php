<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('front.index')}}" class="brand-link ml-2">
        <span class="brand-text font-weight-light">BloggyApp Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{auth()->user()->avatar}}" class="img-circle elevation-2 js-avatar-image" alt="" id="avatarImage">
                </div>
            <div class="info">
                <a href="{{route('admin.profile.index')}}" id="user-name" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">EXAMPLES</li>
                <li class="nav-item">
                    <a href="{{route('admin.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Home</p>
                    </a>
                </li>
                {{--Users--}}
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                            Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.indexUsers')}}" class="nav-link">
                                <i class="fas fa-list nav-icon"></i>
                                <p>Users list</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.addUser')}}" class="nav-link">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Add User</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{--Categories--}}
                <li class="nav-item has-treeview">
                    <a href="{{route('admin.category.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="pl-2">Categories</p>
                    </a>
                </li>

                {{--Tags--}}
                <li class="nav-item has-treeview">
                    <a href="{{route('admin.tag.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="pl-2">Tags</p>
                    </a>
                </li>
                {{--Pages--}}
                <li class="nav-item has-treeview">
                    <a href="{{route('admin.post.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="pl-2">Posts</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="{{route('admin.slider.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="pl-2">Sliders</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{route('admin.comment.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="pl-2">Comments</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('logout') }}"
                       class="nav-link"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
