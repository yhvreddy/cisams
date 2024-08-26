<div class="mobile_nav_items" id="mobile-nav">
    <a href="{{ route('home') }}">
        <img src="{{ asset('assets/images/home.svg') }}" class="icond">Home</a>
    <a href="#"><img src="{{ asset('assets/images/search1.svg') }}" class="icond">Search</a>
    <a href="#"><img src="{{ asset('assets/images/hotspot.svg') }}" class="icond">Hotspots</a>
    <a href="#"><img src="{{ asset('assets/images/habitual.svg') }}" class="icond">Habitual Offenders</a>
    <a href="#"><img src="{{ asset('assets/images/data-entry.svg') }}" class="icond">Data Entry</a>
    <a href="#"> <img src="{{ asset('assets/images/pendind.svg') }}" class="icond">Pending Request</a>
    <a href="#"><img src="{{ asset('assets/images/aware.svg') }}" class="icond">Awareness Campaign</a>
    <a href="#"><img src="{{ asset('assets/images/invest.svg') }}" class="icond">Investigation Guide</a>
    @include('components.copyright')
</div>
