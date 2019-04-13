<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TTrade[]|\Cake\Collection\CollectionInterface $tTrade
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New T Trade'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tTrade index large-9 medium-8 columns content">
    <h3><?= __('T Trade') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID_TRADE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_REQUEST') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_REQUEST_1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_USER') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_USER_1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PRICE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_TP_CURRENCY') ?></th>
                <th scope="col"><?= $this->Paginator->sort('QT') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_UM') ?></th>
                <th scope="col"><?= $this->Paginator->sort('CONFIRMED') ?></th>
                <th scope="col"><?= $this->Paginator->sort('CONFIRMED_1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DH_CREATION') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_TP_STATUS_TRADE') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tTrade as $tTrade): ?>
            <tr>
                <td><?= $this->Number->format($tTrade->ID_TRADE) ?></td>
                <td><?= $this->Number->format($tTrade->ID_REQUEST) ?></td>
                <td><?= $this->Number->format($tTrade->ID_REQUEST_1) ?></td>
                <td><?= $this->Number->format($tTrade->ID_USER) ?></td>
                <td><?= $this->Number->format($tTrade->ID_USER_1) ?></td>
                <td><?= $this->Number->format($tTrade->PRICE) ?></td>
                <td><?= $this->Number->format($tTrade->ID_TP_CURRENCY) ?></td>
                <td><?= $this->Number->format($tTrade->QT) ?></td>
                <td><?= $this->Number->format($tTrade->ID_UM) ?></td>
                <td><?= $this->Number->format($tTrade->CONFIRMED) ?></td>
                <td><?= $this->Number->format($tTrade->CONFIRMED_1) ?></td>
                <td><?= h($tTrade->DH_CREATION) ?></td>
                <td><?= $this->Number->format($tTrade->ID_TP_STATUS_TRADE) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tTrade->ID_TRADE]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tTrade->ID_TRADE]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tTrade->ID_TRADE], ['confirm' => __('Are you sure you want to delete # {0}?', $tTrade->ID_TRADE)]) ?>
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
