<div class="sidebar">
    <div class="menu-txt">
        <a href="{{ route('home') }}">
            <div class="icon-container">
                <img src="{{ asset('assets/images/home.svg') }}" class="icond">Home
            </div>
        </a>
        <a href="#">
            <div class="icon-container">
                <img src="{{ asset('assets/images/search1.svg') }}" class="icond">Search
            </div>
        </a>
        <a href="#">
            <div class="icon-container">
                <img src="{{ asset('assets/images/hotspot.svg') }}" class="icond">Hotspots
            </div>
        </a>
        <a href="#">
            <div class="icon-container">
                <img src="{{ asset('assets/images/habitual.svg') }}" class="icond">Habitual Offenders
            </div>
        </a>
        <a href="#">
            <div class="icon-container">
                <img src="{{ asset('assets/images/data-entry.svg') }}" class="icond">Data Entry
            </div>
        </a>
        <a href="#">
            <div class="icon-container">
                <img src="{{ asset('assets/images/pendind.svg') }}" class="icond">Pending Request
            </div>
        </a>
        <a href="#">
            <div class="icon-container">
                <img src="{{ asset('assets/images/aware.svg') }}" class="icond">Awareness Campaign
            </div>
        </a>
        <a href="#">
            <div class="icon-container">
                <img src="{{ asset('assets/images/invest.svg') }}" class="icond">Investigation Guide
            </div>
        </a>
        @include('components.copyright')
    </div>
</div>
