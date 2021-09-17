<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TProduct $tProduct
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit T Product'), ['action' => 'edit', $tProduct->ID_PRODUCT]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete T Product'), ['action' => 'delete', $tProduct->ID_PRODUCT], ['confirm' => __('Are you sure you want to delete # {0}?', $tProduct->ID_PRODUCT)]) ?> </li>
        <li><?= $this->Html->link(__('List T Product'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Product'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tProduct view large-9 medium-8 columns content">
    <h3><?= h($tProduct->ID_PRODUCT) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('PRODUCT NAME') ?></th>
            <td><?= h($tProduct->PRODUCT_NAME) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ACRONYM') ?></th>
            <td><?= h($tProduct->ACRONYM) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ICON PATH') ?></th>
            <td><?= h($tProduct->ICON_PATH) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID PRODUCT') ?></th>
            <td><?= $this->Number->format($tProduct->ID_PRODUCT) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID MARKET') ?></th>
            <td><?= $this->Number->format($tProduct->ID_MARKET) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID CATEGORY PROD') ?></th>
            <td><?= $this->Number->format($tProduct->ID_CATEGORY_PROD) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ACTIVE') ?></th>
            <td><?= $this->Number->format($tProduct->ACTIVE) ?></td>
        </tr>
    </table>
</div>
