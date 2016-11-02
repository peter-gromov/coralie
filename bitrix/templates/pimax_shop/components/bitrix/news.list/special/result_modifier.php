<?php


if ($arResult['ITEMS']) {
    foreach ($arResult['ITEMS'] as &$itm) {
        if ($itm['PREVIEW_PICTURE']) {
            $itm['PREVIEW_PICTURE'] = CFile::ResizeImageGet($itm['PREVIEW_PICTURE'], array('width' => 700, 'height' => 350), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
        }

        if ($itm['PREVIEW_PICTURE_SECOND']) {
            $itm['PREVIEW_PICTURE_SECOND'] = CFile::ResizeImageGet($itm['PREVIEW_PICTURE_SECOND'], array('width' => 700, 'height' => 350), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
        }
    }
}