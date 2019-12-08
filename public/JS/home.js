$(document).ready(function(){
	$(document).on('click', '#carrito', function(){
		var id = $(this).val();
		var configuracion = { 
			funcion: "agregarCarrito",
			user: $("#user").val(),
			producto: id
		};
		$.ajax({
			type: "POST",
			url: 'ajax.php',
			data: configuracion,
			success: function(response)
			{
				alertify.success('Agregado correctamente');
			}
		});
	});
});

/*$('#carrito').click(function(){
	var id = $(this).val();
	var configuracion = { 
		funcion: "agregarCarrito",
		user: $("#user").val(),
		producto: $("#producto_"+id).val()
	};
	$.ajax({
		type: "POST",
		url: 'ajax.php',
		data: configuracion,
		success: function(response)
		{
			alertify.alert("Carrito", "Se agrego al carrito correctamente");
		}
	});
});*/