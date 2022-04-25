<div class="card">
    <div class="card-header"> Aktivitas Kuliah Mahasiswa</div>
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col">
                    <label>Mahasiswa</label> 
                    <input type="text" class="form-control" name="nama_mahasiswa" value="{{ $data->data[0]->nama_mahasiswa }}">
                </div>
                <div class="col"> 
                    <label>Semester</label> 
                    <input type="text" class="form-control" name="nama_semester" value="{{ $data->data[0]->nama_semester }}">
                </div>
            </div> 
            <div class="row">   
                <div class="col">
                    <label>Status Mahasiswa</label>  
                    <select class="form-control" name="nama_status_mahasiswa">
                        @foreach($GetStatusMahasiswa->data as $statusmhs)
                            <option value="{{ $statusmhs->id_status_mahasiswa }}" @if($data->data[0]->id_status_mahasiswa == $statusmhs->id_status_mahasiswa) selected="selected" @endif>{{ $statusmhs->nama_status_mahasiswa }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label>IPS</label>  
                    <input type="text" class="form-control" name="ips" value="{{ $data->data[0]->ips }}">
                </div>
            </div> 
            <div class="row">
                <div class="col">
                    <label>IPK</label>  
                    <input type="text" class="form-control" name="ipk" value="{{ $data->data[0]->ipk }}">
                    <small>*untuk decimal menggunakan titik</small>
                </div>
                <div class="col">
                    <label>sks Semester</label>  
                    <input type="text" class="form-control" name="sks_semester" value="{{ $data->data[0]->sks_semester }}">
                </div>
            </div> 
            <div class="row">
                <div class="col">
                    <label>sks Total</label>  
                    <input type="text" class="form-control" name="sks_total" value="{{ $data->data[0]->sks_total }}">
                    <small>*untuk decimal menggunakan titik</small>
                </div>
                <div class="col">
                    <label>Biaya Kuliah (semester)</label>  
                    <input type="text" class="form-control" name="biaya_kuliah_smt" value="{{ $data->data[0]->biaya_kuliah_smt }}">
                </div>
            </div>
            <hr>
            <button class="btn btn-primary" type="submit">Simpan</button>
        </form>
    </div>
</div>  