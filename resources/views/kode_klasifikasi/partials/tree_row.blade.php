<tr>
    <td style="padding-left: {{ $level * 20 }}px;">
        <b>{{ $kodeKlasifikasi->kode_klasifikasi }}</b>
    </td>
    <td>{{ $kodeKlasifikasi->nama_klasifikasi }}</td>
    <td>{{ $kodeKlasifikasi->deskripsi }}</td>
    <td>
        <a href="{{ route('kode_klasifikasi.edit', $kodeKlasifikasi->id_kode_klasifikasi) }}"
            class="btn btn-primary btn-sm"><i class="align-middle" data-feather="edit-2"></i></a>
        <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $kodeKlasifikasi->id_kode_klasifikasi }}">
            <i class="align-middle" data-feather="trash"></i>
        </button>
    </td>
</tr>

@if (!empty($kodeKlasifikasi->children))
    @foreach ($kodeKlasifikasi->children as $child)
        @include('kode_klasifikasi.partials.tree_row', [
            'kodeKlasifikasi' => $child,
            'level' => $level + 1,
        ])
    @endforeach
@endif
