<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TCountry $tCountry
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit T Country'), ['action' => 'edit', $tCountry->ID_COUNTRY]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete T Country'), ['action' => 'delete', $tCountry->ID_COUNTRY], ['confirm' => __('Are you sure you want to delete # {0}?', $tCountry->ID_COUNTRY)]) ?> </li>
        <li><?= $this->Html->link(__('List T Country'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Country'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tCountry view large-9 medium-8 columns content">
    <h3><?= h($tCountry->ID_COUNTRY) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('COUNTRY NAME') ?></th>
            <td><?= h($tCountry->COUNTRY_NAME) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID COUNTRY') ?></th>
            <td><?= $this->Number->format($tCountry->ID_COUNTRY) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ACTIVE') ?></th>
            <td><?= $this->Number->format($tCountry->ACTIVE) ?></td>
        </tr>
    </table>
</div>
