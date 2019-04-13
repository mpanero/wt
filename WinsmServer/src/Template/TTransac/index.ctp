<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TTransac[]|\Cake\Collection\CollectionInterface $tTransac
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New T Transac'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tTransac index large-9 medium-8 columns content">
    <h3><?= __('T Transac') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID_TRANSAC') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_USER') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_REQUEST') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_TRADE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('SEC') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_TRANSAC_TYPE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DH_TRANSAC') ?></th>
                <th scope="col"><?= $this->Paginator->sort('VALUE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('INFO') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tTransac as $tTransac): ?>
            <tr>
                <td><?= $this->Number->format($tTransac->ID_TRANSAC) ?></td>
                <td><?= $this->Number->format($tTransac->ID_USER) ?></td>
                <td><?= $this->Number->format($tTransac->ID_REQUEST) ?></td>
                <td><?= $this->Number->format($tTransac->ID_TRADE) ?></td>
                <td><?= $this->Number->format($tTransac->SEC) ?></td>
                <td><?= $this->Number->format($tTransac->ID_TRANSAC_TYPE) ?></td>
                <td><?= h($tTransac->DH_TRANSAC) ?></td>
                <td><?= $this->Number->format($tTransac->VALUE) ?></td>
                <td><?= h($tTransac->INFO) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tTransac->ID_TRANSAC]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tTransac->ID_TRANSAC]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tTransac->ID_TRANSAC], ['confirm' => __('Are you sure you want to delete # {0}?', $tTransac->ID_TRANSAC)]) ?>
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
