<?php

use \App\Entity\Property;

$propertys = Property::getPropertys();

$dropdownOptions = fillDropdown($propertys, 'id_property', 'ds_title', $media->id_property);

function getNmFileInServer($dsFilePath) //LCSTODO arrumar isso
{
  isset($dsFilePath) ? $nmFull = $dsFilePath : $nmFull = '';
  $nmFile = explode('/', $nmFull);
  $nmFile = end($nmFile);
  return $nmFile;
}

?>

<div id="main" class="container">
  <h3 class="page-header"><?=TITLE?></h3>
  <?=sendAlert();?>

  <form method="post" enctype="multipart/form-data">

    <div class="row">
      <div class="mb-3">
        <label for="file" class="form-label">Arquivo</label>
        <input class="form-control" type="file" name="file" <?= isset($media->ds_file_path) ? 'disabled' : '' ?>>
      </div>
    </div>

    <div class="row">
      <div class="form-group col-md-6">
        <label for="nmFile">Nome do arquivo</label>
        <input type="text" class="form-control" name="nmFile" value="<?= $media->nm_file ?>">
      </div>

      <div class="form-group col-md-6">
        <label for="idProperty">Imovel</label>
        <select class="form-select mb-3" aria-label="Default select example" name="idProperty">
          <option value="0" selected>Selecione o imovel</option>
          <?= $dropdownOptions ?>
        </select>
      </div>
    </div>

    <div class="row">
      <div id="actions" class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
        <button type="submit" class="btn btn-success shadow">Salvar</button>
        <a class="btn btn-light shadow" href="search.php">Voltar</a>
      </div>
    </div>

  </form>