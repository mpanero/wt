<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TPosition $tPosition
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit T Position'), ['action' => 'edit', $tPosition->ID_POSITION]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete T Position'), ['action' => 'delete', $tPosition->ID_POSITION], ['confirm' => __('Are you sure you want to delete # {0}?', $tPosition->ID_POSITION)]) ?> </li>
        <li><?= $this->Html->link(__('List T Position'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Position'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tPosition view large-9 medium-8 columns content">
    <h3><?= h($tPosition->ID_POSITION) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('POSITION') ?></th>
            <td><?= h($tPosition->POSITION) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID POSITION') ?></th>
            <td><?= $this->Number->format($tPosition->ID_POSITION) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID TYPE PRICE INFO') ?></th>
            <td><?= $this->Number->format($tPosition->ID_TYPE_PRICE_INFO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ACTIVE') ?></th>
            <td><?= $this->Number->format($tPosition->ACTIVE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DATE POSITION') ?></th>
            <td><?= h($tPosition->DATE_POSITION) ?></td>
        </tr>
    </table>
</div>
