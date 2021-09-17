<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TNotification $tNotification
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tNotification->ID_NOTIF],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tNotification->ID_NOTIF)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List T Notifications'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tNotifications form large-9 medium-8 columns content">
    <?= $this->Form->create($tNotification) ?>
    <fieldset>
        <legend><?= __('Edit T Notification') ?></legend>
        <?php
            echo $this->Form->control('ID_TYPE_NOTIF');
            echo $this->Form->control('ID_USER');
            echo $this->Form->control('DESCRIPTION');
            echo $this->Form->control('READ_NOTIF');
            echo $this->Form->control('DT_CREATED');
            echo $this->Form->control('COD_REF');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
