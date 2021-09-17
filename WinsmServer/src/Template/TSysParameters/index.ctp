<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TSysParameter[]|\Cake\Collection\CollectionInterface $tSysParameters
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New T Sys Parameter'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tSysParameters index large-9 medium-8 columns content">
    <h3><?= __('T Sys Parameters') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID_PARAMETER') ?></th>
                <th scope="col"><?= $this->Paginator->sort('NAME_PARAMETER') ?></th>
                <th scope="col"><?= $this->Paginator->sort('VALUE_PARAMETER') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tSysParameters as $tSysParameter): ?>
            <tr>
                <td><?= $this->Number->format($tSysParameter->ID_PARAMETER) ?></td>
                <td><?= h($tSysParameter->NAME_PARAMETER) ?></td>
                <td><?= h($tSysParameter->VALUE_PARAMETER) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tSysParameter->ID_PARAMETER]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tSysParameter->ID_PARAMETER]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tSysParameter->ID_PARAMETER], ['confirm' => __('Are you sure you want to delete # {0}?', $tSysParameter->ID_PARAMETER)]) ?>
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
