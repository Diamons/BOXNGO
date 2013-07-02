<h1>Identify Unknown Schools</h1>
<?php if(!empty($schools)){ ?>
	<ul>
		<?php 
			for($i=0; $i < count($schools); $i++){ ?>
				<li><a href="/admin/editschools/<?php echo $schools[$i]; ?>"><?php echo $schools[$i]; ?></a></li>
		<?php } ?>
	</ul>
<?php } ?>

<?php echo $this->Form->create("School"); ?> 
<?php if(isset($schoolId)){ echo "<h3>Edit School Domain Info</h3>"; } else { echo "<h3>Add New School</h3>"; } ?>
<?php
	if(isset($schoolId))
		echo $this->Form->input('id', array('type' => 'hidden'));
?>
<?php echo $this->Form->input("School.latitude"); ?>
<?php echo $this->Form->input("School.longitude"); ?>
<?php echo $this->Form->input("School.domain"); ?>
<?php echo $this->Form->input("School.name"); ?>
<?php echo $this->Form->input("School.logo"); ?>
<?php echo $this->Form->end("Add School Info"); ?>