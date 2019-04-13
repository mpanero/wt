<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TType[]|\Cake\Collection\CollectionInterface $tTypes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New T Type'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tTypes index large-9 medium-8 columns content">
    <h3><?= __('T Types') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID_TYPE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('TYPE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('INFO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ACTIVE') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tTypes as $tType): ?>
            <tr>
                <td><?= $this->Number->format($tType->ID_TYPE) ?></td>
                <td><?= h($tType->TYPE) ?></td>
                <td><?= h($tType->INFO) ?></td>
                <td><?= $this->Number->format($tType->ACTIVE) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tType->ID_TYPE]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tType->ID_TYPE]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tType->ID_TYPE], ['confirm' => __('Are you sure you want to delete # {0}?', $tType->ID_TYPE)]) ?>
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
