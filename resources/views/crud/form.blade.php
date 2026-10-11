@extends('layouts.app', ['title' => ($isEdit ? 'Ubah ' : 'Tambah ') . $title])

@section('content')
    <div class="page-heading section-heading"><div><div class="eyebrow"><span></span> FORMULIR DATA</div><h1>{{ $isEdit ? 'Ubah ' : 'Tambah ' }}{{ $title }}</h1><p>Lengkapi informasi berikut, lalu simpan perubahan.</p></div></div>
    <section class="panel form-panel">
        <form method="POST" action="{{ $isEdit ? route('resources.update', [$resource, $record->id]) : route('resources.store', $resource) }}">
            @csrf
            @if ($isEdit) @method('PUT') @endif
            <div class="form-grid">
                @foreach ($fields as $field)
                    @php
                        $value = old($field['name'], $record ? data_get($record, $field['name']) : '');
                        if ($value instanceof \DateTimeInterface) {
                            $value = $field['type'] === 'datetime-local' ? $value->format('Y-m-d\TH:i') : $value->format('Y-m-d');
                        }
                    @endphp
                    <div class="form-field {{ $field['type'] === 'textarea' ? 'field-wide' : '' }}">
                        <label for="{{ $field['name'] }}">{{ $field['label'] }} @if (str_starts_with($field['rules'], 'required')) <span class="required-mark">*</span> @endif</label>
                        @if ($field['type'] === 'select')
                            <select id="{{ $field['name'] }}" name="{{ $field['name'] }}" @required(str_starts_with($field['rules'], 'required'))>
                                <option value="">Pilih {{ strtolower($field['label']) }}</option>
                                @foreach ($field['options'] ?? [] as $optionValue => $optionLabel)
                                    <option value="{{ $optionValue }}" @selected((string) $value === (string) $optionValue)>{{ $optionLabel }}</option>
                                @endforeach
                            </select>
                        @elseif ($field['type'] === 'textarea')
                            <textarea id="{{ $field['name'] }}" name="{{ $field['name'] }}" rows="4">{{ $value }}</textarea>
                        @else
                            <input id="{{ $field['name'] }}" name="{{ $field['name'] }}" type="{{ $field['type'] }}" value="{{ $value }}" @if ($field['step'] ?? null) step="{{ $field['step'] }}" @endif @required(str_starts_with($field['rules'], 'required'))>
                        @endif
                        @error($field['name']) <span class="field-error">{{ $message }}</span> @enderror
                    </div>
                @endforeach
            </div>
            <div class="form-actions"><a class="secondary-button" href="{{ route('resources.index', $resource) }}">Batal</a><button class="primary-button" type="submit">{{ $isEdit ? 'Simpan perubahan' : 'Simpan data' }}</button></div>
        </form>
    </section>
@endsection
