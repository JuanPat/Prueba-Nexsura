@extends('layouts.base')
@section('titulo','Empleados')
@section('contenido')
	
	<div class="container" style="margin: 50px auto;">
		<div class="alert" id="msg_response" role="alert" style="display: none;"></div>
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_add_empleado" style="margin-bottom: 10px;">Crear Empleado</button>

		@if(count($empleados) > 0)
			<table class="table text-center">
				<thead>
					<th scope="col">Nombre</th>
					<th scope="col">Email</th>
					<th scope="col">Sexo</th>
					<th scope="col">Area</th>
					<th scope="col">Boletin</th>
					<th scope="col">Modificar</th>
					<th scope="col">Eliminar</th>
				</thead>
				<tbody>
					@foreach($empleados as $empleado)
						<tr id="eid{{$empleado->id}}">
							<td>{{$empleado->nombre}}</td>
							<td>{{$empleado->email}}</td>
							<td>{{strtoupper($empleado->sexo)}}</td>
							<td>{{$empleado->area->nombre}}</td>
							<td>{{$empleado->boletin == 1 ? 'Si' : 'No'}}</td>
							<td><button type="button" class="btn btn-primary btn-sm" onclick="editar_profesor({{$empleado->id}})"><i class="fa-solid fa-user-pen"></i></button></td>
							<td><button type="button" class="btn btn-danger btn-sm" onclick="delete_empleado({{$empleado->id}})"><i class="fa-solid fa-trash"></i></button></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<center><p><strong>Actualmente no se encuentran registros</strong></p></center>
		@endif
	</div>

	<div class="modal fade" id="modal_add_empleado" tabindex="-1" aria-labelledby="modal_add_empleado" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h1 class="modal-title fs-5" id="modal_add_empleado">Crear Empleado</h1>
	                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	            </div>
	            <div class="modal-body">
	            	<form id="form_empleado">
	            		<div class="mb-3 row">
						    <label for="nombre_empleado" class="col-sm-2 col-form-label"><strong>Nombre</strong></label>
						    <div class="col-sm-10 nombre_empleado">
						        <input type="text" class="form-control" id="nombre_empleado" required />
						    </div>
						</div>
						<div class="mb-3 row">
						    <label for="email_empleado" class="col-sm-2 col-form-label"><strong>Email</strong></label>
						    <div class="col-sm-10 email_empleado">
						        <input type="email" class="form-control" id="email_empleado" required />
						    </div>
						</div>
						<div class="mb-3 row">
						    <label for="sexo_empleado" class="col-sm-2 col-form-label"><strong>Sexo</strong></label>
						    <div class="col-sm-10">
						        <div class="form-check">
								    <input class="form-check-input" type="radio" name="sexo_empleado" id="masculino" value="m" required />
								    <label class="form-check-label" for="masculino">
								        Masculino
								    </label>
								</div>
								<div class="form-check sexo_empleado">
								    <input class="form-check-input" type="radio" name="sexo_empleado" id="femenino" value="f" required />
								    <label class="form-check-label" for="femenino">
								        Femenino
								    </label>
								</div>
						    </div>
						</div>
						<div class="mb-3 row">
						    <label for="area_id_empleado" class="col-sm-2 col-form-label"><strong>Area</strong></label>
						    <div class="col-sm-10 area_id_empleado">
						        <select class="form-select" id="area_id_empleado" name="area_id_empleado" required >
								    <option value="" selected disabled></option>
								    @foreach($areas as $area)
										<option value="{{$area->id}}">{{$area->nombre}}</option>
						            @endforeach
								</select>
						    </div>
						</div>
						<div class="mb-3 row">
						    <label for="descripcion_empleado" class="col-sm-3 col-form-label"><strong>Descripción</strong></label>
						    <div class="col-sm-9 descripcion_empleado">
						        <textarea class="form-control" id="descripcion_empleado" rows="2" required ></textarea>
						    </div>
						</div>
						<div class="mb-3 row">
						    <label for="boletin_empleado" class="col-sm-2 col-form-label"></label>
						    <div class="col-sm-10">
						        <div class="form-check">
								    <input class="form-check-input" type="checkbox" id="boletin_empleado" name="boletin_empleado" />
								    <label class="form-check-label" for="boletin_empleado">
								        Deseo recibir boletín informativo
								    </label>
								</div>
						    </div>
						</div>
						<div class="mb-3 row">
						    <label class="col-sm-2 col-form-label"><strong>Roles</strong></label>
						    <div class="col-sm-10 ">
						        @foreach($rols as $rol)
									<div class="form-check">
									    <input class="form-check-input" name="rol_empleado" type="checkbox" value="{{$rol->id}}" id="{{$rol->id}}" />
									    <label class="form-check-label" for="{{$rol->id}}">
									        {{$rol->nombre}}
									    </label>
									</div>
					            @endforeach
						    </div>
						</div>
	            	</form>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
	                <button type="button" class="btn btn-primary" id="crear_empleado">Guardar</button>
	            </div>
	        </div>
	    </div>
	</div>

	<div class="modal fade" id="modal_edit_empleado" tabindex="-1" aria-labelledby="modal_update_empleado" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h1 class="modal-title fs-5" id="modal_update_empleado">Crear Empleado</h1>
	                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	            </div>
	            <div class="modal-body">
	            	<div id="data_update_empleado"></div>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
	                <button type="button" class="btn btn-primary" id="actualizar_empleado">Actualizar</button>
	            </div>
	        </div>
	    </div>
	</div>

@endsection