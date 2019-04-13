<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = 'Smartrade';
?>
<!DOCTYPE html>
<html>
<head>
<?= $this->Html->charset() ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>
    <?= $cakeDescription ?>:
    <?= $this->fetch('title') ?>
</title>
<?= $this->Html->meta('icon', '../webroot/img/icon.png', ['type'=>'image/png']) ?>

<?= $this->Html->css('base.css') ?>
<?= $this->Html->css('cake.css') ?>

<?= $this->fetch('meta') ?>
<?= $this->fetch('css') ?>
<?= $this->fetch('script') ?>
</head>
<body>
    <div id="container">
        <div id="content" style="text-align:center;">
            <?= $this->Html->image('../webroot/img/logo.png', array('alt' => 'foto', 'width'=>'450px', 'height'=>'450px')); ?>
            <?= $this->fetch('content') ?>
            <br />
            <?php if ($tUser == 0): ?>
            <span style="color:red"><?= __('Usuario No Existe') ?></span>
            <?php endif; ?>
            <?php if ($tUser == 1): ?>
            <span style="color:#04204a;"><?= __('Usuario Activado') ?></span>
            <?php endif; ?>
            <?php if ($tUser == 2): ?>
            <span style="color:red"><?= __('Error Activadando usuario') ?></span>
            <?php endif; ?>
            <?php if ($tUser == 3): ?>
            <span style="color:red"><?= __('Link Expiró') ?></span>
            <?php endif; ?>                                    
        </div>
    </div>
</body>
</html>