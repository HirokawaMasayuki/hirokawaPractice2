<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Deliver[]|\Cake\Collection\CollectionInterface $delivers
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Deliver'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="delivers index large-9 medium-8 columns content">
    <h3><?= __('Delivers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('place_deliver_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('zip') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tel') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fax') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delete_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_staff') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_staff') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($delivers as $deliver): ?>
            <tr>
                <td><?= h($deliver->id) ?></td>
                <td><?= $deliver->has('customer') ? $this->Html->link($deliver->customer->name, ['controller' => 'Customers', 'action' => 'view', $deliver->customer->id]) : '' ?></td>
                <td><?= h($deliver->place_deliver_id) ?></td>
                <td><?= h($deliver->name) ?></td>
                <td><?= h($deliver->zip) ?></td>
                <td><?= h($deliver->address) ?></td>
                <td><?= h($deliver->tel) ?></td>
                <td><?= h($deliver->fax) ?></td>
                <td><?= $this->Number->format($deliver->status) ?></td>
                <td><?= $this->Number->format($deliver->delete_flag) ?></td>
                <td><?= h($deliver->created_at) ?></td>
                <td><?= h($deliver->created_staff) ?></td>
                <td><?= h($deliver->updated_at) ?></td>
                <td><?= h($deliver->updated_staff) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $deliver->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $deliver->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $deliver->id], ['confirm' => __('Are you sure you want to delete # {0}?', $deliver->id)]) ?>
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
