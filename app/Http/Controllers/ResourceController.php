<?php

namespace App\Http\Controllers;

use App\Models\Cuaca;
use App\Models\FishPrice;
use App\Models\Kapal;
use App\Models\Monitoring;
use App\Models\Parking;
use App\Models\Tangkapan;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResourceController extends Controller
{
    public function index(string $resource): View
    {
        $definition = $this->definition($resource);
        $model = $definition['model'];
        $query = $model::query();

        if ($definition['withKapal']) {
            $query->with('kapal');
        }

        return view('crud.index', [
            'resource' => $resource,
            'title' => $definition['title'],
            'fields' => $definition['fields'],
            'records' => $query->latest()->paginate(15),
            'activeSection' => $resource,
        ]);
    }

    public function create(string $resource): View
    {
        return $this->formView($resource, null);
    }

    public function store(Request $request, string $resource): RedirectResponse
    {
        $definition = $this->definition($resource);
        $definition['model']::query()->create($request->validate($this->rules($definition['fields'])));

        return redirect()->route('resources.index', $resource)->with('status', $definition['title'].' berhasil ditambahkan.');
    }

    public function edit(string $resource, string $id): View
    {
        $definition = $this->definition($resource);
        $record = $definition['model']::query()->findOrFail($id);

        return $this->formView($resource, $record);
    }

    public function update(Request $request, string $resource, string $id): RedirectResponse
    {
        $definition = $this->definition($resource);
        $record = $definition['model']::query()->findOrFail($id);
        $record->update($request->validate($this->rules($definition['fields'], $record)));

        return redirect()->route('resources.index', $resource)->with('status', $definition['title'].' berhasil diperbarui.');
    }

    public function destroy(string $resource, string $id): RedirectResponse
    {
        $definition = $this->definition($resource);
        $record = $definition['model']::query()->findOrFail($id);
        $record->delete();

        return redirect()->route('resources.index', $resource)->with('status', $definition['title'].' berhasil dihapus.');
    }

    /**
     * @return array{title: string, model: class-string<Model>, withKapal: bool, fields: array<int, array<string, mixed>>}
     */
    private function definition(string $resource): array
    {
        $definitions = [
            'kapal' => [
                'title' => 'Data Kapal',
                'model' => Kapal::class,
                'withKapal' => false,
                'fields' => [
                    $this->field('nama_kapal', 'Nama kapal', 'text', 'required|string|max:100') + ['uniqueTable' => 'kapal'],
                    $this->field('jenis_kapal', 'Jenis kapal', 'text', 'required|string|max:50'),
                    $this->field('nama_kapten', 'Nama kapten', 'text', 'required|string|max:100'),
                    $this->field('status', 'Status', 'select', 'required|in:Berlayar,Bersandar,Maintenance', ['Berlayar' => 'Berlayar', 'Bersandar' => 'Bersandar', 'Maintenance' => 'Maintenance']),
                    $this->field('foto', 'Foto (path, opsional)', 'text', 'nullable|string|max:255'),
                ],
            ],
            'tangkapan' => [
                'title' => 'Data Tangkapan',
                'model' => Tangkapan::class,
                'withKapal' => true,
                'fields' => [
                    $this->shipField(),
                    $this->field('jenis_ikan', 'Jenis ikan', 'text', 'required|string|max:100'),
                    $this->field('berat', 'Berat (kg)', 'number', 'required|numeric|min:0.01|max:99999999.99', null, '0.01'),
                    $this->field('tanggal_tangkap', 'Tanggal tangkap', 'date', 'required|date'),
                    $this->field('lokasi_tangkap', 'Lokasi tangkap', 'text', 'nullable|string|max:150'),
                    $this->field('foto_bukti', 'Foto bukti (path, opsional)', 'text', 'nullable|string|max:255'),
                ],
            ],
            'monitoring' => [
                'title' => 'Monitoring Kapal',
                'model' => Monitoring::class,
                'withKapal' => true,
                'fields' => [
                    $this->shipField(),
                    $this->field('lokasi', 'Lokasi', 'text', 'required|string|max:150'),
                    $this->field('status_monitoring', 'Status monitoring', 'select', 'required|in:Aman,Waspada,Darurat', ['Aman' => 'Aman', 'Waspada' => 'Waspada', 'Darurat' => 'Darurat']),
                    $this->field('waktu_monitoring', 'Waktu monitoring', 'datetime-local', 'required|date'),
                ],
            ],
            'parkir' => [
                'title' => 'Parkir Kapal',
                'model' => Parking::class,
                'withKapal' => true,
                'fields' => [
                    $this->shipField(),
                    $this->field('lokasi_parkir', 'Lokasi parkir', 'text', 'required|string|max:150'),
                    $this->field('waktu_masuk', 'Waktu masuk', 'datetime-local', 'required|date'),
                    $this->field('waktu_keluar', 'Waktu keluar', 'datetime-local', 'nullable|date'),
                    $this->field('status', 'Status', 'select', 'required|in:Parkir,Selesai', ['Parkir' => 'Parkir', 'Selesai' => 'Selesai']),
                    $this->field('biaya', 'Biaya (Rp)', 'number', 'required|numeric|min:0|max:999999999999.99', null, '0.01'),
                    $this->field('foto_bukti', 'Foto bukti (path, opsional)', 'text', 'nullable|string|max:255'),
                ],
            ],
            'harga-ikan' => [
                'title' => 'Harga Ikan',
                'model' => FishPrice::class,
                'withKapal' => false,
                'fields' => [
                    $this->field('jenis_ikan', 'Jenis ikan', 'text', 'required|string|max:100'),
                    $this->field('harga_per_kg', 'Harga per kg (Rp)', 'number', 'required|numeric|min:0.01|max:9999999999.99', null, '0.01'),
                    $this->field('lokasi_pasar', 'Lokasi pasar', 'text', 'required|string|max:150'),
                    $this->field('tanggal_update', 'Tanggal update', 'date', 'required|date'),
                    $this->field('foto', 'Foto (path, opsional)', 'text', 'nullable|string|max:255'),
                ],
            ],
            'cuaca' => [
                'title' => 'Informasi Cuaca',
                'model' => Cuaca::class,
                'withKapal' => false,
                'fields' => [
                    $this->field('suhu', 'Suhu (°C)', 'number', 'nullable|numeric|between:-50,70', null, '0.01'),
                    $this->field('kondisi', 'Kondisi', 'text', 'required|string|max:50'),
                    $this->field('kecepatan_angin', 'Kecepatan angin (km/jam)', 'number', 'nullable|integer|min:0|max:65535'),
                    $this->field('kelembapan', 'Kelembapan (%)', 'number', 'nullable|integer|min:0|max:100'),
                    $this->field('update_terakhir', 'Waktu update', 'datetime-local', 'required|date'),
                ],
            ],
        ];

        abort_unless(isset($definitions[$resource]), 404);

        return $definitions[$resource];
    }

    /**
     * @param  array<string, string>|null  $options
     * @return array<string, mixed>
     */
    private function field(string $name, string $label, string $type, string $rules, ?array $options = null, ?string $step = null): array
    {
        return compact('name', 'label', 'type', 'rules', 'options', 'step');
    }

    /**
     * @return array<string, mixed>
     */
    private function shipField(): array
    {
        return [
            'name' => 'kapal_id',
            'label' => 'Kapal',
            'type' => 'select',
            'rules' => 'required|integer|exists:kapal,id',
            'options' => Kapal::query()->orderBy('nama_kapal')->pluck('nama_kapal', 'id')->all(),
            'relation' => true,
        ];
    }

    /**
     * @param  array<int, array<string, mixed>>  $fields
     * @return array<string, string>
     */
    private function rules(array $fields, ?Model $record = null): array
    {
        $rules = [];

        foreach ($fields as $field) {
            $fieldRules = [$field['rules']];

            if (isset($field['uniqueTable'])) {
                $fieldRules[] = Rule::unique($field['uniqueTable'], $field['name'])->ignore($record?->getKey());
            }

            $rules[$field['name']] = $fieldRules;
        }

        return $rules;
    }

    private function formView(string $resource, ?Model $record): View
    {
        $definition = $this->definition($resource);

        return view('crud.form', [
            'resource' => $resource,
            'title' => $definition['title'],
            'fields' => $definition['fields'],
            'record' => $record,
            'isEdit' => $record !== null,
            'activeSection' => $resource,
        ]);
    }
}
