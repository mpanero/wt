<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TProduct[]|\Cake\Collection\CollectionInterface $tProduct
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New T Product'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tProduct index large-9 medium-8 columns content">
    <h3><?= __('T Product') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID_PRODUCT') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PRODUCT_NAME') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_MARKET') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_CATEGORY_PROD') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ACTIVE') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tProduct as $tProduct): ?>
            <tr>
                <td><?= $this->Number->format($tProduct->ID_PRODUCT) ?></td>
                <td><?= h($tProduct->PRODUCT_NAME) ?></td>
                <td><?= $this->Number->format($tProduct->ID_MARKET) ?></td>
                <td><?= $this->Number->format($tProduct->ID_CATEGORY_PROD) ?></td>
                <td><?= $this->Number->format($tProduct->ACTIVE) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tProduct->ID_PRODUCT]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tProduct->ID_PRODUCT]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tProduct->ID_PRODUCT], ['confirm' => __('Are you sure you want to delete # {0}?', $tProduct->ID_PRODUCT)]) ?>
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
