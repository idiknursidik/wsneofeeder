<table class="table">
    <thead>
        <tr><th>No</th><th>Kode MK</th><th>Nama MK</th><th>Bobot MK (sks)</th></tr>
    </thead>
    <tbody>
    @if(empty($krs->data))
        <tr><td colspan="4">Tidak ada data</tr>
    @else
        @php
            $totalsks=0;
        @endphp
        @foreach($krs->data as $krs)
            <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $krs->kode_mata_kuliah }}</td>
            <td>{{ $krs->nama_mata_kuliah }}</td>
            <td>{{ $krs->sks_mata_kuliah }}</td>
            </tr>
            @php
             $totalsks+=$krs->sks_mata_kuliah;
            @endphp
        @endforeach
        <tr><td colspan="3">Total </td><td>{{ $totalsks }}</td></tr>
    @endif
    </tbody>
</table>