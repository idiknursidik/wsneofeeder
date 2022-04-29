@extends('layouts/main')
@section('title','Get dictionary')
@section('container')
<form method="post" id="form-cek" action="{{ url('dictionary') }}">
    @csrf
    <input type="text" name="dictionary" class="form-control" placeholeder="masukan nama fungsi">
    <br>
    <button type="submit" id="btnSubmit_form-cek" class="btn btn-success">Cek Kamus</button>
</form>
<hr> 
<div id="resultcontent">Masukan nama fungsi pada form input di atas.</div>
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function(){
    $("#form-cek").on("submit",function(e){
        e.preventDefault();
        var id = $(this).attr("id");
        var btnHtml = $("#btnSubmit_"+id+"").html();
        var dString = $(this).serialize();
        var url =  $(this).attr("action");
        $.ajax({
           url:url,
           method:'POST',
           data:dString,
            beforeSend:function(){
				$("#btnSubmit_"+id+"").prop("disabled",true);
				$("#btnSubmit_"+id+"").html("<span class='spinner-grow spinner-grow-sm' role='status' aria-hidden='true'></span> Loading...");			
			},
			complete:function(){
				$("#btnSubmit_"+id+"").prop("disabled",false);
				$("#btnSubmit_"+id+"").html(btnHtml);	
			},
            success:function(response){
              $("#resultcontent").html(response);
            },
            error:function(xhr,ajaxOptions,thrownError){
				alert(xhr.status+"\n"+xhr.responseText+"\n"+thrownError);				
			}
        });
        return false;
    })
   
})
</script>
@endsection