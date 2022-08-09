
    @if(\App\Application::all()->count()>=1)
        @php
        $currency = (\App\Application::all()->first()->currency_symbol ?? '');
        $currency = (auth()->user()->currency_symbol ?? $currency);
        @endphp
        @if(\App\Application::all()->first()->currency_symbol_location  == "right")
        <price> {{$amount}} {{$currency }}</price>
        @else
        <price>{{$currency }} {{number_format($amount)}} </price>
        @endif
    @else
        <price>{{number_format($amount)}}</price>
    @endif


