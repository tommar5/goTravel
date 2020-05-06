<?php
namespace App\Repository\Booking;

use App\Repository\EntityTrait;
use Doctrine\ORM\EntityRepository;

class BookingRepository extends EntityRepository
{
    use EntityTrait;
}