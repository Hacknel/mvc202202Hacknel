<h1>Trabajar con Candidatos </h1>
<section>
</section>
<section>
  <table>
    <thead>
      <tr>
        <th>Id Candidato</th>
        <th>Identidad</th>
        <th>Nombre</th>
        <th>Edad</th>

        <th><a href="index.php?page=Mnt-Candidato&mode=INS">Nuevo</a></th>
      </tr>
    </thead>
    <tbody>
      {{foreach Candidatos}}
      <tr>
        <td>{{Idcandidato}}</td>
        <td> <a href="index.php?page=Mnt-Candidato&mode=DSP&id={{Idcandidato}}">{{Identidad}}</a></td>
        <td>{{Nombre}}</td>
        <td>{{Edad}}</td>

        <td>
          <a href="index.php?page=Mnt-Candidato&mode=UPD&id={{Idcandidato}}">Editar</a>
          &NonBreakingSpace;
          <a href="index.php?page=Mnt-Candidato&mode=DEL&id={{Idcandidato}}">Eliminar</a>
        </td>
      </tr>
      {{endfor Candidatos}}
    </tbody>
  </table>
</section>