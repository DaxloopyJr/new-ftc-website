@extends('layouts.admin')

@section('title', 'Add Office Location')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Add Office Location</h4>
    <a href="{{ route('admin.office-locations.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>
<div class="content-card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.office-locations.store') }}" class="row g-3">
            @csrf
            
                <div class="col-md-6">
                    <label class="form-label">Office Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Address <span class="text-danger">*</span></label>
                    <input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <div class="form-check">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" {{ old('is_active', '1') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label">Location on Map (click the map or search to capture coordinates automatically)</label>
                    <div class="row g-2 mb-2">
                        <div class="col-md-8">
                            <input type="text" id="geo-search" class="form-control form-control-sm" placeholder="Search address, e.g. Ubungo Plaza Dar es Salaam">
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="geo-btn" class="btn btn-sm btn-outline-secondary"><i class="bi bi-search me-1"></i>Find on Map</button>
                        </div>
                    </div>
                    <div id="ol-map" style="height:300px;" class="rounded border mb-2"></div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Latitude</label>
                    <input type="text" name="latitude" id="ol-lat" class="form-control" value="{{ old('latitude') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Longitude</label>
                    <input type="text" name="longitude" id="ol-lng" class="form-control" value="{{ old('longitude') }}">
                </div>

            <div class="col-12">
                <button type="submit" class="btn btn-admin-primary"><i class="bi bi-save me-1"></i>Save Location</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof L === 'undefined') return;
    var latIn = document.getElementById('ol-lat');
    var lngIn = document.getElementById('ol-lng');
    var lat = parseFloat(latIn.value) || -6.7924;
    var lng = parseFloat(lngIn.value) || 39.2083;
    var map = L.map('ol-map').setView([lat, lng], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '&copy; OpenStreetMap contributors' }).addTo(map);
    var marker = L.marker([lat, lng], { draggable: true }).addTo(map);
    function setPos(la, ln) {
        la = parseFloat(la); ln = parseFloat(ln);
        if (isNaN(la) || isNaN(ln)) return;
        marker.setLatLng([la, ln]);
        map.setView([la, ln], Math.max(map.getZoom(), 15));
        latIn.value = la.toFixed(7);
        lngIn.value = ln.toFixed(7);
    }
    map.on('click', function (e) { setPos(e.latlng.lat, e.latlng.lng); });
    marker.on('dragend', function () { var p = marker.getLatLng(); setPos(p.lat, p.lng); });
    var btn = document.getElementById('geo-btn');
    if (btn) {
        btn.addEventListener('click', function () {
            var q = document.getElementById('geo-search').value;
            if (!q) return;
            fetch('https://nominatim.openstreetmap.org/search?format=json&limit=1&q=' + encodeURIComponent(q))
                .then(function (r) { return r.json(); })
                .then(function (d) { if (d && d[0]) { setPos(d[0].lat, d[0].lon); } });
        });
    }
});
</script>
@endsection
