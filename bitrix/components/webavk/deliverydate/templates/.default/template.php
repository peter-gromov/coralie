<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<h2><?= GetMessage("WEBAVK_COMP_DELIVERY_DATE_HEADER") ?>:</h2>
<?
if (!empty($arResult['ITEMS'])) {
	?>
	<ul>
		<?
		foreach ($arResult['ITEMS'] as $arItem) {
			?>
			<li><?= $arItem['DATE_DELIVERY'] ?> (<?= $arItem['DELIVERY_NAME'] ?>)</li>
			<?
		}
		?>
	</ul>
	<?
} else {
	?>
	<p><?= GetMessage("WEBAVK_COMP_DELIVERY_DATE_UNDEFINED") ?></p>
	<?
}
?>
