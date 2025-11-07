
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Notifikasi</h2>
            <p class="text-muted">Semua notifikasi terkait pengajuan cuti Anda</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @forelse($notifikasis as $notifikasi)
                <div class="d-flex align-items-start mb-3 pb-3 border-bottom">
                    <div class="flex-shrink-0">
                        <i class="bi bi-bell-fill text-primary" style="font-size: 24px;"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-1">{{ $notifikasi->judul }}</h6>
                        <p class="mb-1 text-muted">{{ $notifikasi->pesan }}</p>
                        <small class="text-muted">
                            <i class="bi bi-clock"></i> {{ $notifikasi->created_at->diffForHumans() }}
                        </small>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <i class="bi bi-bell-slash" style="font-size: 64px; color: #ccc;"></i>
                    <p class="text-muted mt-3">Tidak ada notifikasi</p>
                </div>
            @endforelse

            @if($notifikasis->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $notifikasis->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
