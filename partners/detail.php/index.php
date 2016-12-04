<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>
<?$APPLICATION->SetTitle("Описание партнера");
?> 
<?CModule::IncludeModule('iblock');
?> 
<?
$arFilter = array(
	'IBLOCK_ID' => 5, 
	'ID' => ($_GET['ID']) );

$res = CIBlockElement::GetList(false, $arFilter, array(
	'IBLOCK_ID',
	'ID',
	'NAME',
	'PROPERTY_DESCRIPTION',
	'PROPERTY_CONDITION'
));

$arResult = $res->Fetch();

print $arResult['NAME'];?><br>
<?print $arResult['PROPERTY_DESCRIPTION_VALUE'];?><br>
<?print $arResult['PROPERTY_CONDITION_VALUE'];?>
<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>