<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About | BlueCart</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
</head>
<body class="landing-page">
    @include('partials.marketing-navigation', ['activePage' => 'about'])

    <main class="marketing-main about-main">
        <section class="about-intro" aria-labelledby="about-title">
            <div class="about-copy">
                <p class="marketing-eyebrow">About the workspace</p>
                <h1 id="about-title">Made to keep the everyday <span>clear.</span></h1>
                <p class="marketing-description">
                    BlueCart is a focused point-of-sale management workspace for maintaining customer
                    contact records and the staff accounts that manage them.
                </p>
                <a class="marketing-button marketing-button-primary" href="{{ route('home') }}">Back to home</a>
            </div>
            <aside class="about-note">
                <span class="about-note-mark" aria-hidden="true">B</span>
                <p class="about-note-label">THE BLUECART APPROACH</p>
                <h2>Useful information, without the clutter.</h2>
                <p>People, access, and updates stay organized in one familiar place.</p>
            </aside>
        </section>

        <section class="about-capabilities" aria-labelledby="capabilities-title">
            <div class="section-heading">
                <p class="marketing-eyebrow">What you can do</p>
                <h2 id="capabilities-title">A practical set of tools for daily work.</h2>
            </div>
            <div class="capability-grid">
                <article class="capability-card">
                    <span class="capability-symbol capability-symbol-blue" aria-hidden="true">C</span>
                    <h3>Maintain customer records</h3>
                    <p>Keep names, email addresses, phone numbers, and profile images up to date.</p>
                </article>
                <article class="capability-card">
                    <span class="capability-symbol capability-symbol-violet" aria-hidden="true">U</span>
                    <h3>Manage staff accounts</h3>
                    <p>Give team members individual accounts, protected pages, and password controls.</p>
                </article>
                <article class="capability-card">
                    <span class="capability-symbol capability-symbol-mint" aria-hidden="true">✓</span>
                    <h3>Make careful updates</h3>
                    <p>Use validated forms and clear feedback when adding or changing information.</p>
                </article>
            </div>
        </section>

        <section class="about-workflow" aria-labelledby="workflow-title">
            <div class="workflow-heading">
                <p class="marketing-eyebrow">The workflow</p>
                <h2 id="workflow-title">From a new record to a confident update.</h2>
            </div>
            <div class="workflow-steps">
                <article>
                    <span class="workflow-mark" aria-hidden="true">+</span>
                    <h3>Add</h3>
                    <p>Enter the details your team needs.</p>
                </article>
                <article>
                    <span class="workflow-mark" aria-hidden="true">✓</span>
                    <h3>Review</h3>
                    <p>Check information before saving it.</p>
                </article>
                <article>
                    <span class="workflow-mark" aria-hidden="true">&rarr;</span>
                    <h3>Manage</h3>
                    <p>Find and update records when things change.</p>
                </article>
            </div>
        </section>
    </main>

    @include('partials.marketing-footer')
</body>
</html>
