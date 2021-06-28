{{-- Header --}}
@if(auth('admin')->check())
    @php($notifications = auth('admin')->user()->notifications()->orderByDesc('id')->get())
@elseif(auth()->check())
    @php($notifications = auth()->user()->notifications()->orderByDesc('id')->get())
@endif
@if (config('layout.extras.notifications.dropdown.style') == 'light')
    <div class="d-flex flex-column pt-12 bg-dark-o-5 rounded-top">
        {{-- Title --}}
        <h4 class="d-flex flex-center">
            <span class="text-dark">User Notifications</span>
            <span class="btn btn-text btn-success btn-sm font-weight-bold btn-font-md ml-2">{{count($notifications)}} new</span>
        </h4>

        {{-- Tabs --}}
        <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-primary mt-3 px-8" role="tablist">
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_notifications" >Alerts</a>--}}
{{--            </li>--}}
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#topbar_notifications_events"  >Events</a>
            </li>
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" data-toggle="tab" href="#topbar_notifications_logs"  >Logs</a>--}}
{{--            </li>--}}
        </ul>
    </div>
@else
    <div class="d-flex flex-column pt-12 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url('{{ asset('media/misc/bg-1.jpg') }}')">
        {{-- Title --}}
        <h4 class="d-flex flex-center rounded-top">
            <span class="text-white">User Notifications</span>
            <span class="btn btn-text btn-success btn-sm font-weight-bold btn-font-md ml-2">{{count($notifications)}} new</span>
        </h4>

        {{-- Tabs --}}
        <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-line-transparent-white nav-tabs-line-active-border-success mt-3 px-8" role="tablist">
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_notifications"  >Alerts</a>--}}
{{--            </li>--}}
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#topbar_notifications_events" >Events</a>
            </li>
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" data-toggle="tab" href="#topbar_notifications_logs"  >Logs</a>--}}
{{--            </li>--}}
        </ul>
    </div>
@endif

{{-- Content --}}
<div class="tab-content">
    {{-- Tabpane --}}
    <div class="tab-pane " id="topbar_notifications_notifications" role="tabpanel">
        {{-- Scroll --}}
        <div class="scroll pr-7 mr-n7" data-scroll="true" data-height="300" data-mobile-height="200">
            {{-- Item --}}
            <div class="d-flex align-items-center mb-6">
                {{-- Symbol --}}
                <div class="symbol symbol-40 symbol-light-primary mr-5">
                    <span class="symbol-label">
                        {{ Metronic::getSVG("media/svg/icons/Home/Library.svg", "svg-icon-lg svg-icon-primary") }}
                    </span>
                </div>

                {{-- Text --}}
                <div class="d-flex flex-column font-weight-bold">
                    <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Briviba SaaS</a>
                    <span class="text-muted">PHP, SQLite, Artisan CLIмм</span>
                </div>
            </div>

            {{-- Item --}}
            <div class="d-flex align-items-center mb-6">
                {{-- Symbol --}}
                <div class="symbol symbol-40 symbol-light-warning mr-5">
                    <span class="symbol-label">
                        {{ Metronic::getSVG("media/svg/icons/Communication/Write.svg", "svg-icon-lg svg-icon-warning") }}
                    </span>
                </div>

                {{-- Text --}}
                <div class="d-flex flex-column font-weight-bold">
                    <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg">Briviba SaaS</a>
                    <span class="text-muted">PHP, SQLite, Artisan CLIмм</span>
                </div>
            </div>

            {{-- Item --}}
            <div class="d-flex align-items-center mb-6">
                {{-- Symbol --}}
                <div class="symbol symbol-40 symbol-light-success mr-5">
                    <span class="symbol-label">
                        {{ Metronic::getSVG("media/svg/icons/Communication/Group-chat.svg", "svg-icon-lg svg-icon-success") }}
                    </span>
                </div>

                {{-- Text --}}
                <div class="d-flex flex-column font-weight-bold">
                    <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Briviba SaaS</a>
                    <span class="text-muted">PHP, SQLite, Artisan CLIмм</span>
                </div>
            </div>

            {{-- Item --}}
            <div class="d-flex align-items-center mb-6">
                {{-- Symbol --}}
                <div class="symbol symbol-40 symbol-light-danger mr-5">
                    <span class="symbol-label">
                        {{ Metronic::getSVG("media/svg/icons/General/Attachment2.svg", "svg-icon-lg svg-icon-danger") }}
                    </span>
                </div>

                {{-- Text --}}
                <div class="d-flex flex-column font-weight-bold">
                    <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Briviba SaaS</a>
                    <span class="text-muted">PHP, SQLite, Artisan CLIмм</span>
                </div>
            </div>

            {{-- Item --}}
            <div class="d-flex align-items-center mb-2">
                {{-- Symbol --}}
                <div class="symbol symbol-40 symbol-light-info mr-5">
                    <span class="symbol-label">
                        {{ Metronic::getSVG("media/svg/icons/Communication/Shield-user.svg", "svg-icon-lg  svg-icon-info") }}
                    </span>
                </div>

                {{-- Text --}}
                <div class="d-flex flex-column font-weight-bold">
                    <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Briviba SaaS</a>
                    <span class="text-muted">PHP, SQLite, Artisan CLIмм</span>
                </div>
            </div>

            {{-- Item --}}
            <div class="d-flex align-items-center mb-2">
                {{-- Symbol --}}
                <div class="symbol symbol-40 symbol-light-info mr-5">
                    <span class="symbol-label">
                        {{ Metronic::getSVG("media/svg/icons/Communication/Mail-notification.svg", "svg-icon-lg  svg-icon-info") }}
                    </span>
                </div>

                {{-- Text --}}
                <div class="d-flex flex-column font-weight-bold">
                    <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Briviba SaaS</a>
                    <span class="text-muted">PHP, SQLite, Artisan CLIмм</span>
                </div>
            </div>

            {{-- Item --}}
            <div class="d-flex align-items-center mb-2">
                {{-- Symbol --}}
                <div class="symbol symbol-40 symbol-light-info mr-5">
                    <span class="symbol-label">
                        {{ Metronic::getSVG("media/svg/icons/Design/Bucket.svg", "svg-icon-lg  svg-icon-info") }}
                    </span>
                </div>

                {{-- Text --}}
                <div class="d-flex flex-column font-weight-bold">
                    <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Briviba SaaS</a>
                    <span class="text-muted">PHP, SQLite, Artisan CLIмм</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabpane --}}
    <div class="tab-pane active show p-8" id="topbar_notifications_events" role="tabpanel">
        {{-- Nav --}}
        <div class="navi navi-hover scroll my-4" data-scroll="true" data-height="300" data-mobile-height="200">
            @foreach($notifications as $notification)
                {{-- Item --}}
                <a href="{{$notification->notification_url}}" class="navi-item note" data-id="{{\Illuminate\Support\Facades\Crypt::encryptString($notification->id)}}">
                    <div class="navi-link">
                        <div class="navi-icon mr-2">
                            <i class="flaticon2-paper-plane text-danger"></i>
                        </div>
                        <div class="navi-text">
                            <div class="font-weight-bold">
                                {{$notification->title}}
                            </div>
                            <div class="text-muted">
                                {{$notification->created_at->diffForHumans()}}
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    {{-- Tabpane --}}
    <div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
        {{-- Nav --}}
        <div class="d-flex flex-center text-center text-muted min-h-200px">
            All caught up!
            <br/>
            No new notifications.
        </div>
    </div>
</div>
