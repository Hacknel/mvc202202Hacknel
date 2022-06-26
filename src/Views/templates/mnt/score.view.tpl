<h1>{{mode_desc}}</h1>
<section>
  <form action="index.php?page=mnt_score" method="post">
    <input type="hidden" name="mode" value="{{mode}}" />
    <input type="hidden" name="crsf_token" value="{{crsf_token}}" />
    <input type="hidden" name="scoreid" value="{{scoreid}}" />
    <fieldset>
      <label for="scoredsc">Descripción del Score</label>
      <input {{if readonly}}readonly{{endif readonly}} type="text" id="scoredsc" name="scoredsc" placeholder="Descripción del Score" value="{{scoredsc}}"/>
      {{if error_scoredsc}}
        {{foreach error_scoredsc}}
          <div class="error">{{this}}</div>
        {{endfor error_scoredsc}}
      {{endif error_scoredsc}}
    </fieldset>
    <fieldset>
      <label for="scoreauthor">Autor del Score</label>
      <input {{if readonly}}readonly{{endif readonly}} type="text" id="scoreauthor" name="scoreauthor" placeholder="Autor del Score" value="{{scoreauthor}}" />
      {{if error_scoreauthor}}
        {{foreach error_scoreauthor}}
          <div class="error">{{this}}</div>
        {{endfor error_scoreauthor}}
      {{endif error_scoreauthor}}
    </fieldset>
    <fieldset>
      <label for="scoregenre">Estado</label>
      <select name="scoregenre" id="scoregenre" {{if readonly}}readonly disabled{{endif readonly}}>
        {{foreach scoregenreArr}}
        <option value="{{value}}" {{selected}}>{{text}}</option>
        {{endfor scoregenreArr}}
      </select>
    </fieldset>
    <fieldset>
      <label for="scoreyear">Año</label>
      <input {{if readonly}}readonly{{endif readonly}} type="number" max="2022" min="1650" id="scoreyear" name="scoreyear" placeholder="Año" value="{{scoreyear}}" />
      {{if error_scoreyear}}
          {{foreach error_scoreyear}}
            <div class="error">{{this}}</div>
          {{endfor error_scoreyear}}
      {{endif error_scoreyear}}
    </fieldset>
    <fieldset>
      <label for="scoresales">Ventas</label>
      <input {{if readonly}}readonly{{endif readonly}} type="number" min="0" id="scoresales" name="scoresales" placeholder="Ventas" value="{{scoresales}}" />
      {{if error_scoresales}}
          {{foreach error_scoresales}}
            <div class="error">{{this}}</div>
          {{endfor error_scoresales}}
      {{endif error_scoresales}}
    </fieldset>
    <fieldset>
      <label for="scoreprice">Precio</label>
      <input {{if readonly}}readonly{{endif readonly}} type="number" min="0" id="scoreprice" name="scoreprice" placeholder="Precio" value="{{scoreprice}}" />
      {{if error_scoreprice}}
          {{foreach error_scoreprice}}
            <div class="error">{{this}}</div>
          {{endfor error_scoreprice}}
      {{endif error_scoreprice}}
    </fieldset>
    <fieldset>
      <label for="scoredocurl">URL Documento</label>
      <input {{if readonly}}readonly{{endif readonly}} type="text" id="scoredocurl" name="scoredocurl" placeholder="URL" value="{{scoredocurl}}" />
      {{if error_scoredocurl}}
          {{foreach error_scoredocurl}}
            <div class="error">{{this}}</div>
          {{endfor error_scoredocurl}}
      {{endif error_scoredocurl}}
    </fieldset>
    <fieldset>
      <label for="scoreest">Estado de score</label>
      <select name="scoreest" id="scoreest" {{if readonly}}readonly disabled{{endif readonly}}>
        {{foreach scoreestArr}}
          <option value="{{value}}" {{selected}}>{{text}}</option>
        {{endfor scoreestArr}}
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
  document.addEventListener('DOMContentLoaded', function(){
    document.getElementById('btnCancelar').addEventListener('click', function(e){
      e.preventDefault();
      e.stopPropagation();
      window.location.href = 'index.php?page=mnt_scores';
    });
  });
</script>
