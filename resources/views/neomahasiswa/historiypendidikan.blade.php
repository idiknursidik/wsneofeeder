<div class="card">
    <div class="card-header"> Data Mahasiswa </div>
    <div class="card-body">
        <div class="row">
            <div class="col form-group">
                <label>Nama</label>
                <input type="text" name="nama_mahasiswa" value="{{ $databiodata->data[0]->nama_mahasiswa }}" class="form-control">
            </div>
            <div class="col form-group">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir" value="{{ $databiodata->data[0]->tempat_lahir }}" class="form-control">
            </div>            
        </div>
        <div class="row">    
            <div class="col form-group">
                <label>Jenis Kelamin</label>
                <input type="text" name="jenis_kelamin" value="{{ $databiodata->data[0]->jenis_kelamin }}" class="form-control">
            </div>
            <div class="col form-group">
                <label>Nama Ibu Kandung</label>
                <input type="text" name="nama_ibu_kandung" value="{{ $databiodata->data[0]->nama_ibu_kandung }}" class="form-control">
            </div>
        </div>
        <div class="row">    
            <div class="col form-group">
                <label>Tanggal Lahir</label>
                <input type="text" name="tanggal_lahir" value="{{ Carbon\Carbon::parse($databiodata->data[0]->tanggal_lahir)->format('Y-m-d') }}" class="form-control">
            </div>
            <div class="col form-group">
                <label>Agama</label>
                <input type="text" name="id_agama" value="{{ $databiodata->data[0]->id_agama }}" class="form-control">
            </div>
        </div>
    </div>
</div>
<br>
<div class="card">
    <div class="card-header"> History Pendidikan Mahasiswa </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <th>Action</th><th>NIM</th><th>Jenis Pendaftaran</th><th>Periode</th><th>Tangal Masuk</th><th>Perguruan Tinggi</th><th>Program Studi</th></tr>
            </thead>
            <tbody>
            @if(empty($riwayatpendidikan->data))
                <tr><td colspan="7">Tidak ada data</tr>
            @else
                @foreach($riwayatpendidikan->data as $riwpendidikan)
                    <tr>
                    <td></td>
                    <td>{{ $riwpendidikan->nim }}</td>
                    <td>{{ $riwpendidikan->nama_jenis_daftar }}</td>
                    <td>{{ $riwpendidikan->nama_periode_masuk }}</td>
                    <td>{{ $riwpendidikan->tanggal_daftar }}</td>
                    <td>{{ $riwpendidikan->nama_perguruan_tinggi }}</td>
                    <td>{{ $riwpendidikan->nama_program_studi }}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>        
</div>