<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiTokenModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tokens';
    protected $primaryKey       = 'Token';
    protected $useAutoIncrement = false;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['UsageCount'];


    /**
     * Increment the UsageCount field by 1 each time and Token is successfully used.
     * @param string $key
     * @return bool
     */
    public function updateUsage(string $key): bool
    {
        try {
            return $this->set('UsageCount', 'UsageCount+1', false)
                ->where($this->primaryKey, $key)
                ->update();
        } catch (\ReflectionException $e) {
            return false;
        }
    }
}
