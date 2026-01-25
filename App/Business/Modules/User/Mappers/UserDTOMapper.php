<?php

namespace App\Business\Modules\User\Mappers;

use App\Business\Modules\User\Mappers\Factory\UserItemFactory;
use App\Business\Modules\User\Mappers\ItemMappers\UserItemType;
use App\Domain\Entities\DataTransferObjects\UserDTO\BaseUserDTO;
use App\Domain\Entities\DataTransferObjects\UserDTO\UserCollectionDTO;

class UserDTOMapper
{
    public function __construct(private UserItemFactory $factory) {}

    /**
     * Map all users
     * 
     * @param array $users
     * @param UserItemType $type
     * @return UserCollectionDTO
     */
    public function map(array $users, UserItemType $type): UserCollectionDTO
    {
        $collection = new UserCollectionDTO();

        $itemMapper = $this->factory->createItemMapper($type);

        foreach ($users as $user) {
            $collection->append($itemMapper->mapItem($user));
        }

        return $collection;
    }

    /**
     * Map one user
     * 
     * @param array $user
     * @param UserItemType $type
     * @return BaseUserDTO
     */
    public function mapOne(array $user, UserItemType $type): BaseUserDTO
    {
        return $this->factory->createItemMapper($type)->mapItem($user);
    }
}