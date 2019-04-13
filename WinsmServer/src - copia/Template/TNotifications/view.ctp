<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TNotification $tNotification
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit T Notification'), ['action' => 'edit', $tNotification->ID_NOTIF]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete T Notification'), ['action' => 'delete', $tNotification->ID_NOTIF], ['confirm' => __('Are you sure you want to delete # {0}?', $tNotification->ID_NOTIF)]) ?> </li>
        <li><?= $this->Html->link(__('List T Notifications'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Notification'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tNotifications view large-9 medium-8 columns content">
    <h3><?= h($tNotification->ID_NOTIF) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('DESCRIPTION') ?></th>
            <td><?= h($tNotification->DESCRIPTION) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID NOTIF') ?></th>
            <td><?= $this->Number->format($tNotification->ID_NOTIF) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID TYPE NOTIF') ?></th>
            <td><?= $this->Number->format($tNotification->ID_TYPE_NOTIF) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID USER') ?></th>
            <td><?= $this->Number->format($tNotification->ID_USER) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('READ') ?></th>
            <td><?= $this->Number->format($tNotification->READ) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DT CREATED') ?></th>
            <td><?= h($tNotification->DT_CREATED) ?></td>
        </tr>
    </table>
</div>
