<div class="sidebar">
    <div class="menu-txt">
        <a href="{{ route('home') }}">
            <div class="icon-container">
                <img src="{{ url('assets/images/home.svg') }}" class="icond">Home
            </div>
        </a>
        <a href="#">
            <div class="icon-container">
                <img src="{{ url('assets/images/search1.svg') }}" class="icond">Search
            </div>
        </a>
        <a href="{{ route('hotspots.index') }}">
            <div class="icon-container">
                <img src="{{ url('assets/images/hotspot.svg') }}" class="icond">Hotspots
            </div>
        </a>
        <a href="#">
            <div class="icon-container">
                <img src="{{ url('assets/images/habitual.svg') }}" class="icond">Habitual Offenders
            </div>
        </a>
        <a href="#">
            <div class="icon-container">
                <img src="{{ url('assets/images/data-entry.svg') }}" class="icond">Data Entry
            </div>
        </a>
        <a href="#">
            <div class="icon-container">
                <img src="{{ url('assets/images/pendind.svg') }}" class="icond">Pending Request
            </div>
        </a>
        <a href="#">
            <div class="icon-container">
                <img src="{{ url('assets/images/aware.svg') }}" class="icond">Awareness Campaign
            </div>
        </a>
        <a href="#">
            <div class="icon-container">
                <img src="{{ url('assets/images/invest.svg') }}" class="icond">Investigation Guide
            </div>
        </a>

        @role(\App\Enums\Roles::SUPERADMIN->value)
            <a href="{{ route('user-management.index') }}">
                <div class="icon-container">
                    <img src="{{ url('assets/images/invest.svg') }}" class="icond">
                    User Management
                </div>
            </a>

            {{-- <a href="{{ route('roles.index') }}">
                <div class="icon-container">
                    <img src="{{ url('assets/images/invest.svg') }}" class="icond">
                    Roles & Permissions
                </div>
            </a> --}}
        @endrole

        @include('components.copyright')
    </div>
</div>
