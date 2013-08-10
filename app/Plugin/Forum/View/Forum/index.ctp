<?php

$this->Breadcrumb->add(__d('forum', 'Forums'), array('action' => 'index'));

if ($forums) {
	foreach ($forums as $forum) { ?>

<div id="forum-<?php echo $forum['Forum']['id']; ?>">
	<div class="containerHeader">
		<h3><?php echo h($forum['Forum']['title']); ?></h3>
	</div>

	<div class="containerContent" id="forums-<?php echo $forum['Forum']['id']; ?>">
		<table cellspacing="0" class="table forums">
			<thead>
				<tr>
					<th colspan="2"><?php echo __d('forum', 'Forum'); ?></th>
					<th style="width: 10%"><?php echo __d('forum', 'Topics'); ?></th>
					<th style="width: 10%"><?php echo __d('forum', 'Posts'); ?></th>
					<th style="width: 30%"><?php echo __d('forum', 'Activity'); ?></th>
				</tr>
			</thead>
			<tbody>

			<?php if ($forum['Children']) {
				foreach ($forum['Children'] as $counter => $child) {
					echo $this->element('tiles/forum_row', array(
						'forum' => $child,
						'counter' => $counter
					));
				}
			} else { ?>

				<tr>
					<td colspan="5" class="empty"><?php echo __d('forum', 'There are no categories within this forum'); ?></td>
				</tr>

			<?php } ?>

			</tbody>
		</table>
	</div>
</div>

<?php } } ?>

<?php echo $this->element('login'); ?>