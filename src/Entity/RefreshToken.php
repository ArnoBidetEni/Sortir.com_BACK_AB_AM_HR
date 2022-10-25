<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Gesdinet\JWTRefreshTokenBundle\Entity\RefreshToken as BaseRefreshToken;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ApiResource]
class RefreshToken extends BaseRefreshToken
{
}
