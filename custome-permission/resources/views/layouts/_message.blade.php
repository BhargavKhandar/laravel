@if (!empty(session('success')))
    <div class="alert alert-success" role="alert" id="time">
        {{ session('success') }}
    </div>
@endif

@if (!empty(session('error')))
    <div class="alert alert-danger" role="alert" id="time">
        {{ session('error') }}
    </div>
@endif

<script>
    let timeElement = document.getElementById('time');
    if (timeElement) {
        setTimeout(() => {
            timeElement.parentNode.removeChild(timeElement);
        }, 5000);
    }
</script>
