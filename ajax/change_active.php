<?
define('STOP_STATISTICS', true);
define('NOT_CHECK_PERMISSIONS', true);
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
$APPLICATION->RestartBuffer();

CModule::IncludeModule('iblock');
// Принимаем json
$id = $_POST['id']; // id элемента в инфоблоке, где поменять активность
if(isset($id))
{    
	$ajaxFilter = array(
		'IBLOCK_ID' => 2, 
		'ID' => $id
		);
	$res = CIBlockElement::GetList(false, $ajaxFilter, array(
		'IBLOCK_ID',
		'ID',
		'ACTIVE'
		));
	$ajaxResult = $res->Fetch();
		
	$obEl = new CIBlockElement();
	if($ajaxResult['ACTIVE']=='Y')
		$boolResult = $obEl->Update($id, array('ACTIVE' => 'N'));
	else
		$boolResult = $obEl->Update($id, array('ACTIVE' => 'Y'));
}
die();
?>