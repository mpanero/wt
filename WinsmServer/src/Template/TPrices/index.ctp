<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TPrice[]|\Cake\Collection\CollectionInterface $tPrices
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New T Price'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tPrices index large-9 medium-8 columns content">
    <h3><?= __('T Prices') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_TYPE_PRICE_INFO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_PRODUCT') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DATE_PRICE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_PLACE_PRICE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PRICE_VALUE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_TYPE_CURRENCY') ?></th>
                <th scope="col"><?= $this->Paginator->sort('VAR') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_POSITION') ?></th>
                <th scope="col"><?= $this->Paginator->sort('UPDATED') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tPrices as $tPrice): ?>
            <tr>
                <td><?= $this->Number->format($tPrice->ID) ?></td>
                <td><?= $this->Number->format($tPrice->ID_TYPE_PRICE_INFO) ?></td>
                <td><?= $this->Number->format($tPrice->ID_PRODUCT) ?></td>
                <td><?= h($tPrice->DATE_PRICE) ?></td>
                <td><?= $this->Number->format($tPrice->ID_PLACE_PRICE) ?></td>
                <td><?= $this->Number->format($tPrice->PRICE_VALUE) ?></td>
                <td><?= $this->Number->format($tPrice->ID_TYPE_CURRENCY) ?></td>
                <td><?= $this->Number->format($tPrice->VAR) ?></td>
                <td><?= $this->Number->format($tPrice->ID_POSITION) ?></td>
                <td><?= h($tPrice->UPDATED) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tPrice->ID]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tPrice->ID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tPrice->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $tPrice->ID)]) ?>
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
