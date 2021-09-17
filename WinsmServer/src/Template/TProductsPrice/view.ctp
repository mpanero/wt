<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TProductsPrice $tProductsPrice
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit T Products Price'), ['action' => 'edit', $tProductsPrice->ID_PRODUCT_PRICE]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete T Products Price'), ['action' => 'delete', $tProductsPrice->ID_PRODUCT_PRICE], ['confirm' => __('Are you sure you want to delete # {0}?', $tProductsPrice->ID_PRODUCT_PRICE)]) ?> </li>
        <li><?= $this->Html->link(__('List T Products Price'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Products Price'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tProductsPrice view large-9 medium-8 columns content">
    <h3><?= h($tProductsPrice->ID_PRODUCT_PRICE) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('PRODUCT NAME') ?></th>
            <td><?= h($tProductsPrice->PRODUCT_NAME) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID PRODUCT PRICE') ?></th>
            <td><?= $this->Number->format($tProductsPrice->ID_PRODUCT_PRICE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ACTIVE') ?></th>
            <td><?= $this->Number->format($tProductsPrice->ACTIVE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID COUNTRY') ?></th>
            <td><?= $this->Number->format($tProductsPrice->ID_COUNTRY) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ORDER INFO') ?></th>
            <td><?= $this->Number->format($tProductsPrice->ORDER_INFO) ?></td>
        </tr>
    </table>
</div>
