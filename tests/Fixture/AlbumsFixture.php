<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AlbumsFixture
 */
class AlbumsFixture extends TestFixture
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
                'title' => 'Lorem ipsum dolor sit amet',
                'date_release' => '2025-03-24',
                'player' => 'Lorem ipsum dolor sit amet',
                'artist_id' => 1,
                'created' => '2025-03-24 13:41:19',
                'modified' => '2025-03-24 13:41:19',
            ],
        ];
        parent::init();
    }
}
