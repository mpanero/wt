<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TUserRole $tUserRole
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit T User Role'), ['action' => 'edit', $tUserRole->ID_ROL]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete T User Role'), ['action' => 'delete', $tUserRole->ID_ROL], ['confirm' => __('Are you sure you want to delete # {0}?', $tUserRole->ID_ROL)]) ?> </li>
        <li><?= $this->Html->link(__('List T User Roles'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T User Role'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tUserRoles view large-9 medium-8 columns content">
    <h3><?= h($tUserRole->ID_ROL) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('DESCRIPTION') ?></th>
            <td><?= h($tUserRole->DESCRIPTION) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID ROL') ?></th>
            <td><?= $this->Number->format($tUserRole->ID_ROL) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ACTIVE') ?></th>
            <td><?= $this->Number->format($tUserRole->ACTIVE) ?></td>
        </tr>
    </table>
</div>
