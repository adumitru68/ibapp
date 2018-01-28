<?php
/** @var $forms \IB\Modules\Forms\FormsModel[] */
$displayNone = '';
if(count($forms))
	$displayNone = "style=\"display:none\"";

?>

<ul class="list-group list-group-flush">
	<?php
	foreach ( $forms as $form ){
		$id = 'form_' . $form->getId();
		$name = $form->getName();
		echo "<li id=\"$id\" class=\"list-group-item small p-2 form-item\">$name</li>";
	}

	?>
</ul>
<span class="small p-2" <?=$displayNone?>>Not found</span>

<script>
	formsAdminService.bindListEvents();
</script>
