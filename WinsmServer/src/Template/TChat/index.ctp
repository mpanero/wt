<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TChat[]|\Cake\Collection\CollectionInterface $tChat
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New T Chat'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tChat index large-9 medium-8 columns content">
    <h3><?= __('T Chat') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID_CHAT') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_TRADE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('COD_REF') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_USER_ORIGEN') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_USER_DESTINY') ?></th>
                <th scope="col"><?= $this->Paginator->sort('SMS') ?></th>
                <th scope="col"><?= $this->Paginator->sort('READ_CHAT') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DT_CREATED') ?></th>
                <th scope="col"><?= $this->Paginator->sort('VERIFIED') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tChat as $tChat): ?>
            <tr>
                <td><?= $this->Number->format($tChat->ID_CHAT) ?></td>
                <td><?= $this->Number->format($tChat->ID_TRADE) ?></td>
                <td><?= h($tChat->COD_REF) ?></td>
                <td><?= $this->Number->format($tChat->ID_USER_ORIGEN) ?></td>
                <td><?= $this->Number->format($tChat->ID_USER_DESTINY) ?></td>
                <td><?= h($tChat->SMS) ?></td>
                <td><?= $this->Number->format($tChat->READ_CHAT) ?></td>
                <td><?= h($tChat->DT_CREATED) ?></td>
                <td><?= $this->Number->format($tChat->VERIFIED) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tChat->ID_CHAT]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tChat->ID_CHAT]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tChat->ID_CHAT], ['confirm' => __('Are you sure you want to delete # {0}?', $tChat->ID_CHAT)]) ?>
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
