@if(session('alert_fail'))
<!-- Secondary Alert -->
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong> How are you! </strong> A simple <b>Dismissible danger Alert </b> — check it out!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session('alert_success'))
<!-- Success Alert -->
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session('alert_success') }}</strong>.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('success'))
    <!-- Success Alert -->
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong>.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <!-- Secondary Alert -->
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session('error') }}</strong>.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif