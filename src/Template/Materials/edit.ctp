<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Material $material
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $material->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $material->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Materials'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Material Types'), ['controller' => 'MaterialTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Material Type'), ['controller' => 'MaterialTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Suppliers'), ['controller' => 'Suppliers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Supplier'), ['controller' => 'Suppliers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="materials form large-9 medium-8 columns content">
    <?= $this->Form->create($material) ?>
    <fieldset>
        <legend><?= __('Edit Material') ?></legend>
        <?php
            echo $this->Form->control('grade');
            echo $this->Form->control('color');
            echo $this->Form->control('material_type_id', ['options' => $arrMaterialType]);
            echo $this->Form->control('price');
            echo $this->Form->control('tani');
            echo $this->Form->control('lot_low');
            echo $this->Form->control('lot_upper');
            echo $this->Form->control('supplier_id', ['options' => $arrSupplier]);
            echo $this->Form->control('multiple_sup');
            echo $this->Form->control('status');
            echo $this->Form->control('delete_flag');
//            echo $this->Form->control('created_at');
//            echo $this->Form->control('created_staff');
//            echo $this->Form->control('updated_at', ['empty' => true]);
            echo $this->Form->hidden('updated_staff');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
