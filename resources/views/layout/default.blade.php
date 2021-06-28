{{--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 8
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
 --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{ Metronic::printAttrs('html') }} {{ Metronic::printClasses('html') }}>
    <head>
        <meta charset="utf-8"/>

        {{-- Title Section --}}
        <title>{{ config('app.name') }}  @yield('title', $page_title ?? 'investments')</title>

        {{-- Meta Data --}}
        <meta name="description" content="@yield('page_description', $page_description ?? 'Pharmaceutical and logistics industries professionals')"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

        {{-- Favicon --}}
        <link rel="shortcut icon" href="{{ asset('media/logos/favicon.png') }}" />

        {{-- Fonts --}}
        {{ Metronic::getGoogleFontsInclude() }}

        {{-- Global Theme Styles (used by all pages) --}}
        @foreach(config('layout.resources.css') as $style)
            <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($style)) : asset($style) }}" rel="stylesheet" type="text/css"/>
        @endforeach

        {{-- Layout Themes (used by all pages) --}}
        @foreach (Metronic::initThemes() as $theme)
            <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($theme)) : asset($theme) }}" rel="stylesheet" type="text/css"/>
        @endforeach

        {{-- Includable CSS --}}
        @yield('styles')
        <style>
            h3{
                font-size: 15px!important;
            }
            h4{
                font-size: 12px!important;
            }
            a:not(.btn){
                color: #547dbf!important;
            }
            .btn-primary{
                background-color: #547dbf!important;
            }
        </style>

    </head>

    <body {{ Metronic::printAttrs('body') }} {{ Metronic::printClasses('body') }}>

        @if (config('layout.page-loader.type') != '')
            @include('layout.partials._page-loader')
        @endif



        @include('layout.base._layout')


        <script>var HOST_URL = "{{ route('quick-search') }}";</script>

        {{-- Global Config (global config for global JS scripts) --}}
        <script>
            {{--var KTAppSettings = {!! json_encode(config('layout.js'), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) !!};--}}
            var KTAppSettings = null;
        </script>

        {{-- Global Theme JS Bundle (used by all pages)  --}}
        @foreach(config('layout.resources.js') as $script)
            <script src="{{ asset($script) }}" type="text/javascript"></script>
        @endforeach

        {{-- Includable Modals --}}
        @include('layout.partials.extras.modals.delete')
        @include('layout.partials.extras.modals.logout')
        @include('layout.partials.extras.modals.sample')
        @includeIf('layout.partials.extras.modals.logistic_inq')
        {{-- Includable JS --}}
        @yield('scripts')
        <script src="{{asset('js/modals.js')}}?v=1.0"></script>




        <script>
            $('#material').change(function () {
                var selected = $(this).find('option:selected');
                var sup = selected.data('supplier');
                $('#supplier').val(sup)
            })
        </script>
        <script>
            $('#other').change(function () {
                if (this.checked){
                    $('#ext_doc').show();
                }else{
                    $('#ext_doc').hide();
                }
            })

            $(document).on('click','#med',function (e) {
                var url = $('#med').data("href");
                var Data = $('#ext_doc_name').val();
                $('#success').hide()
                $('#error').hide()
                $('#waiting').show()
                $.get(url, {name:Data}).done(function (data) {
                    if(data.status == 'success'){
                        $('.con').html('<input type="hidden" id="ext" name="document[]">')
                        $('#ext_doc_name').val(data.name)
                        $('#ext').val(data.id)
                        $('#ext_doc_name').prop('disabled',true)
                        $('#med').hide()
                        $('#waiting').hide()
                        $('#other_container').hide()
                        $('#success').show()
                    }else{
                        $('#waiting').hide()
                        $('#error').show()
                    }
                });
            })

        </script>
        <script>
            $('#material').change(function () {
                if (this.value == '0'){
                    $('#o_mat').html('<label class="col-lg-3 col-form-label"></label>\n' +
                        '                            <div class="col-lg-3">\n' +
                        '                                <input type="text" id="mat_name" name="mat_name" class="form-control bg-dark text-white" placeholder="enter material name" required>\n' +
                        '                            </div>\n')
                    $("#o_mat").show()
                }else{
                    $('#o_mat').html('')
                }
            })
        </script>
        <script>
            $('#switch').change(function () {
                var url = $(this).data('href')
                $.get(url).done(function (data) {
                    alert(data.message)
                })
            })


        </script>

        @if(auth()->check())
            <!--Start of Tawk.to Script-->
            <script type="text/javascript">
                var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
                (function(){
                    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                    s1.async=true;
                    s1.src='https://embed.tawk.to/6083215d62662a09efc18de0/1f403klaf';
                    s1.charset='UTF-8';
                    s1.setAttribute('crossorigin','*');
                    s0.parentNode.insertBefore(s1,s0);
                })();
            </script>
            <!--End of Tawk.to Script-->
        @endif

    <script>
        $('.qautation').click(function (e) {
            e.preventDefault()
            $('#sampleModal').find('#link1').attr('href',$(this).data('href'))
            $('#sampleModal').find('#link2').attr('href',$(this).data('link'))
            $('#sampleModal').modal('show')
        })
    </script>

    <script>
        $(document).on('click','.reject-sample',function (e) {
            e.preventDefault();
            var url = $(this).data('href');
            $('#rejectSampleForm').attr('action',url);
            $('#rejectSampleModal').modal('show');
        });
    </script>
    </body>
</html>

