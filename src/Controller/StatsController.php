<?php
// src/Controller/StatsController.php

declare(strict_types=1);

namespace App\Controller;

class StatsController extends AppController
{
    public function index()
    {
        $this->Authorization->skipAuthorization();
    
        $identity = $this->Authentication->getIdentity();
        $userId = $identity ? $identity->get('id') : null;
        $isAdmin = $identity && $identity->get('role') === 'admin';
    
        // Condition de filtrage : si non admin → on limite aux favoris du user
        $filter = $isAdmin ? [] : ['Favorites.user_id' => $userId];
    
        // 🎤 Top 5 artistes les plus suivis
        $topArtists = $this->fetchTable('Artists')
            ->find()
            ->select([
                'id',
                'name',
                'favorites_count' => $this->fetchTable('Favorites')->find()->func()->count('*')
            ])
            ->leftJoinWith('Favorites')
            ->where($filter)
            ->group('Artists.id')
            ->orderDesc('favorites_count')
            ->limit(5)
            ->all();
    
        // Artistes les moins suivis
        $leastArtists = $this->fetchTable('Artists')
            ->find()
            ->select([
                'id',
                'name',
                'favorites_count' => $this->fetchTable('Favorites')->find()->func()->count('*')
            ])
            ->leftJoinWith('Favorites')
            ->where($filter)
            ->group('Artists.id')
            ->orderAsc('favorites_count')
            ->limit(5)
            ->all();
    
        //Top albums les plus suivis
        $topAlbums = $this->fetchTable('Albums')
            ->find()
            ->select([
                'id',
                'title',
                'favorites_count' => $this->fetchTable('Favorites')->find()->func()->count('*')
            ])
            ->leftJoinWith('Favorites')
            ->where($filter)
            ->group('Albums.id')
            ->orderDesc('favorites_count')
            ->limit(5)
            ->all();
    
        // Albums les moins suivis
        $leastAlbums = $this->fetchTable('Albums')
            ->find()
            ->select([
                'id',
                'title',
                'favorites_count' => $this->fetchTable('Favorites')->find()->func()->count('*')
            ])
            ->leftJoinWith('Favorites')
            ->where($filter)
            ->group('Albums.id')
            ->orderAsc('favorites_count')
            ->limit(5)
            ->all();
    
        // Top utilisateurs avec le plus de favoris → uniquement pour l'admin
        $topUsers = [];
        if ($isAdmin) {
            $topUsers = $this->fetchTable('Users')
                ->find()
                ->select([
                    'id',
                    'username',
                    'favorites_count' => $this->fetchTable('Favorites')->find()->func()->count('*')
                ])
                ->leftJoinWith('Favorites')
                ->group('Users.id')
                ->orderDesc('favorites_count')
                ->limit(5)
                ->all();
        }
    
        $this->set(compact('topArtists', 'leastArtists', 'topAlbums', 'leastAlbums', 'topUsers', 'isAdmin'));
    }
}    