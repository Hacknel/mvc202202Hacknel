

      <h1>Trabajar con Usuarios </h1>
      <section>
      </section>
      <section>
        <table>
          <thead>
            <tr>
<th>Email</th>
<th>Nombre de Usuario</th>
<th>Contraseña Expira</th>
<th>Estado</th>
<th>Tipo</th>

              <th><a href="index.php?page=Mnt-Usuario&mode=INS">Nuevo</a></th>
            </tr>
          </thead>
          <tbody>
            {{foreach Usuarios}}
            <tr>
              <td> <a href="index.php?page=Mnt-Usuario&mode=DSP&id={{usercod}}">{{useremail}}</a></td>
              <td>{{username}}</td>
<td>{{userpswdexp}}</td>
<td>{{userest}}</td>
<td>{{usertipo}}</td>

              <td>
                <a href="index.php?page=Mnt-Usuario&mode=UPD&id={{usercod}}">Editar</a>
                &NonBreakingSpace;
                <a href="index.php?page=Mnt-Usuario&mode=DEL&id={{usercod}}">Eliminar</a>
              </td>
            </tr>
            {{endfor Usuarios}}
          </tbody>
        </table>
      </section>
      