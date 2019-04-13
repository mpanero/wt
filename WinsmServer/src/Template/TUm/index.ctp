<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TUm[]|\Cake\Collection\CollectionInterface $tUm
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New T Um'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tUm index large-9 medium-8 columns content">
    <h3><?= __('T Um') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID_UM') ?></th>
                <th scope="col"><?= $this->Paginator->sort('UM_NAME') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_COUNTRY') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tUm as $tUm): ?>
            <tr>
                <td><?= $this->Number->format($tUm->ID_UM) ?></td>
                <td><?= h($tUm->UM_NAME) ?></td>
                <td><?= $this->Number->format($tUm->ID_COUNTRY) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tUm->ID_UM]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tUm->ID_UM]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tUm->ID_UM], ['confirm' => __('Are you sure you want to delete # {0}?', $tUm->ID_UM)]) ?>
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
