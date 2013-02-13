<?php $this->start('scriptBottom');?> 
<?php echo $this->Html->script('jquery.autocomplete'); ?>
	<script>
		$(function(){
			$("#CourseQuery").autocomplete({
				serviceUrl: '/api/autocomplete',
				minChars: 3,
				onSearchStart: function(){
					$(this).addClass('loading');
				},
				onSearchComplete: function(){
					$(this).removeClass('loading');
				},
				onSelect: function(result){
					$("#CourseCourseNumber").val(result.data);
				}
			});
		});
	</script>
<?php $this->end(); ?>
<?php echo $this->start('css');
echo $this->Html->css(array('concierges/concierge'));
$this->end();
?> 
<div id="content" class="wrapper">
	<?php echo $this->Form->create("Course"); ?>
	<?php echo $this->Form->input("Course.query"); ?>
	<?php echo $this->Form->input("Course.course_number", array("label" => false, "style" => "display: none;")); ?>
	<?php echo $this->Form->end("Find"); ?>
</div>
