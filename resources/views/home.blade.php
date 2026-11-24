@extends('layouts.tasks')

@section('title', 'Tasks for Today | Plan your day')

@section('content')
    <section class="hero">
        <div class="hero-copy">
            <p class="eyebrow">A little more focus, every day</p>
            <h1>Make room for<br><span>what matters.</span></h1>
            <p class="hero-description">A simple shared task list to capture the next step, keep work moving, and celebrate what gets done.</p>
            <div class="hero-actions">
                <a class="button button-primary" href="{{ route('tasks.index') }}">Explore the task list <span aria-hidden="true">→</span></a>
                @guest
                    <a class="button button-secondary" href="{{ route('register') }}">Create your account</a>
                @else
                    <a class="button button-secondary" href="{{ route('tasks.create') }}">Add a task</a>
                @endguest
            </div>
            <p class="hero-note"><span aria-hidden="true">●</span> Public task viewing. Sign-in protected task management.</p>
        </div>
        <div class="hero-preview" aria-label="Task workspace preview">
            <div class="preview-top">
                <span class="preview-icon">T</span>
                <span>YOUR TASK BOARD</span>
                <span class="preview-live"><i></i>READY</span>
            </div>
            <div class="preview-intro">
                <p>ONE STEP AT A TIME</p>
                <h2>Today, made<br>more manageable.</h2>
            </div>
            <div class="preview-task">
                <span class="preview-check">✓</span>
                <span><small>UP NEXT</small><strong>Choose your next task</strong></span>
                <span class="preview-arrow">↗</span>
            </div>
            <div class="preview-task preview-task-muted">
                <span class="preview-check preview-check-done">✓</span>
                <span><small>DONE</small><strong>Celebrate your progress</strong></span>
            </div>
            <div class="preview-bottom"><span>Plan clearly</span><span>Move confidently</span></div>
        </div>
    </section>

    <section class="benefits" aria-label="Workspace features">
        <article class="benefit-card">
            <span class="benefit-number">01</span>
            <h2>Keep it clear</h2>
            <p>See task descriptions, due dates, and status in one easy-to-scan list.</p>
        </article>
        <article class="benefit-card">
            <span class="benefit-number">02</span>
            <h2>Stay in control</h2>
            <p>Sign in to create, edit, and archive tasks while the list stays open to view.</p>
        </article>
        <article class="benefit-card">
            <span class="benefit-number">03</span>
            <h2>Notice progress</h2>
            <p>Mark a task done and let the workspace send its completion notification.</p>
        </article>
    </section>
@endsection
