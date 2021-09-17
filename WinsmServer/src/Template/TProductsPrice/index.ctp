<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TProductsPrice[]|\Cake\Collection\CollectionInterface $tProductsPrice
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New T Products Price'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tProductsPrice index large-9 medium-8 columns content">
    <h3><?= __('T Products Price') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID_PRODUCT_PRICE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PRODUCT_NAME') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ACTIVE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_COUNTRY') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ORDER_INFO') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tProductsPrice as $tProductsPrice): ?>
            <tr>
                <td><?= $this->Number->format($tProductsPrice->ID_PRODUCT_PRICE) ?></td>
                <td><?= h($tProductsPrice->PRODUCT_NAME) ?></td>
                <td><?= $this->Number->format($tProductsPrice->ACTIVE) ?></td>
                <td><?= $this->Number->format($tProductsPrice->ID_COUNTRY) ?></td>
                <td><?= $this->Number->format($tProductsPrice->ORDER_INFO) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tProductsPrice->ID_PRODUCT_PRICE]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tProductsPrice->ID_PRODUCT_PRICE]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tProductsPrice->ID_PRODUCT_PRICE], ['confirm' => __('Are you sure you want to delete # {0}?', $tProductsPrice->ID_PRODUCT_PRICE)]) ?>
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
