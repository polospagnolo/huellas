@auth
    <div class="nav-scroller bg-white box-shadow">
        <nav class="nav nav-underline">
            <a class="nav-link {{isActiveRoute('mensual')}}" href="{{route('mensual')}}">Mensual</a>
            <a class="nav-link {{isActiveRoute('home')}}" href="{{route('home')}}">Máquina</a>
            <a class="nav-link {{areActiveRoutes(['manual.index','manual.create','manual.edit'])}}" href="{{route('manual.index')}}">Manual</a>
        </nav>
    </div>
    <br>
@endauth

