<?php $this->start('scriptBottom');
echo $this->Html->script(array('admin/editcollection'));
$this->end(); ?>
<h1>Modifying Collection: <?php echo $collection['Collection']['display_name']; ?></h1>
<h3>Add to the Collection</3>
Use the ID #s of the listings, one per field

<?php echo $this->Form->create("CollectionItem"); ?>
<?php echo $this->Form->input("CollectionItem.shop_id", array('label' => 'Shop ID# Separated by Commas Example: (1,2,3,4) NO SPACES', 'type' => 'text')); ?>
<?php echo $this->Form->end("Save"); ?>