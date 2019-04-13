<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TTypeActivity $tTypeActivity
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit T Type Activity'), ['action' => 'edit', $tTypeActivity->ID_ACTIVITY]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete T Type Activity'), ['action' => 'delete', $tTypeActivity->ID_ACTIVITY], ['confirm' => __('Are you sure you want to delete # {0}?', $tTypeActivity->ID_ACTIVITY)]) ?> </li>
        <li><?= $this->Html->link(__('List T Type Activity'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Type Activity'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tTypeActivity view large-9 medium-8 columns content">
    <h3><?= h($tTypeActivity->ID_ACTIVITY) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('ACTIVITY NAME') ?></th>
            <td><?= h($tTypeActivity->ACTIVITY_NAME) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ACTIVITY NAME EN') ?></th>
            <td><?= h($tTypeActivity->ACTIVITY_NAME_EN) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID ACTIVITY') ?></th>
            <td><?= $this->Number->format($tTypeActivity->ID_ACTIVITY) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ACTIVITY NAME PO') ?></th>
            <td><?= $this->Number->format($tTypeActivity->ACTIVITY_NAME_PO) ?></td>
        </tr>
    </table>
</div>
