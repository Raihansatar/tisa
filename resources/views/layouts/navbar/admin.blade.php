<li class="menu-item">
    <a class="menu-link" aria-current="page" href="#">Dashboard</a>
</li>
<li class="menu-item">
    <a class="menu-link {{ Request::is('sales')? 'active' : '' }}" aria-current="page" href="{{ Route('sales.index') }}"> <span class="menu-text">Sales</span></a>
</li>
<li class="menu-item">
    <a class="menu-link {{ Request::is('product')? 'active' : '' }}" aria-current="page" href="{{ Route('product.index') }}"><span class="menu-text">Product</span></a>
</li>
<li class="menu-item">
    <a class="menu-link {{ Request::is('shop')? 'active' : '' }}" aria-current="page" href="#"><span class="menu-text">Shop</span></a>
</li>
<li class="menu-item">
    <a class="menu-link {{ Request::is('debt')? 'active' : '' }}" aria-current="page" href="{{ Route('debt.index') }}"><span class="menu-text">Debt</span></a>
</li>
<li class="menu-item">
    <a class="menu-link {{ Request::is('report')? 'active' : '' }}" aria-current="page" href="#"><span class="menu-text">Report</span></a>
</li>