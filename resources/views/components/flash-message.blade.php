@if (session('status'))
    <div class="alert-success page-alert" role="status">{{ session('status') }}</div>
@endif
@if ($errors->any())
    <div class="alert-success page-alert" role="alert">Periksa kembali isian formulir. {{ $errors->first() }}</div>
@endif
