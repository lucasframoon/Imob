<?php

include '/app/public/includes/Util.php';
require '/app/public/vendor/autoload.php';

define('TITLE', 'Inserir Mídia');

use \App\Entity\Media;
use \App\Entity\Upload;

if (isset($_FILES['file'], $_POST['nmFile'])) {

    $upload = new Upload($_FILES['file']);


    $resultUpload = $upload->upload('/app/public/files');

    !$resultUpload['STATUS'] ? header(`location: /pages/media/control/search.php?status=${$resultUpload['MSG']}`) : null;


    $nmFile = FILTER_VAR(FILTER_INPUT(INPUT_POST, "nmFile"));
    $idProperty = FILTER_VAR(FILTER_INPUT(INPUT_POST, "idProperty"), FILTER_SANITIZE_NUMBER_INT);

    $media = new Media;

    $media->nm_file = $nmFile;

    if (!empty($idProperty)) {
        $media->id_property = $idProperty;
    }

    $media->ds_file_path = $resultUpload['PATH'];

    $media->insert();

    header('location: /pages/media/control/insert.php?status=success');
    exit;
}
include '/app/public/includes/header.php';
include '/app/public/pages/media/form.php';
include '/app/public/includes/footer.php';
