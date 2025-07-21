<div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                  
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ \Request::route()->getName()=='dashboard'? 'active':"" }} " href="{{ route('dashboard') }}" ><i class="fa fa-fw fa-user-circle"></i>Dashboard <span class="badge badge-success">6</span></a>
                               
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ \Request::route()->getName()=='category'? 'active':"" }}" href="{{ route('category') }}"data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-rocket"></i>category</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ \Request::route()->getName()=='sub-category'? 'active':"" }}" href="{{ route('sub-category') }}"data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-rocket"></i>Sub Category</a>
                            </li>
                             <li class="nav-item">
                                <a class="nav-link {{ \Request::route()->getName()=='product'? 'active':"" }}" href="{{ route('product') }}"data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-rocket"></i>Products</a>
                            </li>
                             <li class="nav-item">
                                <a class="nav-link {{ \Request::route()->getName()=='admin.order'? 'active':"" }}" href="{{ route('admin.order') }}"data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-rocket"></i>order</a>
                            </li>
                          
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
