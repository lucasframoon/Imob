<?php

include '/app/public/includes/Util.php';
require '/app/public/vendor/autoload.php';

define('TITLE_PROPERTY', 'Cadastrar Imóvel');

use \App\Entity\Property;

if (isset($_POST['dsTitle'], $_POST['nrPrice'], $_POST['dsAddress'], $_POST['dsDescription'])) {
    $dsTitle = FILTER_VAR(FILTER_INPUT(INPUT_POST, "dsTitle"));
    $nrPrice = FILTER_VAR(FILTER_INPUT(INPUT_POST, "nrPrice"), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $dsAddress = FILTER_VAR(FILTER_INPUT(INPUT_POST, "dsAddress"));
    $nrLat = FILTER_VAR(FILTER_INPUT(INPUT_POST, "nrLat"), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $nrLong = FILTER_VAR(FILTER_INPUT(INPUT_POST, "nrLong"), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $dsDescription = FILTER_VAR(FILTER_INPUT(INPUT_POST, "dsDescription"));

    $property = new Property;

    $property->ds_title = $dsTitle;
    $property->nr_price = str_replace(',', '.', $nrPrice);
    $property->ds_address = $dsAddress;
    $property->nr_lat = $nrLat;
    $property->nr_long = $nrLong;
    $property->ds_description = $dsDescription;

    $property->insert();

    header('location: /pages/property/control/insert.php?status=success');
    exit;
}
include '/app/public/includes/header.php';
include '/app/public/pages/property/form.php';
include '/app/public/includes/footer.php';
