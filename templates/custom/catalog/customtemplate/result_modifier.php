<?
$partnerIblockId = 5;
// �� arParam[IBLOCK_ID] � arResult[VARIABLES][ELEMENT_CODE] �������� ������ ��������
$iblock_id = $arParams['IBLOCK_ID']; // 2, �������� �������
$element_code = $arResult['VARIABLES']['ELEMENT_CODE']; // ���������� ��� ������

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
    
// �� �������� �������� � ��������� �������� �������� �������� � ������� ��������
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