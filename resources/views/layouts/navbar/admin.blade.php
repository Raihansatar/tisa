<li class="nav-item">
    <a class="nav-link" aria-current="page" href="#">Dashboard</a>
</li>
<li class="nav-item">
    <a class="nav-link {{ Request::is('sales')? 'active' : '' }}" aria-current="page" href="{{ Route('sales.index') }}">Sales</a>
</li>
<li class="nav-item">
    <a class="nav-link {{ Request::is('product')? 'active' : '' }}" aria-current="page" href="{{ Route('product.index') }}">Product</a>
</li>
<li class="nav-item">
    <a class="nav-link {{ Request::is('shop')? 'active' : '' }}" aria-current="page" href="#">Shop</a>
</li>
<li class="nav-item">
    <a class="nav-link {{ Request::is('debt')? 'active' : '' }}" aria-current="page" href="{{ Route('debt.index') }}">Debt</a>
</li>
<li class="nav-item">
    <a class="nav-link {{ Request::is('report')? 'active' : '' }}" aria-current="page" href="#">Report</a>
</li>