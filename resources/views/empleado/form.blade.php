<label for="Nombre">Nombre</label>
<input type="text" name="Nombre" value="{{ isset($empleado->nombre) ? $empleado->nombre : '' }}" id="Nombre">
<br>
<label for="Apellido">Apellido</label>
<input type="text" name="Apellido" value="{{ isset($empleado->apellido) ? $empleado->apellido : '' }}" id="Apellido">
<br>
<label for="Correo">Correo</label>
<input type="text" name="Correo" value="{{ isset($empleado->correo) ? $empleado->correo : '' }}" id="Correo">
<br>
<label for="Telefono">Teléfono</label>
<input type="number" name="Telefono" value="{{ isset($empleado->telefono) ? $empleado->telefono : '' }}" id="Telefono">
<br>
<label for="Foto">Foto</label>
@if(isset($empleado->Foto))
<img src="{{ asset('storage').'/'.$empleado->Foto }}" width="100" alt="">
@endif
<input type="file" name="Foto" id="Foto">
<br>
<input type="submit" value="Guardar">