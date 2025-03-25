<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FavoritesFixture
 */
class FavoritesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'user_id' => 1,
                'album_id' => 1,
                'artist_id' => 1,
                'created' => '2025-03-24 13:41:19',
                'modified' => '2025-03-24 13:41:19',
            ],
        ];
        parent::init();
    }
}
