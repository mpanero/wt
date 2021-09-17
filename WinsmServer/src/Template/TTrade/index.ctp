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
                <th scope="col"><?= $this->Paginator->sort('COD_REF') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_USER_OWNER') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_USER_CPART') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PRICE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_TP_CURRENCY') ?></th>
                <th scope="col"><?= $this->Paginator->sort('QT') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_UM') ?></th>
                <th scope="col"><?= $this->Paginator->sort('CONFIRMED_OWNER') ?></th>
                <th scope="col"><?= $this->Paginator->sort('CONFIRMED_CPART') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DH_CREATION') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_TP_STATUS_TRADE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_TYPE_PRICE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_PRICE_REF') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DT_PRICE_FIX_FROM') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DT_PRICE_FIX_TO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_CROP') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_TYPE_DELIVERY') ?></th>
                <th scope="col"><?= $this->Paginator->sort('TYPE_QUALITY') ?></th>
                <th scope="col"><?= $this->Paginator->sort('QUALITY_INFO') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tTrade as $tTrade): ?>
            <tr>
                <td><?= $this->Number->format($tTrade->ID_TRADE) ?></td>
                <td><?= $this->Number->format($tTrade->ID_REQUEST) ?></td>
                <td><?= h($tTrade->COD_REF) ?></td>
                <td><?= $this->Number->format($tTrade->ID_USER_OWNER) ?></td>
                <td><?= $this->Number->format($tTrade->ID_USER_CPART) ?></td>
                <td><?= $this->Number->format($tTrade->PRICE) ?></td>
                <td><?= $this->Number->format($tTrade->ID_TP_CURRENCY) ?></td>
                <td><?= $this->Number->format($tTrade->QT) ?></td>
                <td><?= $this->Number->format($tTrade->ID_UM) ?></td>
                <td><?= $this->Number->format($tTrade->CONFIRMED_OWNER) ?></td>
                <td><?= $this->Number->format($tTrade->CONFIRMED_CPART) ?></td>
                <td><?= h($tTrade->DH_CREATION) ?></td>
                <td><?= $this->Number->format($tTrade->ID_TP_STATUS_TRADE) ?></td>
                <td><?= $this->Number->format($tTrade->ID_TYPE_PRICE) ?></td>
                <td><?= $this->Number->format($tTrade->ID_PRICE_REF) ?></td>
                <td><?= h($tTrade->DT_PRICE_FIX_FROM) ?></td>
                <td><?= h($tTrade->DT_PRICE_FIX_TO) ?></td>
                <td><?= $this->Number->format($tTrade->ID_CROP) ?></td>
                <td><?= $this->Number->format($tTrade->ID_TYPE_DELIVERY) ?></td>
                <td><?= $this->Number->format($tTrade->TYPE_QUALITY) ?></td>
                <td><?= h($tTrade->QUALITY_INFO) ?></td>
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
