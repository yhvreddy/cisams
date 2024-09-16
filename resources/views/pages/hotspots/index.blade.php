@extends('layouts.app')

@section('title', 'Hotsports')

@section('styles')
@endsection


@section('content')
    @include('pages.fir-conversions.components.header-title', [
        'titleOne' => 'Hotspots',
    ])

    <div>
        <div id="map"></div>
    </div>

    {{-- @php(dd($locationsJson)) --}}
@endsection

@section('scripts')
    <script>
        function initMap() {
            // Create a map centered in India
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 5,
                center: {
                    lat: 20.5937,
                    lng: 78.9629
                } // Center of India
            });

            // Array of locations in various Indian states with titles and addresses
            const locations = {!! $locationsJson !!};

            // Loop through the locations and create markers with info windows
            locations.forEach(location => {
                const marker = new google.maps.Marker({
                    position: {
                        lat: location.lat,
                        lng: location.lng
                    },
                    map: map,
                    title: location.title
                });

                const infoWindow = new google.maps.InfoWindow({
                    content: `<h4>${location.title}</h4><p>${location.address}</p>`
                });

                // Add a click event listener to each marker to open the info window
                marker.addListener("click", () => {
                    infoWindow.open(map, marker);
                });
            });
        }
    </script>

    <!-- Replace YOUR_API_KEY with your actual API key -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCF46BL8RTxp77pZ3r3MtvEd0NuTuRmXW8&callback=initMap" async
        defer></script>
@endsection
