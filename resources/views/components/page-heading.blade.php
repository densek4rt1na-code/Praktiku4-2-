<div class="page-heading section-heading">
    <div>
        <div class="eyebrow"><span></span> {{ $eyebrow }}</div>
        <h1>{{ $title }}</h1>
        <p>{{ $description }}</p>
    </div>
    @if ($actionUrl && $actionLabel)
        <a class="primary-button" href="{{ $actionUrl }}"><span>＋</span> {{ $actionLabel }}</a>
    @endif
</div>
