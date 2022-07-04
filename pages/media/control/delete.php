<?php

include '/app/public/includes/Util.php';
require '/app/public/vendor/autoload.php';

use App\Entity\Upload;
use \App\Entity\Media;

if (!isset($_GET['id']) or !is_numeric(FILTER_VAR(FILTER_INPUT(INPUT_GET, "id"), FILTER_SANITIZE_NUMBER_INT))) {
    header('location: /pages/media/control/search.php?status=error');
    exit;
}

$media = Media::getMedia($_GET['id']);

//Não encontrou media com esse id
if (!$media instanceof Media) {

    header('location: /pages/media/control/search.php?status=error');
    exit;
} else {

    $media->delete();
    $a = Upload::deleteFile($media->ds_file_path);
    header('location: /pages/media/control/search.php?status=success');
    exit;
}

include '/app/public/includes/header.php';
include '/app/public/pages/media/confirmation.php';
include '/app/public/includes/footer.php';
