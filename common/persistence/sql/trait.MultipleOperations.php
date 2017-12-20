<?php
/**
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; under version 2
 * of the License (non-upgradable).
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * Copyright (c) 2017 (original work) Open Assessment Technologies SA (under the project TAO-PRODUCT);
 *
 * @author "Jérôme Bogaerts, <jerome@taotesting.com>"
 * @license GPLv2
 * @package generis
 *
 */

trait common_persistence_sql_MultipleOperations
{
    public function insertMultiple($tableName, array $data)
    {
        if (is_array($data) && count($data) > 0) {

            $platform = $this->getPlatform();

            $quotedColumnIdentifiers = array_map(
                function ($value) use ($platform) {
                    return $platform->quoteIdentifier($value);
                },
                array_keys($data[0])
            );

            $query = "INSERT INTO ${tableName} (" . implode(', ', $quotedColumnIdentifiers) . ') VALUES ';
            $valuesQueries = [];
            $allValues = [];

            foreach ($data as $values) {
                $valuesQueries[] .= '(' . implode(', ', array_fill(0, count($values), '?')) . ')';
                $allValues = array_merge($allValues, array_values($values));
            }

            $query .= implode(', ', $valuesQueries);

            return $this->exec($query, $allValues);
        } else {
            return 0;
        }
    }

    /**
     * @example
     *  'table_name'
     *  'data' =>
     * [
     *      [
     *          'conditions' => [
     *              'c1' => 'c1value',
     *              'c2' => 'c2value'
     *          ]
     *          'updateValues' => [
     *              'c3' => 'c3value'
     *          ]
     *      ],
     *      [
     *          'conditions' => [
     *              'c1' => 'c1value',
     *              'c2' => 'c2value',
     *              'c3' => 'c3value',
     *          ]
     *          'updateValues' => [
     *              'c9' => 'c8value'
     *          ]
     *      ]
     *  ]
     *
     * @param string $table
     * @param array $data
     * @return bool
     * @throws Exception
     */
    public function updateMultiple($table, array $data)
    {
        if (empty($data)) {
            return false;
        }

        $prepareQueryData = [];
        $allColumns = [];
        $params = [];

        foreach ($data as $row) {
            if (empty($row['conditions']) || empty($row['updateValues'])) {
                throw new Exception('You must provide conditions and updateValues');
            }

            $conditions = $row['conditions'];
            $updateValues = $row['updateValues'];

            foreach ($updateValues as $updateColumn => $updateValue) {
                $whens = [];
                foreach ($conditions as $conditionColumn => $conditionValue) {
                    $whens[] = ['conditionColumn' => $conditionColumn, 'conditionValue' => $conditionValue];
                }
                $prepareQueryData[$updateColumn][] = ['value' => $updateValue, 'conditions' => $whens];
            }
        }


        $queryColumns = [];
        foreach ($prepareQueryData as $column => $queryData) {
            $queryColumnUpdate = " $column = ( CASE ";

            foreach ($queryData as $index => $datum) {
                $conditions = $datum['conditions'];
                $updateValue = $datum['value'];
                $conditionsString = [];

                foreach ($conditions as $indexCondition => $condition) {
                    $conditionColumn = $condition['conditionColumn'];
                    $conditionValue = $condition['conditionValue'];

                    $key = ':' .$index . '_' .$column. '_'  . $indexCondition . '_' . $conditionColumn . '_conditionvalue';
                    $conditionsString[] = " $conditionColumn = $key ";
                    $allColumns[$conditionColumn][] = $conditionValue;
                    $params[$key] = $conditionValue;
                }


                $key = ':' . $index . '_' . $column . '_updatedvalue';
                $queryColumnUpdate .= " WHEN " . implode(' AND ', $conditionsString) . " THEN $key";
                $params[$key] = $updateValue;
            }


            $queryColumnUpdate .= " ELSE $column END)";
            $queryColumns[] = $queryColumnUpdate;
        }

        $query = 'UPDATE ' . $table . ' SET ' . implode(', ', $queryColumns);
        $wheres = [];

        foreach ($allColumns as $columnWhere => $columnWhereValues) {
            $uniqueColumnValues = array_unique($columnWhereValues);
            $placeHolders = [];
            foreach ($uniqueColumnValues as $index => $value) {
                $key = ':in_condition_' . $columnWhere . '_' . $index;
                $placeHolders[] = $key;
                $params[$key] = $value;
            }
            $placeHolders = implode(',', $placeHolders);
            $wheres[] = " $columnWhere IN ($placeHolders)";
        }

        $query .= ' WHERE ' . implode(' AND ', $wheres);

        return $this->exec($query, $params);
    }
}