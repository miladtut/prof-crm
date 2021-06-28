{{-- Content --}}
@if (config('layout.content.extended'))
    @yield('content')
@else
    <div class="d-flex flex-column-fluid">
{{--        {{ Metronic::printClasses('content-container', false) }}--}}
        <div class="container-fluid">
            @include('flash::message')
            @include('layout.partials.errors')
            @yield('content')
        </div>
    </div>
@endif
