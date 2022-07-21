@extends('Home.index_layout.layout')
@section('content')
    @if($account_info->theme_id == 1)

        @include('Home.Themes.Free.refund')

    @endif

    @if($account_info->theme_id == 'TH1P')

        @include('Home.Themes.TH1P.refund')

    @endif


@endsection
