<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

<script>
	$('#crear_empleado').click(function(e) {
		e.preventDefault();

		var rols = [];
		var sexo = '';

		$.each($("input[name='rol_empleado']:checked"), function(){
		  rols.push($(this).val());
		});


		if($('input[name="sexo_empleado"]').is(':checked')) {
			sexo = $('input[name="sexo_empleado"]:checked').val();
		}

		data_empleado = {
			nombre: $('#nombre_empleado').val(),
			email: $('#email_empleado').val().toLowerCase(),
			sexo: sexo,
			area_id: $('#area_id_empleado').val(),
			descripcion: $('#descripcion_empleado').val(),
			boletin: Number($('input[name="boletin_empleado"]').is(':checked')),
			rols: rols,
			_token: $('meta[name="csrf-token"]').attr('content')
		}

		$.ajax({
				url:"{{route('empleados.store')}}",
				type:"POST",
				data: data_empleado,
				beforeSend:function(){
					$(document).find('.was-validated').removeClass('was-validated');
					$(document).find('.invalid-feedback').remove();
				},
				success:function(response){
					if(!response.error) {
						$('#modal_add_empleado').modal('hide');

						$('#msg_response').addClass('alert-success');
						$('#msg_response').text(response.msg);
						$('#msg_response').slideDown();

						setTimeout(function(){
							location.reload();
						}, 2000);
					} else {
						if(response.errors) {
							$('#form_empleado').addClass('was-validated');
							$.each(response.errors, function(index, value){
								$('.'+index+'_empleado').append('<div class="invalid-feedback">'+value+'</div>');
							});
						} else {
							$('#modal_add_empleado').modal('hide');
							$('#msg_response').addClass('alert-danger');
							$('#msg_response').text(response.error_msg);
							$('#msg_response').slideDown();
						}
					}
				}
			});
	});

	function delete_empleado(id) {
		if(confirm("Desea eliminar")) {

			ruta = "{{route('empleados.destroy',['%idEmpleado%'])}}";
			ruta = ruta.replace('%idEmpleado%',id);
			
			$.ajax({
				url: ruta,
				type: 'DELETE',
				data: {
					_token: $('meta[name="csrf-token"]').attr('content')
				},
				success:function(response) {
					if(!response.error) {

						$('#msg_response').addClass('alert-success');
						$('#msg_response').text(response.msg);
						$('#msg_response').slideDown();

						setTimeout(function(){
							location.reload();
						}, 2000);
					}
				}
			});
		}
	}

	function editar_profesor(id) {
		ruta = "{{route('empleados.show',['%idEmpleado%'])}}";
		ruta = ruta.replace('%idEmpleado%',id);

		$.ajax({
			url: ruta,
			type: "GET",
			dataType: "json",
			data: {
				_token: $('meta[name="csrf-token"]').attr('content')
			},
			success: function (response) {
				$("#data_update_empleado").html(response.body);
				$('#modal_edit_empleado').modal('show'); 
			}
		});
	}

	$('#actualizar_empleado').click(function(e) {
		e.preventDefault();

		var rols = [];
		var sexo = '';

		$.each($("input[name='rol_empleado_update']:checked"), function(){
		  rols.push($(this).val());
		});

		if($('input[name="sexo_empleado_update"]').is(':checked')) {
			sexo = $('input[name="sexo_empleado_update"]:checked').val();
		}

		data_empleado = {
			nombre: $('#nombre_empleado_update').val(),
			email: $('#email_empleado_update').val().toLowerCase(),
			sexo: sexo,
			area_id: $('#area_id_empleado_update').val(),
			descripcion: $('#descripcion_empleado_update').val(),
			boletin: Number($('input[name="boletin_empleado_update"]').is(':checked')),
			rols: rols,
			_token: $('meta[name="csrf-token"]').attr('content')
		}

		var id = $('#empleado_id').val();
		var ruta = "{{route('empleados.update',['%idEmpleado%'])}}";
		var ruta = ruta.replace('%idEmpleado%',id);

		$.ajax({
			url: ruta,
			type: "PUT",
			data: data_empleado,
			beforeSend:function(){
				$(document).find('.was-validated').removeClass('was-validated');
				$(document).find('.invalid-feedback').remove();
			},
			success:function(response){
				if(!response.error) {
					$('#modal_edit_empleado').modal('hide'); 

					$('#msg_response').addClass('alert-success');
					$('#msg_response').text(response.msg);
					$('#msg_response').slideDown();

					setTimeout(function(){
						location.reload();
					}, 2000);
				} else {
					if(response.errors) {
						$('#form_empleado_update').addClass('was-validated');
						$.each(response.errors, function(index, value){
							$('.'+index+'_empleado_update').append('<div class="invalid-feedback">'+value+'</div>');
						});
					} else {
						$('#modal_edit_empleado').modal('hide');
						$('#msg_response').addClass('alert-danger');
						$('#msg_response').text(response.error_msg);
						$('#msg_response').slideDown();
					}
				}
			}
		});
	});
</script>