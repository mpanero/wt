<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TLocality $tLocality
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit T Locality'), ['action' => 'edit', $tLocality->ID_PLACE]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete T Locality'), ['action' => 'delete', $tLocality->ID_PLACE], ['confirm' => __('Are you sure you want to delete # {0}?', $tLocality->ID_PLACE)]) ?> </li>
        <li><?= $this->Html->link(__('List T Locality'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Locality'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tLocality view large-9 medium-8 columns content">
    <h3><?= h($tLocality->ID_PLACE) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('PLACE NAME') ?></th>
            <td><?= h($tLocality->PLACE_NAME) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID PLACE') ?></th>
            <td><?= $this->Number->format($tLocality->ID_PLACE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID PROVINCE') ?></th>
            <td><?= $this->Number->format($tLocality->ID_PROVINCE) ?></td>
        </tr>
    </table>
</div>
