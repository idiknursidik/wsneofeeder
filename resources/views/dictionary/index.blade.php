@extends('layouts/main')
@section('title','Get dictionary')
@section('container')
<form method="post" id="form-cek" action="{{ url('dictionary') }}">
    @csrf
    <input type="text" name="dictionary" class="form-control" placeholeder="masukan nama fungsi">
    <br>
    <button type="submit" class="btn btn-success">Cek Kamus</button>
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
        var dString = $(this).serialize();
        var url =  $(this).attr("action");
        $.ajax({
           url:url,
           method:'POST',
           data:dString,
           success:function(response){
              $("#resultcontent").html(response);
           },
           error:function(error){
              console.log(error)
           }
        });
        return false;
    })
   
})
</script>
@endsection