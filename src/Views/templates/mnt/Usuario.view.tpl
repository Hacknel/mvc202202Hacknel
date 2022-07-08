
      <h1>{{mode_desc}}</h1>
      <section>
        <form action="index.php?page=mnt_Usuario" method="post">
          <input type="hidden" name="mode" value="{{mode}}" />
          <input type="hidden" name="crsf_token" value="{{crsf_token}}" />
          <input type="hidden" name="usercod" value="{{usercod}}" />

          <fieldset>
<label for="useremail">Email</label>
<input {{if readonly}} readonly {{endif readonly}} type="text" id="useremail" name="useremail" placeholder="Email" value="{{useremail}}" />
{{if error_useremail}}
{{foreach error_useremail}}
<div class="error">{{this}}</div>
{{endfor error_useremail}}
{{endif error_useremail}}
</fieldset>

<fieldset>
<label for="username">Nombre Usuario</label>
<input {{if readonly}} readonly {{endif readonly}} type="text" id="username" name="username" placeholder="Nombre de Usuario" value="{{username}}" />
{{if error_username}}
{{foreach error_username}}
<div class="error">{{this}}</div>
{{endfor error_username}}
{{endif error_username}}
</fieldset>

<fieldset>
<label for="userpswd">Contraseña</label>
<input {{if readonly}} readonly {{endif readonly}} type="text" id="userpswd" name="userpswd" placeholder="Contraseña" />
{{if error_userpswd}}
{{foreach error_userpswd}}
<div class="error">{{this}}</div>
{{endfor error_userpswd}}
{{endif error_userpswd}}
</fieldset>

<fieldset>   
  <label for="userest">Estado</label>
  <select name="userest" id="userest" {{if readonly}} readonly disabled {{endif readonly}}>
    {{foreach userestArr}}
    <option value="{{value}}" {{selected}}>{{text}}</option>
    {{endfor userestArr}}
  </select>
</fieldset> 

<fieldset>   
  <label for="usertipo">Tipo</label>
  <select name="usertipo" id="usertipo" {{if readonly}} readonly disabled {{endif readonly}}>
    {{foreach usertipoArr}}
    <option value="{{value}}" {{selected}}>{{text}}</option>
    {{endfor usertipoArr}}
  </select>
</fieldset>


          <fieldset>
            {{if showBtn}}
            <button type="submit" name="btnEnviar">{{btnEnviarText}}</button>
            &nbsp;
            {{endif showBtn}}
            <button name="btnCancelar" id="btnCancelar">Cancelar</button>
          </fieldset>
        </form>
      </section>
      <script>
        document.addEventListener("DOMContentLoaded", function(){ document.getElementById("btnCancelar").addEventListener("click", function(e){ e.preventDefault(); e.stopPropagation();
        window.location.href = "index.php?page=mnt_Usuarios"; }); });
      </script>
      