<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TAlarm[]|\Cake\Collection\CollectionInterface $tAlarms
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New T Alarm'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tAlarms index large-9 medium-8 columns content">
    <h3><?= __('T Alarms') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID_ALARM') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_USER') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_PRODUCT') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_TYPE_PRICE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_MARKET') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PRICE_FROM') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PRICE_TO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ACTIVE') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tAlarms as $tAlarm): ?>
            <tr>
                <td><?= $this->Number->format($tAlarm->ID_ALARM) ?></td>
                <td><?= $this->Number->format($tAlarm->ID_USER) ?></td>
                <td><?= $this->Number->format($tAlarm->ID_PRODUCT) ?></td>
                <td><?= $this->Number->format($tAlarm->ID_TYPE_PRICE) ?></td>
                <td><?= $this->Number->format($tAlarm->ID_MARKET) ?></td>
                <td><?= $this->Number->format($tAlarm->PRICE_FROM) ?></td>
                <td><?= $this->Number->format($tAlarm->PRICE_TO) ?></td>
                <td><?= $this->Number->format($tAlarm->ACTIVE) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tAlarm->ID_ALARM]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tAlarm->ID_ALARM]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tAlarm->ID_ALARM], ['confirm' => __('Are you sure you want to delete # {0}?', $tAlarm->ID_ALARM)]) ?>
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
