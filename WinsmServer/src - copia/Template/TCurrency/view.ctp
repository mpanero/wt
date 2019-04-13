<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TCurrency $tCurrency
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit T Currency'), ['action' => 'edit', $tCurrency->ID_CURRENCY]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete T Currency'), ['action' => 'delete', $tCurrency->ID_CURRENCY], ['confirm' => __('Are you sure you want to delete # {0}?', $tCurrency->ID_CURRENCY)]) ?> </li>
        <li><?= $this->Html->link(__('List T Currency'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Currency'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tCurrency view large-9 medium-8 columns content">
    <h3><?= h($tCurrency->ID_CURRENCY) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('CURRENCY NAME') ?></th>
            <td><?= h($tCurrency->CURRENCY_NAME) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID CURRENCY') ?></th>
            <td><?= $this->Number->format($tCurrency->ID_CURRENCY) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID COUNTRY') ?></th>
            <td><?= $this->Number->format($tCurrency->ID_COUNTRY) ?></td>
        </tr>
    </table>
</div>
