<?php header('Content-type: text/html; charset=UTF-8'); ?>
<?php echo $this->Html->charset('utf-8'); ?>
<div class="coupons view large-9 medium-8 columns content">
    <?php if (is_string($tRequest)): ?>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Mensaje') ?></th>
            <td><?= h($tRequest) ?></td>
        </tr>
    </table>    
    <?php endif; ?>
</div>