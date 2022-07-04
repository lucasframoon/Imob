<?php

include '/app/public/includes/Util.php';
require '/app/public/vendor/autoload.php';

use \App\Entity\Media;

if (!empty($_POST)) {

    $where = '';
    $nmFile = FILTER_VAR(FILTER_INPUT(INPUT_POST, "nmFile"));
    $dsTitleProperty = FILTER_VAR(FILTER_INPUT(INPUT_POST, "dsTitleProperty"));
    $dtUploadInitial = FILTER_VAR(FILTER_INPUT(INPUT_POST, "dtUploadInitial"));
    $dtUploadFinal = FILTER_VAR(FILTER_INPUT(INPUT_POST, "dtUploadFinal"));

    if (!empty($nmFile)) {
        $where .= " AND upper(m.nm_file) LIKE upper('%$nmFile%')";
    }

    if (!empty($dsTitleProperty)) {
        $where .= " AND id_property in (SELECT id_property FROM propertys where upper(ds_title) like upper('%" . $dsTitleProperty . "%')) ";
    }

    if (!empty($dtUploadInitial)) {
        $where .= " AND dt_upload <= '$dtUploadInitial" .  " 00:00:00 '";
    }

    if (!empty($dtUploadFinal)) {
        $where .= " AND dt_upload >= '$dtUploadFinal" .  " 23:59:59 '";
    }

    $medias = Media::getMedias($where);
} else {
    $medias = Media::getMedias();
}

include '/app/public/includes/header.php';
include '/app/public/pages/media/consult.php';
include '/app/public/includes/footer.php';
