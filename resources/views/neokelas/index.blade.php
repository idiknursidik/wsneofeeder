@extends('layouts/main')
@section('title','Kelas')
@section('container') 
<input type="text" name="filter" class="form-control" href="{{ url('neokelas/listdata') }}">
<br>
<a href="{{ url('neokelas/tambah') }}">TAMBAH</a>
<br><br>
<div id="resultcontent">loading data...</div>

<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function(){
    $.post( "{{ url('neokelas/listdata') }}", { page: "1" }).done(function( data ) {
        $("#resultcontent").html(data);
    })
    
    $("body").on("click",".halaman",function(){
        var url = $(this).attr('href');
        var page = $(this).attr('page');
        var filter = $("input[name='filter']").val();
        $.post( url, { page:page,filter:filter }).done(function( data ) {
            $("#resultcontent").html(data);
        })
        return false;
    })
    $("body").on("keyup","input[name='filter']",function(){
        var url = $(this).attr('href');
        var filter = $(this).val();
        $.post( url, { filter:filter }).done(function( data ) {
            $("#resultcontent").html(data);
        })
        return false;
    })
})
</script>
@endsection