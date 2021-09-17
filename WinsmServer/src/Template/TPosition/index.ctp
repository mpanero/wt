<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TPosition[]|\Cake\Collection\CollectionInterface $tPosition
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New T Position'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tPosition index large-9 medium-8 columns content">
    <h3><?= __('T Position') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID_POSITION') ?></th>
                <th scope="col"><?= $this->Paginator->sort('POSITION') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DATE_POSITION') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_TYPE_PRICE_INFO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ACTIVE') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tPosition as $tPosition): ?>
            <tr>
                <td><?= $this->Number->format($tPosition->ID_POSITION) ?></td>
                <td><?= h($tPosition->POSITION) ?></td>
                <td><?= h($tPosition->DATE_POSITION) ?></td>
                <td><?= $this->Number->format($tPosition->ID_TYPE_PRICE_INFO) ?></td>
                <td><?= $this->Number->format($tPosition->ACTIVE) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tPosition->ID_POSITION]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tPosition->ID_POSITION]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tPosition->ID_POSITION], ['confirm' => __('Are you sure you want to delete # {0}?', $tPosition->ID_POSITION)]) ?>
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
