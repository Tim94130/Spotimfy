<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Album Entity
 *
 * @property int $id
 * @property string $title
 * @property \Cake\I18n\Date $date_release
 * @property string $player
 * @property int $artist_id
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Artist $artist
 * @property \App\Model\Entity\Favorite[] $favorites
 */
class Album extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'title' => true,
        'date_release' => true,
        'player' => true,
        'artist_id' => true,
        'created' => true,
        'modified' => true,
        'artist' => true,
        'favorites' => true,
    ];
}
