<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TUserVendor $tUserVendor
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tUserVendor->ID_USER],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tUserVendor->ID_USER)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List T User Vendors'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tUserVendors form large-9 medium-8 columns content">
    <?= $this->Form->create($tUserVendor) ?>
    <fieldset>
        <legend><?= __('Edit T User Vendor') ?></legend>
        <?php
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
