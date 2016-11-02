<?php


if ($arResult['ITEMS']) {
    foreach ($arResult['ITEMS'] as &$itm) {
        if ($itm['PREVIEW_PICTURE']) {
            $itm['PREVIEW_PICTURE'] = CFile::ResizeImageGet($itm['PREVIEW_PICTURE'], array('width' => 150, 'height' => 100), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
        }
    }
}