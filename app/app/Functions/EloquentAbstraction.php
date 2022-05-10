<?php

namespace App\Functions;

use App\Functions\Time;

class EloquentAbstraction
{
    public static function addQueryRule($query, $column, $filter, $type = null, $formatDate = null)
    {

        if (!isset($filter) || !isset($column) || !isset($query))
            return $query;

        $cleanFilter = self::clearFilter($filter);

        $filter = strtolower($filter);

        $comparision = self::searchComparision($filter);
        if ($comparision) {
            if (isset($type) && isset($formatDate) && $type == 'date') {
                try {
                    $date = Time::millisecondsToDateFormat($cleanFilter, $formatDate);
                    return $query->where($column, $comparision, $date);
                } catch(\Exception $e) {
                    return $query;
                }
            } else {
                return $query->where($column, $comparision, $cleanFilter);
            }
        }

        $like = strstr($filter, '==');
        if ($like) {
            return $query->where($column, 'LIKE', $cleanFilter);
        }

        $not = strstr($filter, '!');

        $or = strstr($filter, '||');
        if ($or) {
            if ($not) {
                return $query->orWhere($column, "!=", $cleanFilter);
            } else {
                return $query->orWhere($column, "=", $cleanFilter);
            }
        }

        $to = strstr($filter, '|to|');
        if ($to) {
            if ($not) {
                $filter = str_replace('!', "", $filter);
                $vals = explode('to', $filter);
                return $query->whereNotBetween($column, $vals);
            } else {
                $vals = explode('to', $filter);
                return $query->whereBetween($column, $vals);
            }
        }

        $nullRule = strstr($filter, 'null');
        if ($nullRule) {
            if ($not) {
                return $query->whereNotNull($column);
            } else {
                return $query->whereNull($column);
            }
        }

        $filterArray = explode(',', $cleanFilter);
        if (count($filterArray) > 1) {
            if ($not) {
                return $query->whereNotIn($column, $filterArray);
            } else {
                return $query->whereIn($column, $filterArray);
            }
        }

        if ($not) {
            return $query->where($column, "!=", $cleanFilter);
        } else {
            return $query->where($column, '=', $cleanFilter);
        }

    }

    private static function clearFilter($filter) {
        $cleanFilter = $filter;
        $symbol = ['<=', '<', '>=', '>', '==', '||', '|to|', 'null', '!'];
        foreach ($symbol as $key => $value) {
            $cleanFilter = str_replace($value, "", $cleanFilter);
        }
        return $cleanFilter;
    }

    private static function searchComparision($filter) {
        $comparision = false;
        $comparisionArray = ['<=', '<', '>=', '>'];
        foreach ($comparisionArray as $key => $value) {
            $comparision = strstr($filter, $value);
            if ($comparision) {
                $comparision = $value;
                break;
            }
        }
        return $comparision;
    }
}



