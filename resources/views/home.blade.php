@extends('layouts.main')

@section('content')
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        background-color: #fff;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }

    .institution-logo {
        object-fit: contain;
        max-height: 140px;
        width: auto;
        margin: 20px auto 0;
    }

    .card-title {
        font-weight: 600;
        font-size: 1.1rem;
        margin-top: 15px;
        color: #2c3e50;
    }

    .btn-modern {
        background-color: #4159A4 !important;
        border: none;
        border-radius: 30px;
        padding: 10px 18px;
        font-weight: 500;
        font-size: 0.9rem;
        color: white !important;
        transition: background-color 0.3s;
    }

    .btn-modern:hover {
        background-color: #2d417a !important;
        color: white !important;
    }

    .tag {
        display: inline-block;
        background-color: #eaf2ff;
        color: #0c3c83;
        font-size: 0.75rem;
        font-weight: 500;
        padding: 4px 10px;
        border-radius: 12px;
        margin: 3px 5px 0 0;
    }

    .alert-info {
        background: #eaf2ff;
        border-color: #d0e3ff;
        color: #0c3c83;
        font-size: 0.95rem;
    }

    .section_tittle1 h3 {
        font-size: 2rem;
        margin-bottom: 15px;
        color: #2c3e50;
    }
</style>

<section class="special_cource padding_top" style="background:#f5f6fa;">
    <div class="container">
        <div class="row justify-content-center mt-0">
            <div class="col-xl-10 text-center">
                <div class="section_tittle1">
                    <h3>Available Programs with Scholarships</h3>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="alert alert-info" role="alert">
                        To apply for a scholarship, select the institution below. From its page, choose the scholarship you're interested in.
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($randomInstitutions as $institution)
                <div class="col-sm-6 col-md-4 col-lg-4 mb-4 d-flex align-items-stretch">
                    <a href="{{ route('courses.index') }}?institution={{ $institution->id }}" class="w-100 text-decoration-none text-dark">
                        <div class="card text-center h-100">
                            <img src="{{ $institution->logo->getUrl() }}" alt="{{ $institution->name }}" class="institution-logo" loading="lazy">

                            <div class="card-body">
                                <h6 class="card-title">{{ $institution->name }}</h6>

                                {{-- Tags (example: customize per institution or use DB values later) --}}
                                <div class="d-flex justify-content-center flex-wrap">
                                    <span class="tag">Public</span>
                                    <span class="tag">Top Ranked</span>
                                    {{-- <span class="tag">Private</span> --}}
                                </div>
                            </div>

                            <div class="card-footer bg-transparent">
                                <button class="btn btn-modern">
                                    View Programs with Advertised Scholarships ({{ $institution->courses->count() }})
                                </button>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
