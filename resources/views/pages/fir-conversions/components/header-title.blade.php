<div class="row ">
    <div class="col-md-10">
        @if (isset($title) || isset($titleOne) || isset($titleTwo))
            {{-- <h4 class="fir-head">{{ $title }}</h4> --}}
            <h4 class="fir-head"> {{ isset($titleOne) ? $titleOne : $title }}
                <span class="totl-complain"> {{ !isset($titleTwo) ? '' : ' | ' . $titleTwo }}</span>
            </h4>
        @else
            <h4 class="fir-head">FIR Conversions <span class="totl-complain"> | Total Complaints</span></h4>
        @endif
    </div>

    <div class="col-md-2 ">
        <div class="d-flex justify-content-end pageMenus">
            @if (isset($menus))
                @if (is_array($menus))
                    @foreach ($menus as $menu)
                        <a href="{{ $menu['route'] }}" class="btn-black">{{ $menu['name'] }}</a>
                    @endforeach
                @else
                    {!! $menus !!}
                @endif
            @endif

            {{-- <a href="{{  ??  }}" onclick="history.back()"></a> --}}


            @if (url()->previous() && url()->previous() !== url()->current())
                <a href="{{ $routeLink ?? (url()->previous() ?? route('home')) }}" class="btn-back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" fill="currentColor"
                        class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 1-.5.5H3.707l4.147 4.146a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 1 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z" />
                    </svg> Back
                </a>
            @endif
        </div>
    </div>
</div>
