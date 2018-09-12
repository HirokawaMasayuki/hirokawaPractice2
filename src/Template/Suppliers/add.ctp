<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Supplier $supplier
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Suppliers'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="suppliers form large-9 medium-8 columns content">
    <?= $this->Form->create($supplier) ?>
    <fieldset>
        <legend><?= __('Add Supplier') ?></legend>
        <?php
            echo $this->Form->control('supplier_code');
            echo $this->Form->control('name');
            echo $this->Form->control('zip');
            echo $this->Form->control('address');
            echo $this->Form->control('tel');
            echo $this->Form->control('fax');
            echo $this->Form->control('charge_p');
            echo $this->Form->control('status');
            echo $this->Form->control('delete_flag');
            echo $this->Form->hidden('created_at');
            echo $this->Form->hidden('created_staff');
//            echo $this->Form->control('updated_at', ['empty' => true]);
//            echo $this->Form->control('updated_staff');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
