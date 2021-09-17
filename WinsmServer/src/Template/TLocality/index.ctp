<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TLocality[]|\Cake\Collection\CollectionInterface $tLocality
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New T Locality'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tLocality index large-9 medium-8 columns content">
    <h3><?= __('T Locality') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID_PLACE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_PROVINCE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PLACE_NAME') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tLocality as $tLocality): ?>
            <tr>
                <td><?= $this->Number->format($tLocality->ID_PLACE) ?></td>
                <td><?= $this->Number->format($tLocality->ID_PROVINCE) ?></td>
                <td><?= h($tLocality->PLACE_NAME) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tLocality->ID_PLACE]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tLocality->ID_PLACE]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tLocality->ID_PLACE], ['confirm' => __('Are you sure you want to delete # {0}?', $tLocality->ID_PLACE)]) ?>
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
