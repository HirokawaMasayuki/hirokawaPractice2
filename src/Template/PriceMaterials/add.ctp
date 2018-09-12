<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PriceMaterial $priceMaterial
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Price Materials'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Materials'), ['controller' => 'Materials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Material'), ['controller' => 'Materials', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Suppliers'), ['controller' => 'Suppliers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Supplier'), ['controller' => 'Suppliers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="priceMaterials form large-9 medium-8 columns content">
    <?= $this->Form->create($priceMaterial) ?>
    <fieldset>
        <legend><?= __('Add Price Material') ?></legend>
        <?php
            echo $this->Form->control('material_id', ['options' => $arrMaterial]);
            echo $this->Form->control('supplier_id', ['options' => $arrSupplier]);
            echo $this->Form->control('price');
            echo $this->Form->control('start');
            echo $this->Form->control('finish', ['empty' => true]);
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
