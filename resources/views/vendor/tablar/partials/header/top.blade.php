<header class="navbar navbar-expand-md navbar-light d-print-none {{ auth()->user()->hasRole('SuperAdmin') ? 'bg-primary text-white' : ''}}">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand  pe-0 pe-md-3 ">
            @include('tablar::partials.common.logo')
        </h1>
        <h2 class="m-auto d-none-navbar-horizontal pe-0 pe-md-3 ">
            {{ config('app.name')}}
        </h2>
        <div class="navbar-nav flex-row order-md-last">

            <div class="nav-item d-none d-md-flex me-3">
                <div class="btn-list">
                    {{-- @include('tablar::partials.header.header-button') --}}
                </div>
            </div>

            <div class="d-none d-md-flex">

                @include('tablar::partials.header.theme-mode')

                @include('tablar::partials.header.notifications')

            </div>
            @include('tablar::partials.header.top-right')
        </div>
    </div>
</header>
