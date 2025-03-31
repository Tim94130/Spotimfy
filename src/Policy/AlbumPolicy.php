<?php

declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Album;
use Authorization\IdentityInterface;

class AlbumPolicy
{
    public function canAdd(IdentityInterface $user, Album $album): bool
    {
        // Tous les utilisateurs authentifiés peuvent ajouter des albums
        return true;
    }

    public function canEdit(IdentityInterface $user, Album $album): bool
    {
        // Seul l'auteur peut modifier l'album
        return $this->isAuthor($user, $album);
    }

    public function canDelete(IdentityInterface $user, Album $album): bool
    {
        // Seul l'auteur peut supprimer l'album
        return $this->isAuthor($user, $album);
    }

    public function canView(IdentityInterface $user, Album $album): bool
    {
        // Tout utilisateur connecté peut voir un album
        return true;
    }


    protected function isAuthor(IdentityInterface $user, Album $album): bool
    {
        return $album->user_id === $user->get('id');

    }
}
