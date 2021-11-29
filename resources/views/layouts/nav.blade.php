<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <a class="nav-link" href="{{route('adminHome')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>

            <a class="nav-link" href="{{route('brand.index')}}">
                <div class="sb-nav-link-icon"><i class="fab fa-angellist"></i></div>
                Brands
            </a>

            <a class="nav-link" href="{{route('category.index')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-align-justify"></i></div>
                Category
            </a>

            <a class="nav-link" href="{{route('product.index')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                Spare Parts
            </a>

            <a class="nav-link" href="{{route('order.index')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-shipping-fast"></i></div>
                Order
            </a>

            <a class="nav-link" href="{{route('product.cart')}}">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp&nbsp Cart<span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
            </a>
           
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        Admin
    </div>
</nav>