<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TPrice $tPrice
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit T Price'), ['action' => 'edit', $tPrice->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete T Price'), ['action' => 'delete', $tPrice->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $tPrice->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List T Prices'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Price'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tPrices view large-9 medium-8 columns content">
    <h3><?= h($tPrice->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('ID') ?></th>
            <td><?= $this->Number->format($tPrice->ID) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID TYPE PRICE INFO') ?></th>
            <td><?= $this->Number->format($tPrice->ID_TYPE_PRICE_INFO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID PRODUCT') ?></th>
            <td><?= $this->Number->format($tPrice->ID_PRODUCT) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID PLACE PRICE') ?></th>
            <td><?= $this->Number->format($tPrice->ID_PLACE_PRICE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PRICE VALUE') ?></th>
            <td><?= $this->Number->format($tPrice->PRICE_VALUE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID TYPE CURRENCY') ?></th>
            <td><?= $this->Number->format($tPrice->ID_TYPE_CURRENCY) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('VAR') ?></th>
            <td><?= $this->Number->format($tPrice->VAR) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID POSITION') ?></th>
            <td><?= $this->Number->format($tPrice->ID_POSITION) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('LAST') ?></th>
            <td><?= $this->Number->format($tPrice->LAST) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DATE PRICE') ?></th>
            <td><?= h($tPrice->DATE_PRICE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('UPDATED') ?></th>
            <td><?= h($tPrice->UPDATED) ?></td>
        </tr>
    </table>
</div>
