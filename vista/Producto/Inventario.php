<div class="row">
	<div class="col-sm-4">
		<script>
			$(".custom-file-input").on("change", function() {
				var fileName = $(this).val().split("\\").pop();
				$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
			});
		</script>
		<form action="" class="was-validated">
			<div class="form-group">
				<div class="custom-file">
					<input type="file" class="custom-file-input" id="customFile">
					<label class="custom-file-label" for="customFile">Subir imágen</label>
				</div>
			</div>
			<div class="form-group">
				<a href="#" class="btn btn-primary btn-block">Subir</a>
			</div>
		</form>
	</div>
	<div class="col-sm-8">
		<form action="" class="was-validated">
			<div class="form-group">
				<label for="uname">Nombre:</label>
				<input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname"  required> 
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Favor de llenar este campo.</div>
			</div>
			<div class="form-group">
				<label for="sel1">Categoría:</label>
				<select class="form-control custom-select" id="sel1">
					<option value="1">Whiskey</option>
					<option value="2">Tequila</option>
					<option value="3">Ron</option>
					<option value="4">Ginebra</option>
					<option value="5">Brandy</option>
					<option value="6">Mezcal</option>
					<option value="7">Cerveza</option>
					<option value="8">Vinos</option>
					<option value="9">Vodka</option>
					<option value="10">Otros</option>
				</select>
			</div>
		</form>
		<form class="form-inline" action="/action_page.php">
			<label for="price" class="mr-sm-2">Precio:</label>
			<input min="0" value="0" type="number" class="form-control mb-2 mr-sm-2" id="price">
			<label for="ml" class="mr-sm-2">Cantidad (ml):</label>
			<input min="0" value="0" type="number" class="form-control mb-2 mr-sm-2" id="ml">
		</form>
		<div class="form-group">
			<label for="comment">Descripción:</label>
			<textarea class="form-control" rows="5" id="comment"></textarea>
		</div>
	</div>
</div>