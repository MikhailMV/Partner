<?global $USER;
// ѕровер€ем, что пользователь €вл€етс€ оператором хот€ бы у одного партнера
$isOperator = array();
if ($USER->GetID()) // ≈сли пользователь авторизован
{
	$arFilter = array(
		'IBLOCK_ID' => 5,
		'PROPERTY_OPERATOR' => $USER->GetID()     
		);
	$res = CIBlockElement::GetList(false, $arFilter, array(
		'IBLOCK_ID',
		'ID',    
		'NAME'
		));
	while ($ar_props = $res->Fetch())
	{
		$isOperator[$ar_props['ID']] = $ar_props['NAME'];
	}
}

foreach($isOperator as $key => $value)
{
	$arResult['PARTNER'][$key] = $value;
}

// ¬ыбираем товары по id партнера
$partnerGoods = array();
foreach($arResult['PARTNER'] as $partnerId => $partnerName)
{
	$arFilter = array(
		'IBLOCK_ID' => 2,        
		'PROPERTY_PARTNER' => $partnerId
		);    
	$db_list = CIBlockElement::GetList(false, $arFilter, array(
		'IBLOCK_ID',
		'ID',    	
		'NAME'
		));
	while($ar_result = $db_list->Fetch())
	{
		$partnerGoods[$partnerId][] = $ar_result['ID'];
	}
}
$filterItems = array();
foreach($arResult["ITEMS"] as $itemDescription)
{    
	foreach($partnerGoods as $partnerId => $itemsList)
	{        
		foreach ($itemsList as $itemId)
		{            
			if($itemDescription['ID'] == $itemId)
			{
				$itemDescription["PARTNER_ID"] = $partnerId;
				$filterItems[] = $itemDescription;
			}
		}
	} 
}
$arResult["ITEMS"] = $filterItems;
?>