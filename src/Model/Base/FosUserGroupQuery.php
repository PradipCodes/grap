<?php

namespace App\Model\Base;

use \Exception;
use \PDO;
use App\Model\FosUserGroup as ChildFosUserGroup;
use App\Model\FosUserGroupQuery as ChildFosUserGroupQuery;
use App\Model\Map\FosUserGroupTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'fos_user_group' table.
 *
 *
 *
 * @method     ChildFosUserGroupQuery orderByFosUserId($order = Criteria::ASC) Order by the fos_user_id column
 * @method     ChildFosUserGroupQuery orderByFosGroupId($order = Criteria::ASC) Order by the fos_group_id column
 *
 * @method     ChildFosUserGroupQuery groupByFosUserId() Group by the fos_user_id column
 * @method     ChildFosUserGroupQuery groupByFosGroupId() Group by the fos_group_id column
 *
 * @method     ChildFosUserGroupQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFosUserGroupQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFosUserGroupQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFosUserGroupQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFosUserGroupQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFosUserGroupQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFosUserGroup findOne(ConnectionInterface $con = null) Return the first ChildFosUserGroup matching the query
 * @method     ChildFosUserGroup findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFosUserGroup matching the query, or a new ChildFosUserGroup object populated from the query conditions when no match is found
 *
 * @method     ChildFosUserGroup findOneByFosUserId(int $fos_user_id) Return the first ChildFosUserGroup filtered by the fos_user_id column
 * @method     ChildFosUserGroup findOneByFosGroupId(int $fos_group_id) Return the first ChildFosUserGroup filtered by the fos_group_id column *

 * @method     ChildFosUserGroup requirePk($key, ConnectionInterface $con = null) Return the ChildFosUserGroup by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFosUserGroup requireOne(ConnectionInterface $con = null) Return the first ChildFosUserGroup matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFosUserGroup requireOneByFosUserId(int $fos_user_id) Return the first ChildFosUserGroup filtered by the fos_user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFosUserGroup requireOneByFosGroupId(int $fos_group_id) Return the first ChildFosUserGroup filtered by the fos_group_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFosUserGroup[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFosUserGroup objects based on current ModelCriteria
 * @method     ChildFosUserGroup[]|ObjectCollection findByFosUserId(int $fos_user_id) Return ChildFosUserGroup objects filtered by the fos_user_id column
 * @method     ChildFosUserGroup[]|ObjectCollection findByFosGroupId(int $fos_group_id) Return ChildFosUserGroup objects filtered by the fos_group_id column
 * @method     ChildFosUserGroup[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FosUserGroupQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Model\Base\FosUserGroupQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\Model\\FosUserGroup', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFosUserGroupQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFosUserGroupQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFosUserGroupQuery) {
            return $criteria;
        }
        $query = new ChildFosUserGroupQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$fos_user_id, $fos_group_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildFosUserGroup|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FosUserGroupTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FosUserGroupTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFosUserGroup A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT fos_user_id, fos_group_id FROM fos_user_group WHERE fos_user_id = :p0 AND fos_group_id = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildFosUserGroup $obj */
            $obj = new ChildFosUserGroup();
            $obj->hydrate($row);
            FosUserGroupTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildFosUserGroup|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildFosUserGroupQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(FosUserGroupTableMap::COL_FOS_USER_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(FosUserGroupTableMap::COL_FOS_GROUP_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFosUserGroupQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(FosUserGroupTableMap::COL_FOS_USER_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(FosUserGroupTableMap::COL_FOS_GROUP_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the fos_user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFosUserId(1234); // WHERE fos_user_id = 1234
     * $query->filterByFosUserId(array(12, 34)); // WHERE fos_user_id IN (12, 34)
     * $query->filterByFosUserId(array('min' => 12)); // WHERE fos_user_id > 12
     * </code>
     *
     * @param     mixed $fosUserId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFosUserGroupQuery The current query, for fluid interface
     */
    public function filterByFosUserId($fosUserId = null, $comparison = null)
    {
        if (is_array($fosUserId)) {
            $useMinMax = false;
            if (isset($fosUserId['min'])) {
                $this->addUsingAlias(FosUserGroupTableMap::COL_FOS_USER_ID, $fosUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fosUserId['max'])) {
                $this->addUsingAlias(FosUserGroupTableMap::COL_FOS_USER_ID, $fosUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FosUserGroupTableMap::COL_FOS_USER_ID, $fosUserId, $comparison);
    }

    /**
     * Filter the query on the fos_group_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFosGroupId(1234); // WHERE fos_group_id = 1234
     * $query->filterByFosGroupId(array(12, 34)); // WHERE fos_group_id IN (12, 34)
     * $query->filterByFosGroupId(array('min' => 12)); // WHERE fos_group_id > 12
     * </code>
     *
     * @param     mixed $fosGroupId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFosUserGroupQuery The current query, for fluid interface
     */
    public function filterByFosGroupId($fosGroupId = null, $comparison = null)
    {
        if (is_array($fosGroupId)) {
            $useMinMax = false;
            if (isset($fosGroupId['min'])) {
                $this->addUsingAlias(FosUserGroupTableMap::COL_FOS_GROUP_ID, $fosGroupId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fosGroupId['max'])) {
                $this->addUsingAlias(FosUserGroupTableMap::COL_FOS_GROUP_ID, $fosGroupId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FosUserGroupTableMap::COL_FOS_GROUP_ID, $fosGroupId, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFosUserGroup $fosUserGroup Object to remove from the list of results
     *
     * @return $this|ChildFosUserGroupQuery The current query, for fluid interface
     */
    public function prune($fosUserGroup = null)
    {
        if ($fosUserGroup) {
            $this->addCond('pruneCond0', $this->getAliasedColName(FosUserGroupTableMap::COL_FOS_USER_ID), $fosUserGroup->getFosUserId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(FosUserGroupTableMap::COL_FOS_GROUP_ID), $fosUserGroup->getFosGroupId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the fos_user_group table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FosUserGroupTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FosUserGroupTableMap::clearInstancePool();
            FosUserGroupTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FosUserGroupTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FosUserGroupTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FosUserGroupTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FosUserGroupTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FosUserGroupQuery
