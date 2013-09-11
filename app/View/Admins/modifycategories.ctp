<h1>Modify Categories</h1>
<?php if(!empty($categories)){ ?>
	<ul>
		<?php 
			for($i=0; $i < count($categories); $i++){ ?>
				<li><a href="/admins/modifycategories/<?php echo $categories[$i]['Category']['id']; ?>"><?php echo $categories[$i]['Category']['display_name']; ?></a></li>
		<?php } ?>
	</ul>
<?php } ?>

<?php echo $this->Form->create("Category"); ?> 
<?php if(isset($category)){ echo "<h3>Edit Category</h3>"; } else { echo "<h3>Add New Category</h3>"; } ?>
<?php
	if(isset($category))
		echo $this->Form->input('id', array('type' => 'hidden'));
?>
<?php echo $this->Form->input("Category.display_name"); ?>
<span class="detail">For short names, use dashes, no spaces.</span>
<?php echo $this->Form->input("Category.short_name"); ?>
<?php if(isset($category)){ ?>
	<a onclick="return confirm('Are you sure you want to delete this category?');" class="deletebutton" href="/admin/modifycategories/<?php echo $this->request->data['Category']['id']; ?>/delete">DELETE</a>
<?php } ?>
<?php echo $this->Form->end("Add Category"); ?>
