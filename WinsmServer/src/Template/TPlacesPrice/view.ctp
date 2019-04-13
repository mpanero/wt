<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TPlacesPrice $tPlacesPrice
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit T Places Price'), ['action' => 'edit', $tPlacesPrice->ID_PLACE_PRICE]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete T Places Price'), ['action' => 'delete', $tPlacesPrice->ID_PLACE_PRICE], ['confirm' => __('Are you sure you want to delete # {0}?', $tPlacesPrice->ID_PLACE_PRICE)]) ?> </li>
        <li><?= $this->Html->link(__('List T Places Price'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Places Price'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tPlacesPrice view large-9 medium-8 columns content">
    <h3><?= h($tPlacesPrice->ID_PLACE_PRICE) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('PLACE NAME') ?></th>
            <td><?= h($tPlacesPrice->PLACE_NAME) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID PLACE PRICE') ?></th>
            <td><?= $this->Number->format($tPlacesPrice->ID_PLACE_PRICE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID COUNTRY') ?></th>
            <td><?= $this->Number->format($tPlacesPrice->ID_COUNTRY) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ACTIVE') ?></th>
            <td><?= $this->Number->format($tPlacesPrice->ACTIVE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ORDER INFO') ?></th>
            <td><?= $this->Number->format($tPlacesPrice->ORDER_INFO) ?></td>
        </tr>
    </table>
</div>
