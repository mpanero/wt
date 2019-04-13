<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TRequest[]|\Cake\Collection\CollectionInterface $tRequest
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New T Request'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tRequest index large-9 medium-8 columns content">
    <h3><?= __('T Request') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID_REQUEST') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_USER_OWNER') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DH_REQUEST') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_TP_OPERATION') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_MARKET') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_TP_BUSINESS') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_PRODUCT') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PRICE_FROM') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PRICE_TO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_TP_CURRENCY') ?></th>
                <th scope="col"><?= $this->Paginator->sort('QT_FROM') ?></th>
                <th scope="col"><?= $this->Paginator->sort('QT_TO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_UM') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DT_FROM') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DT_TO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_PLACE_DELIVERY') ?></th>
                <th scope="col"><?= $this->Paginator->sort('LOG') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_TP_STATUS_REQ') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ACTIVE') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tRequest as $tRequest): ?>
            <tr>
                <td><?= $this->Number->format($tRequest->ID_REQUEST) ?></td>
                <td><?= $this->Number->format($tRequest->ID_USER_OWNER) ?></td>
                <td><?= h($tRequest->DH_REQUEST) ?></td>
                <td><?= $this->Number->format($tRequest->ID_TP_OPERATION) ?></td>
                <td><?= $this->Number->format($tRequest->ID_MARKET) ?></td>
                <td><?= $this->Number->format($tRequest->ID_TP_BUSINESS) ?></td>
                <td><?= $this->Number->format($tRequest->ID_PRODUCT) ?></td>
                <td><?= $this->Number->format($tRequest->PRICE_FROM) ?></td>
                <td><?= $this->Number->format($tRequest->PRICE_TO) ?></td>
                <td><?= $this->Number->format($tRequest->ID_TP_CURRENCY) ?></td>
                <td><?= $this->Number->format($tRequest->QT_FROM) ?></td>
                <td><?= $this->Number->format($tRequest->QT_TO) ?></td>
                <td><?= $this->Number->format($tRequest->ID_UM) ?></td>
                <td><?= h($tRequest->DT_FROM) ?></td>
                <td><?= h($tRequest->DT_TO) ?></td>
                <td><?= $this->Number->format($tRequest->ID_PLACE_DELIVERY) ?></td>
                <td><?= h($tRequest->LOG) ?></td>
                <td><?= $this->Number->format($tRequest->ID_TP_STATUS_REQ) ?></td>
                <td><?= $this->Number->format($tRequest->ACTIVE) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tRequest->ID_REQUEST]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tRequest->ID_REQUEST]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tRequest->ID_REQUEST], ['confirm' => __('Are you sure you want to delete # {0}?', $tRequest->ID_REQUEST)]) ?>
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
