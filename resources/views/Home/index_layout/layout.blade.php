
@if($account_info->theme_id == 1)

    @include('Home.Themes.Free.head-css')

@endif

@if($account_info->theme_id == 'TH1P')

    @include('Home.Themes.TH1P.head-css')

@endif


@yield('content')


@if($account_info->theme_id == 1)

    @include('Home.Themes.Free.bottom-js')

@endif

@if($account_info->theme_id == 'TH1P')

    @include('Home.Themes.TH1P.bottom-js')

@endif
