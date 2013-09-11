<h2>Modify Existing Collection</h2>
<?php for($i = 0; $i < count($collections); $i++){ ?>
	<div>
		<a href="/admins/editcollection/<?php echo $collections[$i]['Collection']['id']; ?>"><?php echo $collections[$i]['Collection']['display_name']; ?></a>
	</div>
<?php } ?>

<?php echo $this->Form->create("Collection"); ?>
<h2>Create New Collection</h2>
<?php echo $this->Form->input("Collection.display_name"); ?>
<?php echo $this->Form->input("Collection.short_name"); ?>
<?php echo $this->Form->end("Save"); ?>
