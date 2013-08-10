<?php if (!empty($this->passedArgs)) {
	$this->Paginator->options(array('url' => $this->passedArgs));
}

if ($this->Paginator->counter(array('format' => '%count%')) > 0) { ?>
	<div class="paginationDiv">

		<ul>
			<?php // Numbers
			echo $this->Paginator->first('&laquo;', array('escape' => false, 'tag' => 'li'));
			echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li'));
			echo $this->Paginator->last('&raquo;', array('escape' => false, 'tag' => 'li')); ?>
		</ul>

		<div class="clear"><!-- --></div>
	</div>
<?php } ?>