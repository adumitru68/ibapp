<?php
/**
 * @var $template string
 * @var $data array
 */

use IB\Common\Views;

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Title</title>
	<link href="/bootstrap4/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="/bootstrap4/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css">
	<link href="/bootstrap4/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css">
</head>
<body>

<?= Views::loadView($template, $data) ?>

</body>
<script language="JavaScript" src="/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script language="JavaScript" src="/bootstrap4/js/bootstrap.min.js" type="text/javascript"></script>
<script language="JavaScript" src="/bootstrap4/js/bootstrap.bundle.min.js" type="text/javascript"></script>
</html>