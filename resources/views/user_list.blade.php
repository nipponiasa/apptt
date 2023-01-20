@extends('adminlte::page')
@section('title', 'User Management')
@section('plugins.Datatables', true)
@section('content_header')
        <a href="{{ URL::previous() }}">Go Back</a>
        <h1>Trade and Traffic Plus - User Management</h1>
@stop



@php
//var_dump($heads_motos);
$heads_motos = [
    'Name',
    'email',
    'Role',
    
    ['label' => 'Actions', 'no-export' => true],
];
$config = [
    'order' => [[1, 'asc']],
    'columns' => [null, null, null, ['orderable' => false]],
];
@endphp




@section('content')

@php        
$config['dom'] = '<"row" <"col-sm-7" B> <"col-sm-5 d-flex justify-content-end" i> >
                  <"row" <"col-12" tr> >
                  <"row" <"col-sm-12 d-flex justify-content-start" f> >';
$config['paging'] = false;
$config["lengthMenu"] = [ 10, 50, 100, 500];
@endphp







                                    <div class="row">
                                                            <div class="col-md-6 mb-5">
                                                            <a href="{{url('user_create_form')}}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Create user</a>
                                                           
                                                       
                                                            </div>
                                    </div>                              



                                    <div class="row">
                                        
                                            <x-adminlte-datatable id="table_invoices" :heads="$heads_motos" striped hoverable with-buttons>
                                                    @foreach(App\User::all()  as $user)
                                                    <tr>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ $user->role }}</td>
                                                            <td><a href=@php echo url("/user_edit_form?userid={$user->id}"); @endphp><button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit"><i class="fa fa-lg fa-fw fa-pen"></i></button></a>
                                                            <a href=@php echo url("/user_password_reset?userid={$user->id}"); @endphp><button class="btn btn-xs btn-default text-secondary mx-1 shadow" title="Reset Password"><i class="fa fa-lg fa-fw fa-lock"></i></button></a>
                                                            <a href=@php echo url("/user_delete?userid={$user->id}"); @endphp><button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete User"><i class="fa fa-lg fa-fw fa fa-user-times "></i></button></a></td>
                                                        </tr>
                                                    @endforeach
                                            </x-adminlte-datatable>
                                      

                                    </div>









@stop





@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>



</script>


@stop