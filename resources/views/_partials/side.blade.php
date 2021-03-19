<!-- side menu items -->
<ul id="accordion-menu">
    <li class="dropdown">
        <a href="{{ route('home')}}" class="dropdown-toggle no-arrow {{ (request()->is('home')) ? 'active' : '' }}">
            <span class="micon icon-copy ti-dashboard"></span><span class="mtext">Dashboard</span>
        </a>
    </li>

    <li class="dropdown">
        <a href="{{ route('products')}}" class="dropdown-toggle no-arrow {{ (request()->is('products')) ? 'active' : '' }}">
            <span class="micon icon-copy fi-thumbnails"></span><span class="mtext">Products</span>
        </a>
    </li>

    <li class="dropdown">
        <a href="" class="dropdown-toggle no-arrow {{ (request()->is('suppliers*')) ? 'active' : '' }}">
            <span class="micon fa fa-users"></span><span class="mtext">Suppliers</span>
        </a>
    </li>
    <li class="dropdown">
        <a href="" class="dropdown-toggle no-arrow {{ (request()->is('orders*')) ? 'active' : '' }}">
            <span class="micon icon-copy ti-shopping-cart-full"></span><span class="mtext">Orders</span>
        </a>
    </li>

    <li class="dropdown">
        <a href="" class="dropdown-toggle no-arrow" onclick="event.preventDefault();
							document.getElementById('logout-form').submit();">
            <span class="micon icon-copy dw dw-logout"></span><span class="mtext">Logout  </span>
        </a>
        <form id="logout-form" action="{{ route($logout) }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
</ul>