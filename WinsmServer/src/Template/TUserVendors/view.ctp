<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TUserVendor $tUserVendor
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit T User Vendor'), ['action' => 'edit', $tUserVendor->ID_USER]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete T User Vendor'), ['action' => 'delete', $tUserVendor->ID_USER], ['confirm' => __('Are you sure you want to delete # {0}?', $tUserVendor->ID_USER)]) ?> </li>
        <li><?= $this->Html->link(__('List T User Vendors'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T User Vendor'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tUserVendors view large-9 medium-8 columns content">
    <h3><?= h($tUserVendor->ID_USER) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('MAIL VENDOR') ?></th>
            <td><?= h($tUserVendor->MAIL_VENDOR) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID USER') ?></th>
            <td><?= $this->Number->format($tUserVendor->ID_USER) ?></td>
        </tr>
    </table>
</div>
