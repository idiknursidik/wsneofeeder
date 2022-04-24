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
                <select name="jenis_kelamin" value="{{ $databiodata->data[0]->jenis_kelamin }}" class="form-control">
                    @foreach($kelamin as $key=>$val)
                    <option value="{{ $key }}" @if($databiodata->data[0]->jenis_kelamin == $key) selected="selected" @endif>{{ $val }}</option>
                    @endforeach
                </select>
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
                <select name="id_agama" class="form-control">
                    @if(!empty($GetAgama))
                        @foreach($GetAgama->data as $agama)
                            <option value="{{ $agama->id_agama }}" @if($databiodata->data[0]->nama_ibu_kandung == $agama->id_agama) selected="selected" @endif>{{ $agama->nama_agama }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
</div>