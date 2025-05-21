@extends('layouts.main')

@section('content')

<!-- Scroll Progress Bar -->
<style>
    #scrollProgress {
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 4px;
        background: #1e40af;
        z-index: 9999;
        transition: width 0.25s ease-out;
    }

    .glass-box {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 8px 32px rgba(0,0,0,0.1);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .fade-up {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeUp 0.8s ease-out forwards;
    }

    @keyframes fadeUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
<div id="scrollProgress"></div>

<script>
    window.addEventListener('scroll', () => {
        const scrollTop = window.scrollY;
        const docHeight = document.body.scrollHeight - window.innerHeight;
        const scrollPercent = (scrollTop / docHeight) * 100;
        document.getElementById('scrollProgress').style.width = scrollPercent + '%';
    });
</script>

<section class="section_padding" style="min-height: 100vh; background: linear-gradient(to bottom right, #e0e7ff, #fdf2f8);">
    <div class="container fade-up">
        <div class="text-center mb-4">
            <h2 class="fw-bold">{{ $course->course->name }} <small class="text-muted">Scholarship Application</small></h2>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="glass-box">
                    <div class="text-center">
                        <img src="{{ $course->institution->logo->getUrl() }}" alt="{{ $course->institution->name }}" class="img-fluid rounded shadow-sm mb-3" style="height: 150px;">
                    </div>

                    @if ($course->application_deadline)
                    <div class="alert alert-warning text-center fw-semibold">
                        📅 Application Deadline: {{ \Carbon\Carbon::parse($course->application_deadline)->format('F j, Y') }}
                        <div id="countdown" class="text-danger mt-2"></div>
                    </div>
                    <script>
                        const deadline = new Date("{{ $course->application_deadline }}").getTime();
                        const countdown = document.getElementById("countdown");
                        const interval = setInterval(() => {
                            const now = new Date().getTime();
                            const diff = deadline - now;
                            if (diff <= 0) {
                                countdown.innerText = "⛔ Deadline passed";
                                clearInterval(interval);
                                return;
                            }
                            const d = Math.floor(diff / (1000 * 60 * 60 * 24));
                            const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                            countdown.innerText = `⏳ ${d}d ${h}h ${m}m remaining`;
                        }, 1000);
                    </script>
                    @endif

                    <h4 class="mt-4">📌 Scholarship Requirements</h4>
                    <ol>
                        <li>Must be employed in a government hospital (preferably KPFP phase 1 sites)</li>
                        <li>Must be willing to complete training and bonded commitment</li>
                        <li>Must not be a previous KPFP scholarship beneficiary</li>
                    </ol>

                    <hr>
                    <h5>📎 Other Requirements</h5>
                    <div>{!! $course->description ?? 'No additional description provided.' !!}</div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="glass-box">
                    <ul class="list-unstyled">
                        @if ($course->institution)
                        <li class="mb-2"><strong>Offered By:</strong> {{ $course->institution->name }}</li>
                        @endif
                        <li class="mb-2"><strong>Duration:</strong> {{ $course->course->period->name }}</li>
                        <li class="mb-2"><strong>Cost:</strong> Fully Sponsored</li>
                    </ul>
                    <a href="{{ route('apply.scholarship', [0, $course->id]) }}?q=#step-1" class="btn btn-primary w-100 fw-bold">Apply Now</a>
                </div>
            </div>
        </div>

    
    </div>
</section>

<!-- Include Bootstrap CSS/JS if needed -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
