<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?><?$APPLICATION->SetTitle("Товары партнера");
?> <?CModule::IncludeModule('iblock');
?> <?

// Выводим товары списком новостей
GLOBAL $arrFilter; // Фильтр при выводе новостей
if (!is_array($arrFilter))
	$arrFilter = array();
$arrFilter['PROPERTY_PARTNER'] = $_GET['ID'];
$arrFilter['ACTIVE'] = array("Y","N");

if(isset($_GET['change']))
{
	$arFilter = array(
		'IBLOCK_ID' => 2, 
		'ID' => ($_GET['change'])
		);
	$res = CIBlockElement::GetList(false, $arFilter, array(
		'IBLOCK_ID',
		'ID',
		'ACTIVE'
		));
	$arResult = $res->Fetch();

	$obEl = new CIBlockElement();
	if($arResult['ACTIVE']=='Y')
		$boolResult = $obEl->Update($_GET['change'],array('ACTIVE' => 'N'));
	else
		$boolResult = $obEl->Update($_GET['change'],array('ACTIVE' => 'Y'));    
}

// Проверяем, соответствует ли партнер оператору
$arFilter = array(
	'IBLOCK_ID' => 5, 
	'ID' => ($_GET['ID']) );

$res = CIBlockElement::GetList(false, $arFilter, array(
	'IBLOCK_ID',
	'ID',    
	'PROPERTY_OPERATOR'
));

$arResult = $res->Fetch();

if ($arResult['PROPERTY_OPERATOR_VALUE'] == $_SESSION['SESS_AUTH']['USER_ID']):
?><?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "N",
		"DETAIL_URL" => $_SERVER['REQUEST_URI']."&change=#ELEMENT_ID#",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("ACTIVE",""),
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
);?> <?else: print "Доступ запрещен!";
endif;
?> <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>