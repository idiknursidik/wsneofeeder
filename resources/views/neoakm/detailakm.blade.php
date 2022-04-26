<div class="card">
    <div class="card-header"> Aktivitas Kuliah Mahasiswa</div>
    <div class="card-body">
        <form method="post" id="form-edit" action="{{ url('neoakm/update') }}">
            @csrf
            <input type="hidden" name="id_registrasi_mahasiswa" value="{{ $data->data[0]->id_registrasi_mahasiswa }}">
            <input type="hidden" name="id_semester" value="{{ $data->data[0]->id_semester }}">

            <div class="row">
                <div class="col">
                    <label>Mahasiswa</label> 
                    <input type="text" class="form-control" readonly value="{{ $data->data[0]->nim }}-{{ $data->data[0]->nama_mahasiswa }}">
                </div>
                <div class="col"> 
                    <label>Semester</label> 
                    <input type="text" class="form-control" readonly value="{{ $data->data[0]->nama_semester }}">
                </div>
            </div> 
            <div class="row">   
                <div class="col">
                    <label>Status Mahasiswa</label>  
                    <select class="form-control" name="id_status_mahasiswa">
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
                    <input type="text" class="form-control" name="total_sks" value="{{ $data->data[0]->sks_total }}">
                    <small>*untuk decimal menggunakan titik</small>
                </div>
                <div class="col">
                    <label>Biaya Kuliah (semester)</label>  
                    <input type="text" class="form-control" name="biaya_kuliah_smt" value="{{ $data->data[0]->biaya_kuliah_smt }}">
                </div>
            </div>
            <hr>
            <button class="btn btn-primary" type="submit">Update</button>
        </form>
    </div>
</div> 
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#form-edit").on("submit",function(e){
        e.preventDefault();
        var dString = $(this).serialize();
        var url =  $(this).attr("action");
        $.ajax({
           url:url,
           method:'POST',
           data:dString,
           success:function(response){
              if(response.success == true){
                  alert(response.messages) //Message come from controller
              }else{
                  alert(response.messages)
              }
           },
           error:function(error){
              console.log(error)
           }
        });
	});

</script>   