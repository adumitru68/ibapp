<?php
/**
 * @var $content string
 * @var $page \IB\Modules\Pages\PageGenerator
 */
if(empty($markup))
	$content='';
if(empty($pageTitle))
	$pageTitle = 'Title';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?=$pageTitle?></title>
	<link href="/bootstrap4/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="/bootstrap4/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css">
	<link href="/bootstrap4/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css">
	<link href="/css/select2.min.css" rel="stylesheet" />

	<script language="JavaScript" src="/js/jquery-3.2.1.min.js" type="text/javascript"></script>
	<script language="JavaScript" src="/js/select2.min.js" type="text/javascript"></script>
	<script language="JavaScript" src="/bootstrap4/js/bootstrap.min.js" type="text/javascript"></script>
	<script language="JavaScript" src="/bootstrap4/js/bootstrap.bundle.min.js" type="text/javascript"></script>
</head>
<body>

<?=$markup?>

</body>
</html>