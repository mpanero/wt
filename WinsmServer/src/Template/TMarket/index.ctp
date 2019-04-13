<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TMarket[]|\Cake\Collection\CollectionInterface $tMarket
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New T Market'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tMarket index large-9 medium-8 columns content">
    <h3><?= __('T Market') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID_MARKET') ?></th>
                <th scope="col"><?= $this->Paginator->sort('MARKET_NAME') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_COUNTRY') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ACTIVE') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tMarket as $tMarket): ?>
            <tr>
                <td><?= $this->Number->format($tMarket->ID_MARKET) ?></td>
                <td><?= h($tMarket->MARKET_NAME) ?></td>
                <td><?= $this->Number->format($tMarket->ID_COUNTRY) ?></td>
                <td><?= $this->Number->format($tMarket->ACTIVE) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tMarket->ID_MARKET]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tMarket->ID_MARKET]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tMarket->ID_MARKET], ['confirm' => __('Are you sure you want to delete # {0}?', $tMarket->ID_MARKET)]) ?>
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
