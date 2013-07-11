<style>
	form{
		display: inline;
	}

	input[type="submit"].plainSubmit{
		margin: 0;
		float: none;
	}

	fieldset > div{
		padding: 10px;
	}

</style>
<h1>15th of this Month</h1>
<?php for($i = 0; $i < count($checkOrders2); $i++){ ?>
	<div class="row">
		<fieldset>
			<label>
				<?php echo $checkOrders2[$i][0]['User']['display_name']; ?>
			</label>
			<div class="invoice">Step 1: Verify the tracking codes are shipped <form target="_blank" action="https://tools.usps.com/go/TrackConfirmAction.action" method="POST">
					<input name="tLabels" type="hidden" value="9500110386053127585142,LC072304973US" />
					<input class="plainSubmit" type="submit" value="Verify Tracking Codes" />
				</form>
			</div> 
			//Need to make controller return aggregations
			<div>Step 2: Write the check</div>
			<div>
				
			</div>
		</fieldset>
		<?php echo $this->Html->link(__('Generate PDF Report'), array('action' => 'view', '1', 'ext' => 'pdf')); ?>
	</div>
<?php } ?>
