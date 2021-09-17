<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TNotification[]|\Cake\Collection\CollectionInterface $tNotifications
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New T Notification'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tNotifications index large-9 medium-8 columns content">
    <h3><?= __('T Notifications') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID_NOTIF') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_TYPE_NOTIF') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_USER') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DESCRIPTION') ?></th>
                <th scope="col"><?= $this->Paginator->sort('READ_NOTIF') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DT_CREATED') ?></th>
                <th scope="col"><?= $this->Paginator->sort('COD_REF') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tNotifications as $tNotification): ?>
            <tr>
                <td><?= $this->Number->format($tNotification->ID_NOTIF) ?></td>
                <td><?= $this->Number->format($tNotification->ID_TYPE_NOTIF) ?></td>
                <td><?= $this->Number->format($tNotification->ID_USER) ?></td>
                <td><?= h($tNotification->DESCRIPTION) ?></td>
                <td><?= $this->Number->format($tNotification->READ_NOTIF) ?></td>
                <td><?= h($tNotification->DT_CREATED) ?></td>
                <td><?= h($tNotification->COD_REF) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tNotification->ID_NOTIF]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tNotification->ID_NOTIF]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tNotification->ID_NOTIF], ['confirm' => __('Are you sure you want to delete # {0}?', $tNotification->ID_NOTIF)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
