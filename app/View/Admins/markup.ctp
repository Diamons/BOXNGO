<?php 
$this->start('scriptBottom');
	echo $this->Html->script(array('admin/markup'));
$this->end();
?>

<h1>Markup Calculator</h1>
<p class="subheader">This is for when you have a product on another site and list it on BOX'NGO. The following are <b>guidelines</b> and everything depends on a case by case scenario. This is only a calculator, choose the price that you think is best.</p>	

<?php echo $this->Form->create("Markup"); ?>
<div id="pricing_table">
	<div class="row">
		<div class="two columns"></div>
		<div class="four columns">What is the price on the other website? (Amazon, Etsy, etc.)</div>
		<div class="four columns"><?php echo $this->Form->input("Markup.price_on_other_site"); ?></div>
		<div class="two columns"></div>
	</div>
	<div class="row">
		<div class="two columns"></div>
		<div class="four columns">What is the markup? By default, it is 80%.</div>
		<div class="four columns"><?php echo $this->Form->input("Markup.markup", array("value" => ".8")); ?></div>
		<div class="two columns"></div>
	</div>
	<div class="row">
		<div class="two columns"></div>
		<div class="four columns">Total Price</div>
		<div class="four columns"><b id="totalprice">0</b></div>
		<div class="two columns"></div>
	</div>
	<div class="row">
		<div class="two columns"></div>
		<div class="four columns">BOX'NGO 10% Cut</div>
		<div class="four columns"><b id="boxngocut">0</b></div>
		<div class="two columns"></div>
	</div>
	<div class="row">
		<div class="two columns"></div>
		<div class="four columns">Stripe Fees</div>
		<div class="four columns"><b id="stripefees">0</b></div>
		<div class="two columns"></div>
	</div>
	<div class="row">
		<div class="two columns"></div>
		<div class="four columns">BOX'NGO Profit (10% cut - Stripe Fees)</div>
		<div class="four columns"><b id="boxngoprofit">0</b></div>
		<div class="two columns"></div>
	</div>
	<div class="row">
		<div class="two columns"></div>
		<div class="four columns">Seller Profit (Total - 10% BOX'NGO Fee)</div>
		<div class="four columns"><b id="sellerprofit">0</b></div>
		<div class="two columns"></div>
	</div>
</div>
<?php echo $this->Form->end(); ?>

<style>
	div.row b:before{
		content: '$';
	}
</style>