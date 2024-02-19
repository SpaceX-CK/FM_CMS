<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-2">
    <!-- Brand Logo -->
    <a href="{{ route('index') }}" class="brand-link bg-primary">
        <!-- <img src="#" alt="logo" class="brand-text" style="max-width: 24%; margin: 0 auto; display: block;"> -->
        <div class="brand-text text-center">
        <span class="brand-text font-weight-light">FOLLOW ME</span>
        </div>
        
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info mx-auto">
                <a href="#" class="d-block ">SuperAdmin</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('home.index')}}" class="nav-link {{ ( (request()->is('admin/home')) || (request()->is('admin')) ) ? 'active' : '' }}">
                        <i class="fa-solid fa-house nav-icon mr-2"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('products.index')}}" class="nav-link {{ (request()->is('admin/products')) ? 'active' : '' }}">
                        <i class="fas fa-pump-soap nav-icon mr-2"></i>
                        <p>Product</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('categories.index')}}" class="nav-link {{ (request()->is('admin/categories')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-layer-group mr-2"></i>
                        <p>Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('article.index')}}" class="nav-link {{ (request()->is('admin/article')) ? 'active' : '' }}">
                        <i class="far fa-newspaper nav-icon mr-2"></i>
                        <p>Article</p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="{{route('user.index')}}" class="nav-link ">
                        <i class="far fa-user nav-icon mr-2"></i>
                        <p>Profile</p>
                    </a>
                </li> -->
                <li class="nav-item text-left">
                    <a href="{{route('shops.index')}}" class="nav-link {{ (request()->is('admin/shops')) ? 'active' : '' }}">
                        <i class="fa-brands fa-shopify nav-icon mr-2"></i>
                        <p>Shop</p>
                    </a>
                </li>
                <li class="nav-item text-left">
                    <a href="{{route('settings.index')}}" class="nav-link {{ (request()->is('admin/settings')) ? 'active' : '' }}">
                        <i class="fa-solid fa-wrench nav-icon mr-2"></i>
                        <p>Setting</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>