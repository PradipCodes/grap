<?php

namespace App\Model;

use App\Model\Base\UserQuery as BaseUserQuery;

/**
 * Skeleton subclass for performing query and update operations on the 'fos_user' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class UserQuery extends BaseUserQuery
{
    public function filter(array $filters = null, array $columns = array())
    {
        if (empty($filters)) {
            return $this;
        }

        $conditions = array();

        foreach ($columns as $name => $condition) {
            if (!array_key_exists($name, $filters)) {
                continue;
            }

            $value = trim($filters[$name]);

            if (empty($value) && !is_numeric($value)) {
                continue;
            }

            $this->condition(
                'search_'.$name,
                sprintf($condition, $value)
            );

            $conditions[] = 'search_'.$name;
        }

        if (!empty($conditions)) {
            return $this->where($conditions, 'and');
        }
    }

    public function sort(array $order = array())
    {
        foreach ($order as $setting) {
            $column = $setting[0];
            $direction = $setting[1];
            $this->orderBy($column, $direction);
        }

        return $this;
    }
}
