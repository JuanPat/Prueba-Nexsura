<form id="form_empleado_update">
	<input type="hidden" id="empleado_id" name="empleado_id" value="{{$empleado->id}}">
	<div class="mb-3 row">
	    <label for="nombre_empleado_update" class="col-sm-2 col-form-label"><strong>Nombre</strong></label>
	    <div class="col-sm-10 nombre_empleado_update">
	        <input type="text" class="form-control" id="nombre_empleado_update" value="{{$empleado->nombre}}" required />
	    </div>
	</div>
	<div class="mb-3 row">
	    <label for="email_empleado_update" class="col-sm-2 col-form-label"><strong>Email</strong></label>
	    <div class="col-sm-10 email_empleado_update">
	        <input type="email" class="form-control" id="email_empleado_update" value="{{$empleado->email}}" required />
	    </div>
	</div>
	<div class="mb-3 row">
	    <label for="sexo" class="col-sm-2 col-form-label"><strong>Sexo</strong></label>
	    <div class="col-sm-10">
	        <div class="form-check">
			    <input class="form-check-input" type="radio" name="sexo_empleado_update" required id="masculino" value="m" @if($empleado->sexo == "m") checked @endif />
			    <label class="form-check-label" for="masculino">
			        Masculino
			    </label>
			</div>
			<div class="form-check sexo_empleado_update">
			    <input class="form-check-input" type="radio" name="sexo_empleado_update" required id="femenino" value="f"  @if($empleado->sexo == "f") checked @endif/>
			    <label class="form-check-label" for="femenino">
			        Femenino
			    </label>
			</div>
	    </div>
	</div>
	<div class="mb-3 row">
	    <label for="area_id_empleado_update" class="col-sm-2 col-form-label"><strong>Area</strong></label>
	    <div class="col-sm-10 area_id_empleado_update">
	        <select class="form-select" id="area_id_empleado_update" name="area_id_empleado_update" required>
			    <option value="" selected disabled></option>
			    @foreach($areas as $area)
					<option value="{{$area->id}}"
	                    @if($area->id == $empleado->area_id) selected @endif>{{$area->nombre}}
	                </option>

	            @endforeach
			</select>
	    </div>
	</div>
	<div class="mb-3 row">
	    <label for="descripcion_empleado_update" class="col-sm-3 col-form-label"><strong>Descripción</strong></label>
	    <div class="col-sm-9 descripcion_empleado_update">
	        <textarea class="form-control" id="descripcion_empleado_update" rows="2" required>{{$empleado->descripcion}}</textarea>
	    </div>
	</div>
	<div class="mb-3 row">
	    <label class="col-sm-2 col-form-label"></label>
	    <div class="col-sm-10">
	        <div class="form-check">
			    <input class="form-check-input" type="checkbox" id="boletin_empleado_update" name="boletin_empleado_update" @if($empleado->boletin == 1) checked @endif/>
			    <label class="form-check-label" for="boletin_empleado_update">
			        Deseo recibir boletín informativo
			    </label>
			</div>
	    </div>
	</div>
	<div class="mb-3 row">
	    <label for="rol_empleado_update" class="col-sm-2 col-form-label"><strong>Roles</strong></label>
	    <div class="col-sm-10">
	        @foreach($rols as $rol)
				<div class="form-check">
					<input class="form-check-input" name="rol_empleado_update" type="checkbox" value="{{$rol->id}}" id="{{$rol->id}}" @foreach($empleado->roles as $empleado_rol)
						@if($empleado_rol->id == $rol->id) checked @endif
					@endforeach/>
					    <label class="form-check-label" for="{{$rol->id}}">
					        {{$rol->nombre}}
					    </label>
				</div>
	        @endforeach
	    </div>
	</div>
</form>