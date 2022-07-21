@extends('Home.index_layout.layout')
@section('content')
    @if($account_info->theme_id == 1)

        @include('Home.Themes.Free.register')

    @endif


    @if($account_info->theme_id == 'TH1P')

        @include('Home.Themes.TH1P.register')

    @endif
@endsection
