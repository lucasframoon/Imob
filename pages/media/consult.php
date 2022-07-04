<?php

use \App\Entity\Property;

$propertys = Property::getPropertys();
$resultados = '';
foreach ($medias as $media) {

  $resultados .= '<tr>
                    <td>' . $media->nm_file . '</td>
                    <td>' . verifyPropertyName($media->id_property, $propertys) . '</td>
                    <td>' . formatDate($media->dt_upload) . '</td>
                    <td class="text-center">
                      <a href="edit.php?id=' . $media->id_media . '"><button type="button" class="btn btn-secondary shadow">Editar</button></a>
                      <a><button type="button"  idToDelete="' . $media->id_media . '" nameFile="' . $media->nm_file . '" class="btn btn-danger shadow" data-bs-toggle="modal" data-bs-target="#deleteModal">Excluir</button></a>
                    </td> 
                  </tr>';
}

$dropdownOptions = fillDropdown($propertys, 'id_property', 'ds_title', $media->id_property);

/**
 * Busca na lista de imóveis um match com o id passado como parâmetro
 * @param int $idProperty Associado a midia
 * @param array $property Array de imóveis
 * @return string nome do imóvel ou ''
 */
function verifyPropertyName($id = 0, $listProperty = null)
{

  if ($id == 0 || $listProperty == null) return '';

  foreach ($listProperty as $property) {
    if ($property->id_property == $id) {
      return $property->ds_title;
    }
  }
}

?>

<div id="main" class="container">
  <h3 class="page-header">Consulta de Mídias</h3>
  <?= sendAlert();?>

  <form action="search.php" method="post">

    <div class="row">
      <div class="form-group col-md-6">
        <label for="nmFile">Nome do arquivo</label>
        <input type="text" class="form-control" name="nmFile" value="<?= isset($nmFile) ? $nmFile : '' ?>">
      </div>

      <div class="form-group col-md-6">
        <label for="dsTitleProperty">Imovel</label>
        <select class="form-select mb-3" aria-label="Default select example" name="dsTitleProperty">
          <option value="0" selected>Selecione o imovel</option>
          <?= $dropdownOptions ?>
        </select>
      </div>

    </div>

    <div class="row">
      <div class="form-group col-md-3">
        <label for="dtUploadInitial" class="form-label">Data inicial</label>
        <input type="date" class="form-control" name="dtUploadInitial" value="<?= isset($dtUploadInitial) ? $dtUploadInitial : '' ?>">
      </div>

      <div class="form-group col-md-3">
        <label for="dtUploadFinal" class="form-label">Data final</label>
        <input type="date" class="form-control" name="dtUploadFinal" value="<?= isset($dtUploadFinal) ? $dtUploadFinal : '' ?>">
      </div>
    </div>

    <div id="actions" class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
      <button type="submit" class="btn btn-primary shadow">Buscar</button>
      <a class="btn btn-secondary shadow" href="insert.php">Novo</a>
    </div>

  </form>

  <section>
    <table class="table bg-light mt-3">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Imovel Associado</th>
          <th>Data de Upload</th>
          <th class="text-center">Ações</th>
        </tr>
      </thead>

      <tbody>
        <?= $resultados ?>
      </tbody>
    </table>
  </section>

  <!-- Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Excluir</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div id="modalBody" class="modal-body">
          Deseja excluir arquivo ?
        </div>
        <div class="modal-footer">
          <button type="button" id="modalCancelBtn" class="btn btn-light shadow" data-bs-dismiss="modal">Cancelar</button>
          <a id="modalConfirmBtn" href="/pages/media/control/delete.php?id=0" style="width: 40%;"><button type="button" class="btn btn-outline-danger shadow w-100">Excluir</button></a>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $(".btn.btn-danger").click(function() {
        $('#modalConfirmBtn').attr('href', `/pages/media/control/delete.php?id=${$(this).attr('idToDelete')}`);
        $('#modalBody').text(`Deseja excluir o media ${$(this).attr('nameProperty')} ?`);
      });

      $("#modalCancelBtn").click(function() {
        $('#modalConfirmBtn').attr('href', `/pages/media/control/delete.php?id=0`);
        $('#modalBody').text('');
      });
    });
  </script>