<?php if(isset($result)){
	$url = "";
	$carrier = "";
	switch($result){
		case 'usps':
			$url = "https://tools.usps.com/go/TrackConfirmAction!input.action";
			$carrier = "USPS (UNITED STATES POSTAL SERVICE";
			break;
		case 'ups':
			$url = "http://www.ups.com/tracking/tracking.html";
			$carrier = "UPS";
			break;
		case 'fedex':
			$url = "http://www.fedex.com/fedextrack/";
			$carrier = "FedEx";
			break;
	}

	echo $this->Html->link($carrier, $url, array('target' => '_blank'));
} ?>
<?php echo $this->Form->create(); ?>
<?php echo $this->Form->input("Tracking.code"); ?>
<?php echo $this->Form->end("Track"); ?>