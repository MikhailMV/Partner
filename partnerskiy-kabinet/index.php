<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Партнерский кабинет"); 

global $USER;
// Проверяем, что пользователь является оператором хотя бы у одного партнера
$isOperator = array();
if ($USER->GetID()) // Если пользователь авторизован
{
	$arFilter = array(
		'IBLOCK_ID' => 5,
	'PROPERTY_OPERATOR' => $USER->GetID()     
		);
	$res = CIBlockElement::GetList(false, $arFilter, array(
		'IBLOCK_ID',
		'ID',    
		'PROPERTY_OPERATOR'
	));
	while ($ar_props = $res->Fetch())
	{
		$isOperator[] = $ar_props['ID'];
	}
}
// Фильтруем товары в инфоблоке   
	$arFilter = array(
		'IBLOCK_ID' => 2,
		'PROPERTY_PARTNER' => $isOperator     
		);
	$res = CIBlockElement::GetList(false, $arFilter, array(
		'IBLOCK_ID',
		'ID',
	));
	while ($ar_props = $res->Fetch())
	{
		$itemsList[] = $ar_props['ID'];            
	}

if ($isOperator): 

GLOBAL $arrFilter;
if (!is_array($arrFilter))
	$arrFilter = array();
$arrFilter['ACTIVE'] = array("Y","N");
$arrFilter['ID'] = $itemsList;
?><?$APPLICATION->IncludeComponent(
	"custom:news.list",
	"kabinet",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("","ACTIVE",""),
		"FILTER_NAME" => "arrFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array("",""),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?><br><?else: print "Доступ запрещен!";
endif;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>