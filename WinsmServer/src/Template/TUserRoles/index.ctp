<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TUserRole[]|\Cake\Collection\CollectionInterface $tUserRoles
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New T User Role'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tUserRoles index large-9 medium-8 columns content">
    <h3><?= __('T User Roles') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID_ROL') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DESCRIPTION') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ACTIVE') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tUserRoles as $tUserRole): ?>
            <tr>
                <td><?= $this->Number->format($tUserRole->ID_ROL) ?></td>
                <td><?= h($tUserRole->DESCRIPTION) ?></td>
                <td><?= $this->Number->format($tUserRole->ACTIVE) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tUserRole->ID_ROL]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tUserRole->ID_ROL]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tUserRole->ID_ROL], ['confirm' => __('Are you sure you want to delete # {0}?', $tUserRole->ID_ROL)]) ?>
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
