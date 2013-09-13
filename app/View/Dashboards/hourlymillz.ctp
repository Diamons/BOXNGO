<?php
$this->start('css');
echo $this->Html->css(array('dashboard/hourlymillz'));
$this->end();
$this->start('scriptBottom');
echo $this->Html->script(array('jquery.slots', 'dashboard/hourlymillz'));
$this->end();
?>
<div>
    <ul class="slot">
        
        <li>1</li>
        <li>2</li>
        <li>3</li>
        <li>4</li>
        <li>5</li>
        <li>6</li>
        <li>7</li>
        <li>8</li>
        <li>9</li>
        <li>0</li>
    </ul>
    <input id="start" type="hidden" />
    <div class="alert alert-success" id="done">Congratulations on your spin! Your next spin will be available in <b>1 hour.</b> These Millz have automatically been added to your account.</div>
</div>
