@if (session('success'))
    <div class="bg-green-200 border-green-600 p-4 mb-3 rounded-sm shadow-sm" id="flash-messages">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="bg-red-200 border-red-600 p-4 mb-3 rounded-sm shadow-sm" id="flash-messages">
        {{ session('error') }}
    </div>
@endif

<script>
    // Remove flash messages after 5 seconds
    const flashMessages = document.getElementById('flash-messages');
    if (flashMessages) {
        setTimeout(function() {
            flashMessages.remove();
        }, 5000); // 5 seconds
    }
</script>
