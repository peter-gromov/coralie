<?php


if ($arResult['ITEMS']) {
    foreach ($arResult['ITEMS'] as &$itm) {
        if ($itm['PREVIEW_PICTURE']) {
            $itm['PREVIEW_PICTURE'] = CFile::ResizeImageGet($itm['PREVIEW_PICTURE'], array('width' => 350, 'height' => 170), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
        }
    }
}