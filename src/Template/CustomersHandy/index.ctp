<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CustomersHandy[]|\Cake\Collection\CollectionInterface $customersHandy
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Customers Handy'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="customersHandy index large-9 medium-8 columns content">
    <h3><?= __('Customers Handy') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('place_deliver_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_staff') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_staff') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customersHandy as $customersHandy): ?>
            <tr>
                <td><?= h($customersHandy->id) ?></td>
                <td><?= $customersHandy->has('customer') ? $this->Html->link($customersHandy->customer->name, ['controller' => 'Customers', 'action' => 'view', $customersHandy->customer->id]) : '' ?></td>
                <td><?= h($customersHandy->place_deliver_id) ?></td>
                <td><?= h($customersHandy->name) ?></td>
                <td><?= $this->Number->format($customersHandy->flag) ?></td>
                <td><?= h($customersHandy->created_at) ?></td>
                <td><?= h($customersHandy->created_staff) ?></td>
                <td><?= h($customersHandy->updated_at) ?></td>
                <td><?= h($customersHandy->updated_staff) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $customersHandy->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $customersHandy->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $customersHandy->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customersHandy->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
