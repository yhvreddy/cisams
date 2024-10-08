@extends('layouts.app')

@section('title', 'Hotsports')

@section('styles')
    <style>
        .custom-info-window {
            width: 280px;
            /* Set the width of the InfoWindow */
            height: auto;
            /* Height can adjust based on content, or set a specific height if needed */
            overflow-y: auto;
            /* Add scrollbar if content overflows */
            font-size: 14px;
        }

        .custom-info-window h4 {
            margin: 0;
            font-size: 16px;
        }

        .custom-info-window p {
            margin: 5px 0 0;
            font-size: 12px;
        }
    </style>
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
                    title: location.title,
                    icon: {
                        url: 'https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi.png', // Default Google Maps marker URL
                        scaledSize: new google.maps.Size(20, 25) // Adjust the size (width, height)
                    }
                });

                const infoWindow = new google.maps.InfoWindow({
                    content: `
                        <div class="custom-info-window">
                            <h4>${location.title}</h4>
                            <p>${location.address}</p>
                        </div>
                        `
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
