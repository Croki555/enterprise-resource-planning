<header class="header bg-white">
    <div class="container-fluid header__container">
        <nav class="navbar bg-white p-0">
            <ul class="nav gap-4">
                <li class="nav-item">
                    <a href="{{ route('home') }}"
                       class="nav-link active px-0 py-3 text-uppercase">Продукты
                    </a>
                </li>
            </ul>
            <div>
                <h3 class="user-name m-0">{{ config('products.name') }}</h3>
            </div>
        </nav>
    </div>
</header>
