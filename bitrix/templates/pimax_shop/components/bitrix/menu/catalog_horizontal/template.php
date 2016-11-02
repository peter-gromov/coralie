<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);

if (empty($arResult["ALL_ITEMS"]))
	return;

if (file_exists($_SERVER["DOCUMENT_ROOT"].$this->GetFolder().'/themes/'.$arParams["MENU_THEME"].'/colors.css'))
	$APPLICATION->SetAdditionalCSS($this->GetFolder().'/themes/'.$arParams["MENU_THEME"].'/colors.css');

$menuBlockId = "catalog_menu_".$this->randString();
?>
<ul class="navmenu center" id="ul_<?=$menuBlockId?>">
	<?foreach($arResult["MENU_STRUCTURE"] as $itemID => $arColumns):?>     <!-- first level-->
		<?$existPictureDescColomn = ($arResult["ALL_ITEMS"][$itemID]["PARAMS"]["picture_src"] || $arResult["ALL_ITEMS"][$itemID]["PARAMS"]["description"]) ? true : false;?>
		<li class="bx_hma_one_lvl <?if($arResult["ALL_ITEMS"][$itemID]["SELECTED"]):?>active<?endif?><?if (is_array($arColumns) && count($arColumns) > 0):?> sub-menu<?endif?>">
			<a href="<?=$arResult["ALL_ITEMS"][$itemID]["LINK"]?>" data-description="<?=$arResult["ALL_ITEMS"][$itemID]["PARAMS"]["description"]?>">
				<?=$arResult["ALL_ITEMS"][$itemID]["TEXT"]?>
			</a>
		<?if (is_array($arColumns) && count($arColumns) > 0):?>
			<i class="icon-mobile-menu-collapse icon-ld_accoridion_expand">+</i>
			<?foreach($arColumns as $key=>$arRow):?>
				<ul class="menu-dropdown mega_menu megamenu_col1 clearfix">
					<li class="col">
						<ol>
							<?foreach($arRow as $itemIdLevel_2=>$arLevel_3):?>  <!-- second level-->
								<li class="parent">
									<a href="<?=$arResult["ALL_ITEMS"][$itemIdLevel_2]["LINK"]?>" data-picture="<?=$arResult["ALL_ITEMS"][$itemIdLevel_2]["PARAMS"]["picture_src"]?>" data-description="<?=$arResult["ALL_ITEMS"][$itemIdLevel_2]["PARAMS"]["description"]?>">
										<?=$arResult["ALL_ITEMS"][$itemIdLevel_2]["TEXT"]?>
									</a>
								<?/*if (is_array($arLevel_3) && count($arLevel_3) > 0):?>
									<ul>
									<?foreach($arLevel_3 as $itemIdLevel_3):?>	<!-- third level-->
										<li>
											<a href="<?=$arResult["ALL_ITEMS"][$itemIdLevel_3]["LINK"]?>" <?if ($existPictureDescColomn):?>ontouchstart="document.location.href = '<?=$arResult["ALL_ITEMS"][$itemIdLevel_2]["LINK"]?>';return false;" onmouseover="menuCatalogChangeSectionPicure(this);return false;"<?endif?> data-picture="<?=$arResult["ALL_ITEMS"][$itemIdLevel_3]["PARAMS"]["picture_src"]?>" data-description="<?=$arResult["ALL_ITEMS"][$itemIdLevel_3]["PARAMS"]["description"]?>"><?=$arResult["ALL_ITEMS"][$itemIdLevel_3]["TEXT"]?></a>
										
										</li>
									<?endforeach;?>
									</ul>
								<?endif*/?>
								</li>
							<?endforeach;?>
							</ol>
						</li>
					</ul>
			<?endforeach;?>
		<?endif?>
		</li>
	<?endforeach;?>
	</ul>