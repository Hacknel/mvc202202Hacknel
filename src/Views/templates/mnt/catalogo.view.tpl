<h1 class="center">Catálogo de Productos</h1>

<section>
    <form action="index.php?page=mnt_catalogo" method="post" class="row offset-3 col-6">
        <input type="hidden" name="crsf_token" value="{{crsf_token}}" />

        <fieldset class="row">
            <label class="col-4" for="invPrdDsc">Buscar: </label>
            <input class="col-8" type="text" id="invPrdDsc" name="invPrdDsc" placeholder="Descripción"
                value="{{invPrdDsc}}" />
        </fieldset>

        <fieldset class="row">
            <label class="col-4" for="doubleBasePrice">Precio Base: </label>
            <input class="col-8" type="number" id="doubleBasePrice" min="1" name="doubleBasePrice" placeholder="100"
                value="{{doubleBasePrice}}" />
        </fieldset>

        <fieldset class="row">
            <label class="col-4" for="doubleMaxPrice">Precio Máximo: </label>
            <input class="col-8" type="number" id="doubleMaxPrice" min="1" name="doubleMaxPrice" placeholder="500"
                value="{{doubleMaxPrice}}" />
        </fieldset>

        <fieldset class="row flex-center">
            <button type="submit" name="btnEnviar">Buscar</button>
            &nbsp;
            <button name="btnCancelar" id="btnCancelar">Cancelar</button>
        </fieldset>
    </form>
</section>

<section>
    <section class="grid" style="justify-content: center !important;">
    {{foreach Productos}}
      <div class="card" style="margin:20px">

      <div class="imgBox">
        <img src="{{invPrdImg}}"
          alt="No encontrado" class="mouse">
      </div>

      <div class="contentBox">
        <h3>{{invPrdDsc}}</h3>
        <h2 class="price">L. {{invPrdPrice}}</h2>
        <a href="index.php?page=Mnt-Producto&mode=DSP&id={{invPrdId}}" class="buy">Comprar</a>
      </div>

    </div>
    {{endfor Productos}}
  </section>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('btnCancelar').addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            window.location.href = 'index.php?page=mnt_catalogo';
        });
    });
</script>