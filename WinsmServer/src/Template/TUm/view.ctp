<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TUm $tUm
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit T Um'), ['action' => 'edit', $tUm->ID_UM]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete T Um'), ['action' => 'delete', $tUm->ID_UM], ['confirm' => __('Are you sure you want to delete # {0}?', $tUm->ID_UM)]) ?> </li>
        <li><?= $this->Html->link(__('List T Um'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Um'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tUm view large-9 medium-8 columns content">
    <h3><?= h($tUm->ID_UM) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('UM NAME') ?></th>
            <td><?= h($tUm->UM_NAME) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID UM') ?></th>
            <td><?= $this->Number->format($tUm->ID_UM) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID COUNTRY') ?></th>
            <td><?= $this->Number->format($tUm->ID_COUNTRY) ?></td>
        </tr>
    </table>
</div>
