<?php header('Content-type: text/html; charset=UTF-8'); ?>
<?php echo $this->Html->charset('utf-8'); ?>
<div class="coupons view large-9 medium-8 columns content">
	<?php if (!empty($login["user"])): ?>
    <h3><?= h($login["user"]) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Token') ?></th>
            <td><?= h($login["token"]) ?></td>
        </tr>
    </table>
    <?php endif; ?>
    <?php if (is_string($login)): ?>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Error') ?></th>
            <td><?= h($login) ?></td>
        </tr>
    </table>    
    <?php endif; ?>
</div>