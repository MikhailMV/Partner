<?
$partnerIblockId = 5;
// из arParam[IBLOCK_ID] и arResult[VARIABLES][ELEMENT_CODE] получаем нужные значения
$iblock_id = $arParams['IBLOCK_ID']; // 2, инфоблок товаров
$element_code = $arResult['VARIABLES']['ELEMENT_CODE']; // символьный код товара

$arFilter = array(
	'IBLOCK_ID' => $iblock_id,        
	'CODE' => $element_code
	);    
$db_list = CIBlockElement::GetList(false, $arFilter, array(
	'IBLOCK_ID',
	'ID',    	
	'PROPERTY_PARTNER'
	));    
$ar_result = $db_list->Fetch();
$partnerId = $ar_result['PROPERTY_PARTNER_VALUE'];
unset($arFilter, $db_list, $ar_result);
    
// По значению элемента и инфоблоку партнера получаем описание и условия доставки
if ($partnerId)
{
	$arFilter = array(
		'IBLOCK_ID' => $partnerIblockId,        
		'ID' => $partnerId
		);    
	$db_list = CIBlockElement::GetList(false, $arFilter, array(
		'IBLOCK_ID',
		'ID',
		'NAME',
		'PROPERTY_DESCRIPTION',
		'PROPERTY_CONDITION'
		));
	$ar_result = $db_list->Fetch();
}

if ($ar_result['NAME'] and $ar_result['PROPERTY_DESCRIPTION_VALUE'] and $ar_result['PROPERTY_CONDITION_VALUE'])
{
	$arResult['PARTNER_NAME'] = $ar_result['NAME'];
	$arResult['PARTNER_DESCRIPTION'] = $ar_result['PROPERTY_DESCRIPTION_VALUE'];
	$arResult['PARTNER_CONDITION'] = $ar_result['PROPERTY_CONDITION_VALUE'];
}  
?>