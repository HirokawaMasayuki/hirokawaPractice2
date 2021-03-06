<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CustomersHandy Entity
 *
 * @property string $id
 * @property string $customer_id
 * @property string $place_deliver_id
 * @property string $name
 * @property int $flag
 * @property \Cake\I18n\FrozenTime $created_at
 * @property string $created_staff
 * @property \Cake\I18n\FrozenTime $updated_at
 * @property string $updated_staff
 *
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\PlaceDeliver $place_deliver
 */
class CustomersHandy extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'customer_id' => true,
        'place_deliver_id' => true,
        'name' => true,
        'flag' => true,
        'created_at' => true,
        'created_staff' => true,
        'updated_at' => true,
        'updated_staff' => true,
        'customer' => true,
        'place_deliver' => true
    ];
}
