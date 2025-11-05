<?php

namespace App\Models;

use Core\Model;
use Configs\Database;
use PDOException;
use Traits\ModelTrait;

class Address extends Model
{
    use ModelTrait;

    private int $address_id;
    private string $street;
    private string $city;

    public function __construct(Database $db)
    {
        parent::__construct($db);
    }

    /**
     * Create new address
     * @return bool|int|string
     */
    public function createAddress(): int
    {
        try {
            return $this->insert('address', [
                'street' => $this->street,
                'city' => $this->city
            ]);
        } catch (PDOException $e) {
            print $e->getMessage();
            return 0;
        }
    }

    /**
     * Update address by id
     * @param int $address_id
     * @return void
     */
    public function updateAddressById(int $address_id): void
    {
        $params = [
            'street' => $this->street,
            'city' => $this->city,
            'address_id' => $address_id
        ];

        $sql = "UPDATE address
                SET street = ?, city = ?
                WHERE id = ?";

        try {
            $this->update($sql, $params);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    /**
     * Delete address from database
     * @param int $address_id
     * @return void
     */
    public function deleteAddress(int $address_id): void
    {
        $params = ['address_id' => $address_id];

        $sql = "DELETE FROM users WHERE id = ?";

        try {
            $this->delete($sql, $params);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }
}
