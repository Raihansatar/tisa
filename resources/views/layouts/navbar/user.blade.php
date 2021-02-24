<li class="menu-item">
    <a class="menu-link" aria-current="page" href="#">Dashboard</a>
</li>
<li class="menu-item">
    <a class="menu-link {{ Request::is('debt')? 'menu-link-active' : '' }}" aria-current="page" href="{{ Route('debt.index') }}">Debt</a>
</li>
<li class="menu-item">
    <a class="menu-link {{ Request::is('report')? 'active' : '' }}" aria-current="page" href="#">Report</a>
</li>