<?php echo $this->element('trackingsite', array('result' => $result)); ?>
<?php echo $this->Form->create(); ?>
<?php echo $this->Form->input("Tracking.code"); ?>
<?php echo $this->Form->end("Track"); ?>