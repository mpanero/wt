<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TCategoryProd[]|\Cake\Collection\CollectionInterface $tCategoryProd
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New T Category Prod'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tCategoryProd index large-9 medium-8 columns content">
    <h3><?= __('T Category Prod') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID_CATEGORY_PROD') ?></th>
                <th scope="col"><?= $this->Paginator->sort('CATEGORY_PROD_NAME') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_MARKET') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ACTIVE') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tCategoryProd as $tCategoryProd): ?>
            <tr>
                <td><?= $this->Number->format($tCategoryProd->ID_CATEGORY_PROD) ?></td>
                <td><?= h($tCategoryProd->CATEGORY_PROD_NAME) ?></td>
                <td><?= $this->Number->format($tCategoryProd->ID_MARKET) ?></td>
                <td><?= $this->Number->format($tCategoryProd->ACTIVE) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tCategoryProd->ID_CATEGORY_PROD]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tCategoryProd->ID_CATEGORY_PROD]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tCategoryProd->ID_CATEGORY_PROD], ['confirm' => __('Are you sure you want to delete # {0}?', $tCategoryProd->ID_CATEGORY_PROD)]) ?>
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
