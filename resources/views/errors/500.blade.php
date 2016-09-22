<div class="content">
    <div class="title">Something went wrong.</div>
@unless(empty($sentryID))
    <!-- Sentry JS SDK 2.1.+ required -->
        <script src="https://cdn.ravenjs.com/3.3.0/raven.min.js"></script>

        <script>
            Raven.showReportDialog({
                eventId: '{{ $sentryID }}',

                // use the public DSN (dont include your secret!)
                dsn: 'http://12b22a4d7f744c36988a88b521796f2a@bugs.kendozone.com/2'
            });
        </script>
    @endunless
</div>