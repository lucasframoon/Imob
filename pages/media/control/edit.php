<?php

include '/app/public/includes/Util.php';
require '/app/public/vendor/autoload.php';

define('TITLE_MEDIA', 'Editar Mídia');

use \App\Entity\Media;

if (!isset($_GET['id']) || !is_numeric(FILTER_VAR(FILTER_INPUT(INPUT_GET, "id"), FILTER_SANITIZE_NUMBER_INT))) {
    header('location: /pages/media/control/search.php?status=error');
    exit;
}

$media = Media::getMedia($_GET['id']);

//Não encontrou media com esse id
if (!$media instanceof Media) {
    header('location: /pages/media/control/search.php?status=error');
    exit;
}

if (isset($_POST['nmFile'], $_POST['idProperty'])) {

    $nmFile = FILTER_VAR(FILTER_INPUT(INPUT_POST, "nmFile"));
    $idProperty = FILTER_VAR(FILTER_INPUT(INPUT_POST, "idProperty"), FILTER_SANITIZE_NUMBER_INT);

    $media->nm_file = $nmFile;
    $media->id_property = $idProperty;

    $media->update();

    header('location:/pages/media/control/edit.php?status=success');
    exit;
}

include '/app/public/includes/header.php';
include '/app/public/pages/media/form.php';
include '/app/public/includes/footer.php';
