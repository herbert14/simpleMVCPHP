<h2>Listado de Categorias</h2>
<a href>Agregar Categoría</a>
<table style="margin:2em; width:90%">
    <tr>
        <th>
            Cod.
        </th>
        <th>
            Categoría
        </th>
        <th>
            Estado
        </th>
        <th>
            Acciones
        </th>
    </tr>
    {{foreach categorias}}
    <tr>
        <td>
            {{CatCod}}
        </td>
        <td>
            {{CatDsc}}
        </td>
        <td>
            {{CatEst}}
        </td>
        <td>
            <a href="index.php?page=categorias&mode=UPD&CatCod={{CatCod}}">Actualizar</a> |
            <a href="index.php?page=categorias&mode=DEL&CatCod={{CatCod}}">Eliminar</a>
        </td>
    </tr>
    {{endfor categorias}}
</table>
