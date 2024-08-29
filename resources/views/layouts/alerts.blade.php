@if (session('error'))
    <div class="alert alert-warning p-2 custom_alert alert-dismissible" role="alert">
        {{-- <a href="javascript:0;" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> --}}
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success p-2 custom_alert alert-dismissible" role="alert">
        {{-- <a href="javascript:0;" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> --}}
        {{ session('success') }}
    </div>
@endif

@if (session('danger'))
    <div class="alert alert-danger p-2 custom_alert alert-dismissible" role="alert">
        {{-- <a href="javascript:0;" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> --}}
        {{ session('danger') }}
    </div>
@endif

@if (session('failed'))
    <div class="alert alert-danger p-2 custom_alert alert-dismissible" role="alert">
        {{-- <a href="javascript:0;" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> --}}
        {{ session('failed') }}
    </div>
@endif

@if (session('info'))
    <div class="alert alert-info p-2 custom_alert alert-dismissible" role="alert">
        {{-- <a href="javascript:0;" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> --}}
        {{ session('info') }}
    </div>
@endif
