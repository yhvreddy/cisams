<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotspots;
use Illuminate\Http\Resources\Json\JsonResource;

class HotSpotsController extends Controller
{

    protected Hotspots $hotspots;

    public function __construct(
        Hotspots $_hotspots
    ) {
        $this->hotspots = $_hotspots;
    }

    public function getHotSpots(Request $request)
    {
        $hotspots = $this->hotspots->select('SUSPECT_LONG as lng', 'SUSPECT_LAT as lat', 'SUSPECT_CALL_PLACE as address', 'STATE_NAME as title')->get()->map(function ($hotspot) {
            // Convert lng and lat to numbers
            $hotspot->lng = (float) $hotspot->lng;
            $hotspot->lat = (float) $hotspot->lat;
            return $hotspot;
        })->toArray();
        $locationsJson = json_encode($hotspots);
        return view('pages.hotspots.index', compact('locationsJson'));
    }
}
