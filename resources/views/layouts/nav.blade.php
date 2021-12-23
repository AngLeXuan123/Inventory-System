<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">

            @can('Dashboard-list')
            <a class="nav-link" href="{{ url('/home') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            @endcan

            @can('Brand-list')
            <a class="nav-link" href="{{route('brand.index')}}">
                <div class="sb-nav-link-icon"><i class="fab fa-angellist"></i></div>
                Brands
            </a>
            @endcan

            @can('Category-list')
            <a class="nav-link" href="{{route('category.index')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-align-justify"></i></div>
                Category
            </a>
            @endcan

            <a class="nav-link" href="{{url('/')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                Spare Parts
            </a>

            <a class="nav-link" href="{{route('order.index')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-shipping-fast"></i></div>
                Order
            </a>

            <a class="nav-link" href="{{route('product.cart')}}">
                <div class="sb-nav-link-icon"><i class="fa fa-shopping-cart"></i></div>
                Cart
            </a>
           
        </div>
    </div>
</nav>