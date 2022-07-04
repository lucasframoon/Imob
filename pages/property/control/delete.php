<?php

include '/app/public/includes/Util.php';
require '/app/public/vendor/autoload.php';

use \App\Entity\Property;


if (!isset($_GET['id']) or !is_numeric(FILTER_VAR(FILTER_INPUT(INPUT_GET, "id"), FILTER_SANITIZE_NUMBER_INT))) {
    header('location: /pages/property/control/search.php?status=error');
    exit;
}

$property = Property::getProperty($_GET['id']);

//Não encontrou property com esse id
if (!$property instanceof Property) {

    header('location: /pages/property/control/search.php?status=error');
    exit;
} else {

    $property->delete();
    header('location: /pages/property/control/search.php?status=success');
    exit;
}

include '/app/public/includes/header.php';
include '/app/public/pages/property/confirmation.php';
include '/app/public/includes/footer.php';
