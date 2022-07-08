<h1>{{mode_desc}}</h1>
<section>
  <form action="index.php?page=mnt_Candidato" method="post">
    <input type="hidden" name="mode" value="{{mode}}" />
    <input type="hidden" name="crsf_token" value="{{crsf_token}}" />
    <input type="hidden" name="Idcandidato" value="{{Idcandidato}}" />

    <fieldset>
      <label for="Identidad">Identidad</label>
      <input {{if readonly}} readonly {{endif readonly}} type="text" minlength="13" maxlength="13" id="Identidad" name="Identidad"
        placeholder="Identidad" value="{{Identidad}}" />
      {{if error_Identidad}}
      {{foreach error_Identidad}}
      <div class="error">{{this}}</div>
      {{endfor error_Identidad}}
      {{endif error_Identidad}}
    </fieldset>

    <fieldset>
      <label for="Nombre">Nombre</label>
      <input {{if readonly}} readonly {{endif readonly}} type="text" id="Nombre" name="Nombre" placeholder="Nombre"
        value="{{Nombre}}" />
      {{if error_Nombre}}
      {{foreach error_Nombre}}
      <div class="error">{{this}}</div>
      {{endfor error_Nombre}}
      {{endif error_Nombre}}
    </fieldset>

    <fieldset>
      <label for="Edad">Edad</label>
      <input {{if readonly}} readonly {{endif readonly}} type="number" min="18" max="100" id="Edad" name="Edad" placeholder="Edad"
        value="{{Edad}}" />
      {{if error_Edad}}
      {{foreach error_Edad}}
      <div class="error">{{this}}</div>
      {{endfor error_Edad}}
      {{endif error_Edad}}
    </fieldset>



    <!-- 
          <fieldset>    Descomentar en caso que la tabla tenga estados
            <label for="scoreest">Estado</label>
            <select name="scoreest" id="scoreest" {{if readonly}} readonly disabled {{endif readonly}}>
              {{foreach scoreestArr}}
              <option value="{{value}}" {{selected}}>{{text}}</option>
              {{endfor scoreestArr}}
            </select>
          </fieldset> 
          -->

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
  document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("btnCancelar").addEventListener("click", function (e) {
      e.preventDefault(); e.stopPropagation();
      window.location.href = "index.php?page=mnt_Candidatos";
    });
  });
</script>