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
					$(this).delay(5000).removeClass('loading');
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
	<div style="background: url('/images/schools/concierge/huntercollege.png')" class="concierge_image">
		<?php echo $this->Form->create("Course", array("id" => "ConciergeSearch", "class" => "custom", "inputDefaults" => array("label" => false))); ?>
		<div class="row">
			<div class="col-xs-10 col-md-10"><?php echo $this->Form->input("Course.query", array("placeholder" => "Search by section, description, and even  professor!")); ?><?php echo $this->Form->input("Course.course_number", array("style" => "display: none;")); ?></div>
			<div class="col-xs-2 col-md-2"><?php echo $this->Form->submit("Find my Class"); ?></div>
		</div>
		<div class="try">Try it Out: <a href="/concierges/hunter_college/0023">AFPRL 236.00 Section 001 - African Amer Lit with Professor Gregg, Veronica
</a></div>
		<?php echo $this->Form->end(); ?>
		
	</div>
</div>
