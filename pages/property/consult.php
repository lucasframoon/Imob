<?php

$result = '';
foreach ($propertys as $property) {

  $result .= '<tr>
                        <td>' . $property->ds_title . '</td>
                        <td class="tdAddress">' . $property->ds_address . '</td>
                        <td>' . $property->nr_price . '</td>
                        
                        <td>' . formatDate($property->dt_insert_date) . '</td>
                        <td class="text-center">
                            <a> <button type="button"  nrLat="' . $property->nr_lat . '" nrLong="' . $property->nr_lat . '" nameProperty="' . $property->ds_title . '" class="btn btn-info shadow" data-bs-toggle="modal" data-bs-target="#mapModal">Mapa</button></a>
                            <a href="edit.php?id=' . $property->id_property . '"><button type="button" class="btn btn-secondary shadow">Editar</button></a>
                            <a> <button type="button"  idToDelete="' . $property->id_property . '" nameProperty="' . $property->ds_title . '" class="btn btn-danger shadow" data-bs-toggle="modal" data-bs-target="#deleteModal">Excluir</button></a>
                            </td> 
                            </tr>';
}
?>

<div id="main" class="container">
  <h3 class="page-header">Consulta de Imóvel</h3>
  <?= sendAlert();?>

  <form action="search.php" method="post">

    <div class="row">
      <div class="form-group col-md-4">
        <label for="dsTitle">Título</label>
        <input type="text" class="form-control" name="dsTitle" value="<?= isset($dsTitle) ? $dsTitle  : '' ?>">
      </div>

      <div class="form-group col-md-4">
        <label for="dsAddress">Endereço</label>
        <input type="text" class="form-control" name="dsAddress" value="<?= isset($dsAddress) ? $dsAddress : '' ?>">
      </div>

      <div class="form-group col-md-2">
        <label for="nrPriceMin">Preço Mínimo</label>
        <input type="number" min="0" step="any" class="form-control" name="nrPriceMin" value="<?= isset($nrPriceMin) ? $nrPriceMin : '' ?>">
      </div>

      <div class="form-group col-md-2">
        <label for="nrPriceMax">Preço Máximo</label>
        <input type="number" min="0" step="any" class="form-control" name="nrPriceMax" value="<?= isset($nrPriceMax) ? $nrPriceMax : '' ?>">
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
          <th>Titulo</th>
          <th class="thAddress">Endereço</th>
          <th>Preço</th>
          <!-- <th>Descrição</th> -->
          <th>Data de Upload</th>
          <th class="text-center">Ações</th>
        </tr>
      </thead>

      <tbody>
        <?= $result ?>
      </tbody>
    </table>
  </section>

  <!-- DELETE MODAL -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true"> -->
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Excluir</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div id="modalBody" class="modal-body">
          Deseja excluir o imovel ?
        </div>
        <div class="modal-footer">
          <button type="button" id="deleteModalCancelBtn" class="btn btn-light shadow" data-bs-dismiss="modal">Cancelar</button>
          <a id="modalConfirmBtn" href="/pages/property/control/delete.php?id=0" style="width: 40%;"><button type="button" class="btn btn-outline-danger shadow w-100">Excluir</button></a>
        </div>
      </div>
    </div>
  </div>

  <!-- MAP MODAL -->
  <div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="mapModalLabel"></h5>
        </div>
        <div id="modalBody" class="modal-body" style="height: 500px;">
          <div id="map"></div>
        </div>
        <div class="modal-footer">
          <button type="button" id="deleteModalCancelBtn" class="btn btn-light shadow" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {

      //Excluir
      $(".btn.btn-danger").click(function() {
        $('#modalConfirmBtn').attr('href', `/pages/property/control/delete.php?id=${$(this).attr('idToDelete')}`);
        $('#modalBody').text(`Deseja excluir o imovel ${$(this).attr('nameProperty')} ?`);
      });

      $("#deleteModalCancelBtn").click(function() {
        $('#modalConfirmBtn').attr('href', `/pages/property/control/delete.php?id=0`);
        $('#modalBody').text('');
      });

      //MAPA
      $(".btn.btn-info").click(function() {
        initMap($(this).attr('nrLat'), $(this).attr('nrLong'))
        $('#mapModalLabel').text($(this).attr('nameProperty'));
      });

      $("#mapModalCancelBtn").click(function() {
        $("#map").empty();
        $('#mapModalLabel').text('');
      });


    });

    function initMap(latitude = null, longitude = null) {
      if (latitude == null && longitude == null) return false;

      const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 4,
        center: {
          lat: parseFloat(latitude),
          lng: parseFloat(longitude)
        },
      });

      const marker = new google.maps.Marker({
        position: {
          lat: parseFloat(latitude),
          lng: parseFloat(longitude)
        },
        map: map,
      });

    }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&v=weekly" defer></script>