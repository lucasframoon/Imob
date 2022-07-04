<div id="main" class="container">

  <h3 class="page-header"><? TITLE ?></h3>
  <?= sendAlert();?>

  <form method="post">

    <div class="row">
      <div class="form-group col-md-7">
        <label for="dsTitle">Título</label>
        <input type="text" class="form-control" name="dsTitle" id="titlee" value="<?= isset($property) ? $property->ds_title : '' ?>">
      </div>
    </div>

    <div class="row">
      <div class="form-group col-md-3">
        <label for="nrPrice">Preço</label>
        <input type="number" min="0" step="any" class="form-control" name="nrPrice" value="<?= isset($property) ? $property->nr_price : '' ?>">
      </div>
    </div>

    <div class="row">
      <div class="form-group col-md-7">
        <label for="dsAddress">Endereço</label>
        <input type="hidden" name="nrLat" value="<?= isset($property) ? $property->nr_lat : '' ?>">
        <input type="hidden" name="nrLong" value="<?= isset($property) ? $property->nr_long : '' ?>">
        <input type="text" class="form-control" name="dsAddress" id="dsAddress" value="<?= isset($property) ? $property->ds_address : '' ?>">
      </div>
    </div>

    <div class="row">
      <div class="form-group">
        <label for="dsDescription">Descrição</label>
        <textarea class="form-control" name="dsDescription" rows="3"><?= isset($property) ? $property->ds_description : '' ?></textarea>
      </div>
    </div>

    <!-- <hr />   -->

    <div id="actions" class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
      <button type="submit" class="btn btn-success shadow">Salvar</button>
      <a class="btn btn-light shadow" href="search.php">Voltar</a>
    </div>
  </form>

  <script>
    $("input[name='nrPrice']").change(function() {
      var price = $("input[name='nrPrice']").val();
      var price_format = price.replaceAll(',', '')
      $("input[name='nrPrice']").val(price_format);
    });

    let autocomplete;

    function initAutocomplete() {

      autocomplete = new google.maps.places.Autocomplete(
        document.getElementById("dsAddress"), {
          componentRestrictions: {
            'country': ["BR"]
          },
          fields: ["geometry"]
        });

      autocomplete.addListener("place_changed", () => {

        place = autocomplete.getPlace()

        if (autocomplete.getPlace()) {
          $("input[name='nrLat']").val(place.geometry.location.lat())
          $("input[name='nrLong']").val(place.geometry.location.lng())
        }

      });

    }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places&callback=initAutocomplete" async></script>