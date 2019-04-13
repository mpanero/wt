<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TTypeActivity[]|\Cake\Collection\CollectionInterface $tTypeActivity
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New T Type Activity'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tTypeActivity index large-9 medium-8 columns content">
    <h3><?= __('T Type Activity') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID_ACTIVITY') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ACTIVITY_NAME') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ACTIVITY_NAME_EN') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ACTIVITY_NAME_PO') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tTypeActivity as $tTypeActivity): ?>
            <tr>
                <td><?= $this->Number->format($tTypeActivity->ID_ACTIVITY) ?></td>
                <td><?= h($tTypeActivity->ACTIVITY_NAME) ?></td>
                <td><?= h($tTypeActivity->ACTIVITY_NAME_EN) ?></td>
                <td><?= $this->Number->format($tTypeActivity->ACTIVITY_NAME_PO) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tTypeActivity->ID_ACTIVITY]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tTypeActivity->ID_ACTIVITY]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tTypeActivity->ID_ACTIVITY], ['confirm' => __('Are you sure you want to delete # {0}?', $tTypeActivity->ID_ACTIVITY)]) ?>
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
