@extends('admin.dashboard')

@section('content')
    <div class="container-fluid py-4">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h2 class="m-0 fw-semibold">Visão Geral</h2>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="ratio ratio-16x9" style="min-height: 70vh;">
                    <iframe
                        src="http://127.0.0.1:8501/?embed=true&theme=dark"
                        title="Apoia+ Dashboard"
                        style="border:0; width: 100%; height: 100%; border-radius: .5rem;"
                        allow="fullscreen"
                        loading="lazy"
                    ></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection


