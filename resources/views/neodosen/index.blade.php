@extends('layouts/main')
@section('title','Dosen')
@section('container') 
<div id="resultcontent">loading data...</div>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function(){
    $.post( "{{ url('neodosen/listdata') }}", { page: "1" }).done(function( data ) {
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
    $("body").on("change","input[name='filter']",function(){
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