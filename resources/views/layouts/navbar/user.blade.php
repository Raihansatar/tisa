<li class="nav-item">
    <a class="nav-link" aria-current="page" href="#">Dashboard</a>
</li>
<li class="nav-item">
    <a class="nav-link {{ Request::is('debt')? 'active' : '' }}" aria-current="page" href="{{ Route('debt.index') }}">Debt</a>
</li>
<li class="nav-item">
    <a class="nav-link {{ Request::is('report')? 'active' : '' }}" aria-current="page" href="#">Report</a>
</li>