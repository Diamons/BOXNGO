<?php $this->start('css');
echo $this->Html->css('shops/shoplist');
$this->end();
$this->start('scriptBottom');
echo $this->Html->script(array('http://code.jquery.com/ui/1.10.3/jquery-ui.js','//api.filepicker.io/v1/filepicker.js', 'shops/shoplist'));
$this->end();
?>
<?php echo $this->Form->create('Shop', array('inputDefaults' => array('div' => false, 'label' => false))); ?>
<?php if(isset($edit)){ ?>
	<?php echo $this->Form->input("Shop.id", array("value" => $edit)); ?>
<?php } ?>
<div class="wrapper" id="content">
	<div style="margin-top: 10px;" class="header">
		<span class="step" style="background: url('/images/step1.png') no-repeat;"></span>
		<h3>Images</h3>
		Here you can upload pictures and show your items.
	</div>
	<div class="row">
		<div class="col-4 col-lg-4">
			<b>Add Images</b>
			<div id="imageTip" class="clearfix tip">
				<i class="icon-exclamation-sign"></i>
				You can change the order of your images and which image appears first by dragging them up and down!
			</div>
		</div>
		<div class="col-8 col-lg-8">
			<div id="uploadImages">
				<a href="#" id="upload">Upload Images</a>
				<?php //<div class="detail">Drag and Drop to rearrange the order in which your images appear.</div> ?>
				<?php echo $this->Form->textarea('Shop.images', array('style' => 'display:none;')); ?>
				<div draggable="true" id="editor" class="clearfix"></div>
			</div>
		</div>
	</div>
	<div class="header">
		<span class="step" style="background: url('/images/step2.png') no-repeat;"></span>
		<h3>List an Item for Sale</h3>
		Here you can list an item for sale.
	</div>
	<div class="row">
		<div class="col-4 col-lg-4"><b>Name</b><span class="detail">(What are you selling?)</span></div>
		<div class="col-8 col-lg-8"><?php echo $this->Form->input('Shop.name', array('class' => 'form-control')); ?></div>
	</div>	
	<div class="row">
		<div class="col-4 col-lg-4"><b>Select a Category</b><span class="detail">(Where does this belong?)</span></div>
		<div class="col-8 col-lg-8"><?php echo $this->Form->input('Shop.category_id', array('class' => 'form-control', 'empty' => true, 'options' => $categories)); ?></div>
	</div>
	<div class="row">
		<div class="col-4 col-lg-4"><b>Description</b></div>
		<div class="col-8 col-lg-8"><?php echo $this->Form->input('Shop.description', array('class' => 'form-control', 'type' => 'textarea')); ?></div>
	</div>
	
	<div class="header">
		<span class="step" style="background: url('/images/step3.png') no-repeat;"></span>
		<h3>Pricing and Shipping</h3>
		Here you can set your prices and other logistics.
	</div>	
	<div class="row">
		<div class="col-4 col-lg-4"><b>Quantity</b></div>
		<div class="col-8 col-lg-8">
			<?php
				echo $this->Form->input('Shop.quantity', array('class' => 'form-control', 'empty' => false, 'options' => array_combine(range(1,10,1), range(1,10,1))));
			?>
		</div>
	</div>	
	<div class="row">
		<div class="col-4 col-lg-4"><b>Selling Price</b><span class="detail">(How much would you like to charge?)</span>
		</div>
		<div class="col-8 col-lg-8">
			<div class="input-group">
				<span class="input-group-addon">$</span>
				<?php echo $this->Form->input('Shop.price', array('class' => 'form-control', 'type' => 'text', 'placeholder' => '10.00')); ?>
			</div>
		</div>
	</div>		
	<div class="row">
		<div class="col-4 col-lg-4"><b>Shipping Option</b></div>
		<div class="col-8 col-lg-8">
			<div class="radio"><?php 
				$options = array(0 => '<b>FREE</b> Shipping');
				$options2 = array(1 => 'Extra Charge');
				$attributes = array('default' => 0, 'legend' => false, 'label' => false); ?>
				<label onclick='$("#shipping").slideUp();' for="ShopShipping0">
					<?php echo $this->Form->radio('Shop.shipping', $options, $attributes); ?>
				</label>
			</div>
			<div class="radio">
				<label onclick='$("#shipping").slideDown();' for="ShopShipping1">
					<?php echo $this->Form->radio('Shop.shipping', $options2, $attributes); ?>
				</label>
			</div>
			  <div style="margin-top:5px; display:none;" id="shipping" class="row">
				<div class="input-group">
					<span class="input-group-addon">$</span>
					<?php 
						if(!isset($edit))
							echo $this->Form->input('Shop.shipping_price', array('class' => 'form-control', 'type' => 'text', 'value' => '5.00'));
						else
							echo $this->Form->input('Shop.shipping_price', array('class' => 'form-control', 'type' => 'text'));
					?>
				</div>
			  </div>
		</div>
	</div>	
	<section class="clearfix">
	<?php if(isset($edit)){ ?><a onclick="return confirm('Are you sure you want to delete this listing?');" class="deletebutton" href="<?php echo $this->webroot; ?>shops/deletelisting/<?php echo $edit; ?>">DELETE</a><?php } ?>	
	<?php if(isset($edit)){ ?><?php echo $this->Form->end('Save Changes', array('div' => false)); ?>
	<?php } else { ?><?php echo $this->Form->end('List it Now', array('div' => false)); ?><?php } ?>
	</section>
</div>
