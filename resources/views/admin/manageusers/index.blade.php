@extends('layouts.app')

@section('title')
	Dashboard
@endsection

@section('extra-css')
    {{ Html::style('bsbmd/plugins/bootstrap-select/css/bootstrap-select.css') }}
@endsection

@section('content')
	<div class="container-fluid">
        <div class="block-header">
            <h2>GESTIONAR USUARIOS</h2>
            
        </div>

        <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">

                        <div class="body">
                            <br>
                            <div class="row clearfix">
                                <form>
	                                {{ Form::model(Request::only('type', 'val'), array('route' => 'manageusers.index', 'method' => 'GET'), array('role' => 'form', 'class' => 'navbar-form pull-right')) }}
                                        <div class="col-sm-1">
                                            {{ form::label('buscar', 'Tipo Busqueda:') }}
                                        </div>
                                        <div class="col-sm-2">
                                            {{ form::select('type', config('options.usertypes'), null, ['class' => 'form-control', 'id' => 'type'] ) }}
                                        </div>
                                        <div class="col-sm-4">
                                            {{ form::text('val', null, ['class' => 'form-control', 'id' => 'val']) }}
                                        </div>
                                        <div class="col-sm-1">
                                            <button type="submit" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                                        </div>

                                        <div class="col-sm-1">
                                            @if(Auth::user()->userType !== 'READONLY')
                                                <a href="{{ route('manageusers.create')}}" class="btn btn-sm btn-primary">
                                                    <span class="glyphicon glyphicon-plus"></span> Crear
                                                </a>  
                                            @endif
                                        </div>
                                        
                                    {{ Form::close() }}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Select -->

        <!-- Basic Table -->
        <div class="row clearfix">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                
                    <div class="header">
                        <h2>
                            Listado Usuarios
                            <!--<small>Listado Usuarios</small>-->
                        </h2>
                        
                    </div>
                    <div class="body table-responsive">
                    
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Usuario</th>
                                    <th>Tipo Usuario</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ trans("resource.$user->userType") }}</td>
                                        <td width="10px">
                                            <a href="{{ route('manageusers.show', $user->id) }}" class="btn btn-sm btn-default">
                                                Ver
                                            </a>
                                        </td>
                                        <td width="10px">
                                            <a href="{{ route('manageusers.edit', $user->id) }}" class="btn btn-sm btn-default">
                                                Editar
                                            </a>
                                        </td>
                                        <td width="10px">
                                            {!! Form::model($user, ['method' => 'delete', 'route' => ['manageusers.destroy', $user->id], 'class' =>'form-inline form-delete']) !!}
                                            {!! Form::hidden('id', $user->id) !!}
                                            {!! Form::submit('Eliminar', ['class' => 'btn btn-sm btn-danger delete', 'name' => 'delete_modal']) !!}
                                            {!! Form::close() !!}

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div> <?php echo  'Mostrando ' . $users->firstItem() . ' a ' . $users->lastItem() . ' de ' . $users->total() . ' registros'; ?>	</div>
                        {{ $users->render() }}
                    </div>
               
            </div>
        </div>
        <!-- #END# Basic Table -->
        </div>
    </div>
@endsection

@section('extra-script')
    {{Html::script('bsbmd/plugins/bootstrap-select/js/bootstrap-select.js')}}

@endsection