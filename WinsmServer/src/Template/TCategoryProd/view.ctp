<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TCategoryProd $tCategoryProd
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit T Category Prod'), ['action' => 'edit', $tCategoryProd->ID_CATEGORY_PROD]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete T Category Prod'), ['action' => 'delete', $tCategoryProd->ID_CATEGORY_PROD], ['confirm' => __('Are you sure you want to delete # {0}?', $tCategoryProd->ID_CATEGORY_PROD)]) ?> </li>
        <li><?= $this->Html->link(__('List T Category Prod'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Category Prod'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tCategoryProd view large-9 medium-8 columns content">
    <h3><?= h($tCategoryProd->ID_CATEGORY_PROD) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('CATEGORY PROD NAME') ?></th>
            <td><?= h($tCategoryProd->CATEGORY_PROD_NAME) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID CATEGORY PROD') ?></th>
            <td><?= $this->Number->format($tCategoryProd->ID_CATEGORY_PROD) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID MARKET') ?></th>
            <td><?= $this->Number->format($tCategoryProd->ID_MARKET) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ACTIVE') ?></th>
            <td><?= $this->Number->format($tCategoryProd->ACTIVE) ?></td>
        </tr>
    </table>
</div>
