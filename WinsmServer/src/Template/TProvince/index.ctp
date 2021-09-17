<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TProvince[]|\Cake\Collection\CollectionInterface $tProvince
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New T Province'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tProvince index large-9 medium-8 columns content">
    <h3><?= __('T Province') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID_PROVINCE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PROVINCE_NAME') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_COUNTRY') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tProvince as $tProvince): ?>
            <tr>
                <td><?= $this->Number->format($tProvince->ID_PROVINCE) ?></td>
                <td><?= h($tProvince->PROVINCE_NAME) ?></td>
                <td><?= $this->Number->format($tProvince->ID_COUNTRY) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tProvince->ID_PROVINCE]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tProvince->ID_PROVINCE]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tProvince->ID_PROVINCE], ['confirm' => __('Are you sure you want to delete # {0}?', $tProvince->ID_PROVINCE)]) ?>
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
