<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SupplierSection $supplierSection
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Supplier Section'), ['action' => 'edit', $supplierSection->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Supplier Section'), ['action' => 'delete', $supplierSection->id], ['confirm' => __('Are you sure you want to delete # {0}?', $supplierSection->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Supplier Sections'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Supplier Section'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="supplierSections view large-9 medium-8 columns content">
    <h3><?= h($supplierSection->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($supplierSection->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($supplierSection->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Account Code') ?></th>
            <td><?= h($supplierSection->account_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created Staff') ?></th>
            <td><?= h($supplierSection->created_staff) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated Staff') ?></th>
            <td><?= h($supplierSection->updated_staff) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delete Flag') ?></th>
            <td><?= $this->Number->format($supplierSection->delete_flag) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($supplierSection->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated At') ?></th>
            <td><?= h($supplierSection->updated_at) ?></td>
        </tr>
    </table>
</div>
