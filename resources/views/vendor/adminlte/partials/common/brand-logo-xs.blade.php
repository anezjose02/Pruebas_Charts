<?php 
use App\Globales;
?>
@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

<a href="{{ $dashboard_url }}"
    @if($layoutHelper->isLayoutTopnavEnabled())
        class="navbar-brand text-center pb-4 {{ config('adminlte.classes_brand') }}"
    @else
        class="brand-link text-center pb-4 {{ config('adminlte.classes_brand') }}"
    @endif>

    {{-- Small brand logo --}}
    {{-- <img src="{{ asset(Globales::global("url_logo")->valor) }}"
         alt="{{ Globales::global("nombre_sistema")->valor }}"
         class="{{ config('adminlte.logo_img_class', 'brand-image img-circle elevation-3') }}"
         style="opacity:.8"> --}}
   <span class="text-center">
    <img style="max-width: 90%;max-height:45px;border-radius:5px" src="{{ asset(Globales::global("url_logo")->valor) }}" alt="">    

    {{-- Brand text --}}
    <h6 style="font-weight: 600" class="mt-1 mb-2 brand-text font-weight-light {{ config('adminlte.classes_brand_text') }}">
        {!! Globales::global("texto_logo")->valor !!}
    </h6>
   </span>

</a>
