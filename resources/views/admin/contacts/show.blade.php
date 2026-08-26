@extends('layouts.admin')

@section('title', 'View Contact')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">View Contact</h4>
    <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>
<div class="content-card">
    <div class="card-body">
        <div class="row g-4">
            <div class="col-md-6">
                <p class="mb-1"><strong>Name:</strong></p>
                <p class="text-muted">{{ $contact->name }}</p>
            </div>
            <div class="col-md-6">
                <p class="mb-1"><strong>Email:</strong></p>
                <p class="text-muted">{{ $contact->email }}</p>
            </div>
            <div class="col-md-6">
                <p class="mb-1"><strong>Phone:</strong></p>
                <p class="text-muted">{{ $contact->phone ?? '-' }}</p>
            </div>
            <div class="col-md-6">
                <p class="mb-1"><strong>Subject:</strong></p>
                <p class="text-muted">{{ $contact->subject }}</p>
            </div>
            <div class="col-md-6">
                <p class="mb-1"><strong>Date:</strong></p>
                <p class="text-muted">{{ $contact->created_at->format('F j, Y g:i A') }}</p>
            </div>
            <div class="col-md-6">
                <p class="mb-1"><strong>Status:</strong></p>
                <span class="badge {{ $contact->is_read ? 'bg-secondary' : 'bg-success' }}">{{ $contact->is_read ? 'Read' : 'New' }}</span>
            </div>
            <div class="col-12">
                <p class="mb-1"><strong>Message:</strong></p>
                <div class="p-3 bg-light rounded">{{ $contact->message }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
