<?php

namespace App\Validation;
use Config\Database;

class Rules
{
     /**
     * Checks the database to see if the given value exist in db table.
     *
     * Example:
     *    in_db[table.field]
     *
     * @param string $str
     * @param string $field
     * @param array  $data
     * 
     * @author Alejandro D. Guevara <alejandro@wandu.ar>
     *
     * @return boolean
     */
    public function in_db(string $str = null, string $field, array $data, string &$error = null): bool
    {
        // Break the table and field apart
        sscanf($field, '%[^.].%[^.]', $table, $field);

        $db = Database::connect($data['DBGroup'] ?? null);

        $row = $db->table($table)
                  ->select('1')
                  ->where($field, $str)
                  ->limit(1);

        if ($row->get()->getRow() !== null)
        {
            return true;
        }

        $error = lang('Validation.in_db', ['table' => $table]);
        return false;
    }
}
