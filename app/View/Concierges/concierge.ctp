<?php $this->start('scriptBottom');?> 
<?php echo $this->Html->script('jquery.autocomplete'); ?>
	<script>
		$(function(){
			$("#CourseQuery").autocomplete({
				serviceUrl: '/api/autocomplete',
			});
		});
	</script>
<?php $this->end(); ?> 
<div id="content" class="wrapper">
	<?php echo $this->Form->create("Course"); ?>
	<?php echo $this->Form->input("Course.query"); ?>
	<?php echo $this->Form->end("Find"); ?>
</div>
