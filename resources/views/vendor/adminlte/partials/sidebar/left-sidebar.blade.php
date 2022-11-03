<aside
    class="main-sidebar bg-sidebar-primary {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">


    {{-- Sidebar brand logo --}}
    @if (config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar" style="margin-top: 110px">

        <nav class="">
            @if (Auth::user()->superuser)
                <ul style="margin:0;padding:0 12px 0 12px" >
                    {{-- <li style="margin:0;padding:0;line-height:1">
                        <p class="text- p-0 m-0" style="font-size:11px;color:rgb(204, 202, 202)"> Sistema: </p>
                    </li> --}}
                    <li style="margin:0;padding:0;line-height:1">
                        <h6 class="text- p-0 m-0" style="font-size:14px;color:rgb(204, 202, 202)"> <i class="fas fa-cogs"></i> {{ Auth::user()->sistema }} </h6>
                    </li>
                </ul>
                
            @endif

            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if (config('adminlte.sidebar_nav_animation_speed') != 300) data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}" @endif
                @if (!config('adminlte.sidebar_nav_accordion')) data-accordion="false" @endif>
                {{-- Configured sidebar links --}}
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')
            </ul>
        </nav>
    </div>

</aside>
