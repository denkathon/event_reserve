@if( session('flash') )
@foreach (session('flash') as $key => $item)
<div class="alert alert-{{ $key }}">{{ session('flash.' . $key) }}</div>
@endforeach
@endif
<script>
setTimeout(function() {
    var alerts = document.querySelectorAll('.alert-success, .alert-error');
    alerts.forEach(function(alert) {
        alert.style.transition = 'opacity 1s ease';
        alert.style.opacity = 0;
        setTimeout(function() {
            alert.style.display = 'none';
        }, 2000);
    });
}, 2000);
</script>