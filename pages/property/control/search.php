<?php

include '/app/public/includes/Util.php';
require '/app/public/vendor/autoload.php';

use \App\Entity\Property;

if (!empty($_POST)) {

    $where = '';
    $dsTitle = FILTER_VAR(FILTER_INPUT(INPUT_POST, "dsTitle"));
    $dsAddress = FILTER_VAR(FILTER_INPUT(INPUT_POST, "dsAddress"));
    $nrPriceMin = FILTER_VAR(FILTER_INPUT(INPUT_POST, "nrPriceMin"), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $nrPriceMax = FILTER_VAR(FILTER_INPUT(INPUT_POST, "nrPriceMax"), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    if (!empty($dsTitle)) {
        $where .= " AND upper(ds_title) LIKE upper('%$dsTitle%')";
    }

    if (!empty($dsAddress)) {
        $where .= " AND upper(ds_address) LIKE upper('%$dsAddress%')";
    }

    if (!empty($nrPriceMin)) {
        $where .= " AND nr_price >= $nrPriceMin";
    }

    if (!empty($nrPriceMax)) {
        $where .= " AND nr_price <= $nrPriceMax";
    }


    $propertys = Property::getPropertys($where);
} else {
    $propertys = Property::getPropertys();
}

include '/app/public/includes/header.php';
include '/app/public/pages/property/consult.php';
include '/app/public/includes/footer.php';
