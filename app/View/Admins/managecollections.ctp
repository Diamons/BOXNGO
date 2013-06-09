<h2>Modify Existing Collection</h2>
<?php for($i = 0; $i < count($collections); $i++){ ?>
	<div>
		<a href="/admin/editcollection/<?php echo $collections[$i]['Collection']['id']; ?>"><?php echo $collections[$i]['Collection']['name']; ?></a>
	</div>
<?php } ?>

<?php echo $this->Form->create("Collection"); ?>
<h2>Create New Collection</h2>