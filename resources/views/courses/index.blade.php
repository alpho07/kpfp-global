@extends('layouts.main')

@section('content')
<style>
    .scholarship-card {
        border: none;
        border-radius: 12px;
        padding: 1.25rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: transform 0.2s ease;
    }

    .scholarship-card:hover {
        transform: translateY(-4px);
    }

    .status-active {
        background: linear-gradient(135deg, #4caf50, #81c784);
        color: white;
    }

    .status-upcoming {
        background: linear-gradient(135deg, #0288d1, #4fc3f7);
        color: white;
    }

    .status-closed {
        background: linear-gradient(135deg, #d32f2f, #e57373);
        color: white;
    }

    .scholarship-card h5, .scholarship-card h6 {
        margin-bottom: 0.25rem;
    }

    .section-title {
        font-weight: 600;
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .badge {
        font-size: 0.8rem;
    }
</style>

<section class="py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="section-title">
                🎓 {{ $inst->name }} Scholarships
            </h3>
            <a href="{{ route('home') }}" class="btn btn-outline-primary">← Back</a>
        </div>

        {{-- Active Scholarships --}}
        <div class="mb-5">
            <h4 class="mb-3">🎯 Active Scholarships</h4>
            <div class="row g-3">
                @forelse ($courses->where('status', 'Active') as $course)
                    <div class="col-md-6 col-lg-4 mt-3">
                        <a href="{{ route('courses.show', $course->id) }}" class="text-decoration-none">
                            <div class="scholarship-card status-active">
                                <h5 style="color:white">{{ $course->course->name }}</h5>
                                <h6 style="color:white">{{ $course->course->category->name }}</h6>
                                <span class="badge bg-light text-dark">
                                    {{ $course->days_left }}  | Deadline: {{ \Carbon\Carbon::parse($course->application_end_date)->format('D, M j, Y') }}
                                </span>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12"><p>No active scholarships at the moment.</p></div>
                @endforelse
            </div>
        </div>

        {{-- Upcoming & Closed --}}
        <div class="row g-4">
            {{-- Upcoming --}}
            <div class="col-md-6">
                <h4>⏳ Upcoming</h4>
                @forelse ($courses->where('status', 'Upcoming') as $course)
                    <div class="scholarship-card status-upcoming mb-3">
                        <h5 style="color:white">{{ $course->course->name }}</h5>
                        <h6 style="color:white">{{ $course->course->category->name }}</h6>
                        <span class="badge bg-light text-dark">{{ $course->days_left }}</span>
                    </div>
                @empty
                    <p>No upcoming scholarships.</p>
                @endforelse
            </div>

            {{-- Closed --}}
            <div class="col-md-6">
                <h4>❌ Closed</h4>
                @forelse ($courses->where('status', 'Closed') as $course)
                    <div class="scholarship-card status-closed mb-3">
                        <h5 style="color:white">{{ $course->course->name }}</h5>
                        <h6 style="color:white">{{ $course->course->category->name }}</h6>
                    </div>
                @empty
                    <p>No closed scholarships.</p>
                @endforelse
            </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-4 d-flex justify-content-end">
            {{ $courses->appends(request()->query())->links() }}
        </div>
    </div>
</section>
@endsection
