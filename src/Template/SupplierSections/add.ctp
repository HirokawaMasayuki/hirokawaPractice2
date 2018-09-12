<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SupplierSection $supplierSection
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Supplier Sections'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="supplierSections form large-9 medium-8 columns content">
    <?= $this->Form->create($supplierSection) ?>
    <fieldset>
        <legend><?= __('Add Supplier Section') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('account_code');
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
