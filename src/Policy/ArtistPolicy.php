<?php
namespace App\Policy;

use App\Model\Entity\Artist;
use Authorization\IdentityInterface;

class ArtistPolicy
{
    public function canView(IdentityInterface $user, Artist $artist): bool
    {
        // Autorise tout utilisateur connecté
        return true;
    }

    public function canAdd(IdentityInterface $user, Artist $artist): bool
    {
        return true;
    }

    public function canEdit(IdentityInterface $user, Artist $artist): bool
    {
        return $this->isAuthor($user, $artist);
    }

    public function canDelete(IdentityInterface $user, Artist $artist): bool
    {
        return $this->isAuthor($user, $artist);
    }

    protected function isAuthor(IdentityInterface $user, Artist $artist): bool
    {
        return $artist->user_id === $user->getIdentifier(); 
    }
}
