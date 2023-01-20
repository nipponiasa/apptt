@extends('adminlte::page')
@section('title', 'Apps - Trade And Traffic')
@section('content_header')
<a href="{{ URL::previous() }}">Go Back</a>
        <h1>Trade and Traffic Plus - Copy mailing lists </h1>
      
@stop
@section('plugins.Datatables', true)
@section('content')

<div class="container" style="margin-top:20px;">
<div class="row">

        <div class="col-md-6 mb-5">
            <h1>Mail list of dealers with active consignements</h1>
   
 

{{--

<div class="input-group">
  <span class="input-group-text">Mail list</span>
  <input value={{$txt_to_copy}} class="form-control" aria-label="email addresses" id="mail_list">
</div>
--}}


<a class="btn btn-primary" href='mailto:?bcc={{$txt_to_copy}}'>Prepare email</a>







{{--

<button onclick="copytextfunction()" class="btn btn-primary" style="margin-top:10px;">Copy emails</button> 

--}}

        </div>

</div>
</div>


















@stop


@section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@stop

@section('js')
<script>
function copytextfunction() {
  /* Get the text field */
  var copyText = document.getElementById("mail_list");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

   /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);

  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
} 

</script>

@stop








