<?php
namespace App\Repository\Quote;

use App\Repository\EntityTrait;
use Doctrine\ORM\EntityRepository;

class QuoteRepository extends EntityRepository
{
    use EntityTrait;
}