<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TPlace[]|\Cake\Collection\CollectionInterface $tPlaces
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New T Place'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tPlaces index large-9 medium-8 columns content">
    <h3><?= __('T Places') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID_PLACE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_PROVINCE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PLACE_NAME') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tPlaces as $tPlace): ?>
            <tr>
                <td><?= $this->Number->format($tPlace->ID_PLACE) ?></td>
                <td><?= $this->Number->format($tPlace->ID_PROVINCE) ?></td>
                <td><?= h($tPlace->PLACE_NAME) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tPlace->ID_PLACE]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tPlace->ID_PLACE]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tPlace->ID_PLACE], ['confirm' => __('Are you sure you want to delete # {0}?', $tPlace->ID_PLACE)]) ?>
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