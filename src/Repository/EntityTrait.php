<?php
namespace App\Repository;

trait EntityTrait
{
    public function createNew()
    {
        return new $this->_entityName;
    }

    public function save($entity, $flush = true)
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }

        return $entity;
    }

    public function update($entity, $flush = true)
    {
        $this->_em->merge($entity);
        if ($flush) {
            $this->_em->flush();
        }

        return $entity;
    }

    public function remove($entity, $flush = true)
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
}