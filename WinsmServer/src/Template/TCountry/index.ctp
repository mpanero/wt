<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TCountry[]|\Cake\Collection\CollectionInterface $tCountry
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New T Country'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tCountry index large-9 medium-8 columns content">
    <h3><?= __('T Country') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID_COUNTRY') ?></th>
                <th scope="col"><?= $this->Paginator->sort('COUNTRY_NAME') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ACTIVE') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tCountry as $tCountry): ?>
            <tr>
                <td><?= $this->Number->format($tCountry->ID_COUNTRY) ?></td>
                <td><?= h($tCountry->COUNTRY_NAME) ?></td>
                <td><?= $this->Number->format($tCountry->ACTIVE) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tCountry->ID_COUNTRY]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tCountry->ID_COUNTRY]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tCountry->ID_COUNTRY], ['confirm' => __('Are you sure you want to delete # {0}?', $tCountry->ID_COUNTRY)]) ?>
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
