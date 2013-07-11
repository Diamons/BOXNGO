<div class="qualities form">
<?php echo $this->Form->create('Quality'); ?>
        <fieldset>
                <legend><?php echo __('Add Quality'); ?></legend>
        <?php
                echo $this->Form->input('auditor', array(
    'options' => array('admin' => 'Admin', 'author' => 'Author')
));
                echo $this->Form->input('advisor');
                echo $this->Form->input('contact_date');
                echo $this->Form->input('Comments');
        ?>
        </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
        <h3><?php echo __('Actions'); ?></h3>
        <ul>

                <li><?php echo $this->Html->link(__('List Qualities'), array('action' => 'index')); ?></li>
        </ul>
</div>