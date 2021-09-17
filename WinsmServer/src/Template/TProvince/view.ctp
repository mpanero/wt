<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TProvince $tProvince
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit T Province'), ['action' => 'edit', $tProvince->ID_PROVINCE]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete T Province'), ['action' => 'delete', $tProvince->ID_PROVINCE], ['confirm' => __('Are you sure you want to delete # {0}?', $tProvince->ID_PROVINCE)]) ?> </li>
        <li><?= $this->Html->link(__('List T Province'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Province'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tProvince view large-9 medium-8 columns content">
    <h3><?= h($tProvince->ID_PROVINCE) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('PROVINCE NAME') ?></th>
            <td><?= h($tProvince->PROVINCE_NAME) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID PROVINCE') ?></th>
            <td><?= $this->Number->format($tProvince->ID_PROVINCE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID COUNTRY') ?></th>
            <td><?= $this->Number->format($tProvince->ID_COUNTRY) ?></td>
        </tr>
    </table>
</div>
