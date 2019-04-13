<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TGender[]|\Cake\Collection\CollectionInterface $tGender
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New T Gender'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tGender index large-9 medium-8 columns content">
    <h3><?= __('T Gender') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID_GENDER') ?></th>
                <th scope="col"><?= $this->Paginator->sort('GENDER_NAME') ?></th>
                <th scope="col"><?= $this->Paginator->sort('GENDER_INI') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ACTIVE') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tGender as $tGender): ?>
            <tr>
                <td><?= $this->Number->format($tGender->ID_GENDER) ?></td>
                <td><?= h($tGender->GENDER_NAME) ?></td>
                <td><?= h($tGender->GENDER_INI) ?></td>
                <td><?= $this->Number->format($tGender->ACTIVE) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tGender->ID_GENDER]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tGender->ID_GENDER]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tGender->ID_GENDER], ['confirm' => __('Are you sure you want to delete # {0}?', $tGender->ID_GENDER)]) ?>
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
