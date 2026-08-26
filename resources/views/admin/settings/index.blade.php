@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Site Settings</h4>
</div>

<form method="POST" action="{{ route('admin.settings.update') }}">
    @csrf @method('PUT')
    
    @foreach($settings as $group => $groupSettings)
        <div class="content-card mb-4">
            <div class="card-header">
                <span><i class="bi bi-gear me-2"></i>{{ ucfirst($group) }} Settings</span>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @foreach($groupSettings as $setting)
                        <div class="col-md-6">
                            <label class="form-label">{{ $setting->label }}</label>
                            @if($setting->type == 'textarea')
                                <textarea name="settings[{{ $setting->key }}]" class="form-control" rows="3">{{ old('settings.' . $setting->key, $setting->value) }}</textarea>
                            @else
                                <input type="text" name="settings[{{ $setting->key }}]" class="form-control" value="{{ old('settings.' . $setting->key, $setting->value) }}">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
    
    <div class="text-end">
        <button type="submit" class="btn btn-admin-primary px-4">Save Settings</button>
    </div>
</form>
@endsection
