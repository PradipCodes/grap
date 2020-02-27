<?php

namespace App\Model\Base;

use \Exception;
use \PDO;
use App\Model\FosUser as ChildFosUser;
use App\Model\FosUserQuery as ChildFosUserQuery;
use App\Model\Map\FosUserTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'fos_user' table.
 *
 *
 *
 * @method     ChildFosUserQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildFosUserQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method     ChildFosUserQuery orderByUsernameCanonical($order = Criteria::ASC) Order by the username_canonical column
 * @method     ChildFosUserQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildFosUserQuery orderByEmailCanonical($order = Criteria::ASC) Order by the email_canonical column
 * @method     ChildFosUserQuery orderByEnabled($order = Criteria::ASC) Order by the enabled column
 * @method     ChildFosUserQuery orderBySalt($order = Criteria::ASC) Order by the salt column
 * @method     ChildFosUserQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     ChildFosUserQuery orderByLastLogin($order = Criteria::ASC) Order by the last_login column
 * @method     ChildFosUserQuery orderByLocked($order = Criteria::ASC) Order by the locked column
 * @method     ChildFosUserQuery orderByExpired($order = Criteria::ASC) Order by the expired column
 * @method     ChildFosUserQuery orderByExpiresAt($order = Criteria::ASC) Order by the expires_at column
 * @method     ChildFosUserQuery orderByConfirmationToken($order = Criteria::ASC) Order by the confirmation_token column
 * @method     ChildFosUserQuery orderByPasswordRequestedAt($order = Criteria::ASC) Order by the password_requested_at column
 * @method     ChildFosUserQuery orderByCredentialsExpired($order = Criteria::ASC) Order by the credentials_expired column
 * @method     ChildFosUserQuery orderByCredentialsExpireAt($order = Criteria::ASC) Order by the credentials_expire_at column
 * @method     ChildFosUserQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method     ChildFosUserQuery orderByAlgorithm($order = Criteria::ASC) Order by the algorithm column
 * @method     ChildFosUserQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildFosUserQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildFosUserQuery orderByFullName($order = Criteria::ASC) Order by the full_name column
 *
 * @method     ChildFosUserQuery groupById() Group by the id column
 * @method     ChildFosUserQuery groupByUsername() Group by the username column
 * @method     ChildFosUserQuery groupByUsernameCanonical() Group by the username_canonical column
 * @method     ChildFosUserQuery groupByEmail() Group by the email column
 * @method     ChildFosUserQuery groupByEmailCanonical() Group by the email_canonical column
 * @method     ChildFosUserQuery groupByEnabled() Group by the enabled column
 * @method     ChildFosUserQuery groupBySalt() Group by the salt column
 * @method     ChildFosUserQuery groupByPassword() Group by the password column
 * @method     ChildFosUserQuery groupByLastLogin() Group by the last_login column
 * @method     ChildFosUserQuery groupByLocked() Group by the locked column
 * @method     ChildFosUserQuery groupByExpired() Group by the expired column
 * @method     ChildFosUserQuery groupByExpiresAt() Group by the expires_at column
 * @method     ChildFosUserQuery groupByConfirmationToken() Group by the confirmation_token column
 * @method     ChildFosUserQuery groupByPasswordRequestedAt() Group by the password_requested_at column
 * @method     ChildFosUserQuery groupByCredentialsExpired() Group by the credentials_expired column
 * @method     ChildFosUserQuery groupByCredentialsExpireAt() Group by the credentials_expire_at column
 * @method     ChildFosUserQuery groupByCode() Group by the code column
 * @method     ChildFosUserQuery groupByAlgorithm() Group by the algorithm column
 * @method     ChildFosUserQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildFosUserQuery groupByPhone() Group by the phone column
 * @method     ChildFosUserQuery groupByFullName() Group by the full_name column
 *
 * @method     ChildFosUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFosUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFosUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFosUserQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFosUserQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFosUserQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFosUser findOne(ConnectionInterface $con = null) Return the first ChildFosUser matching the query
 * @method     ChildFosUser findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFosUser matching the query, or a new ChildFosUser object populated from the query conditions when no match is found
 *
 * @method     ChildFosUser findOneById(int $id) Return the first ChildFosUser filtered by the id column
 * @method     ChildFosUser findOneByUsername(string $username) Return the first ChildFosUser filtered by the username column
 * @method     ChildFosUser findOneByUsernameCanonical(string $username_canonical) Return the first ChildFosUser filtered by the username_canonical column
 * @method     ChildFosUser findOneByEmail(string $email) Return the first ChildFosUser filtered by the email column
 * @method     ChildFosUser findOneByEmailCanonical(string $email_canonical) Return the first ChildFosUser filtered by the email_canonical column
 * @method     ChildFosUser findOneByEnabled(boolean $enabled) Return the first ChildFosUser filtered by the enabled column
 * @method     ChildFosUser findOneBySalt(string $salt) Return the first ChildFosUser filtered by the salt column
 * @method     ChildFosUser findOneByPassword(string $password) Return the first ChildFosUser filtered by the password column
 * @method     ChildFosUser findOneByLastLogin(string $last_login) Return the first ChildFosUser filtered by the last_login column
 * @method     ChildFosUser findOneByLocked(boolean $locked) Return the first ChildFosUser filtered by the locked column
 * @method     ChildFosUser findOneByExpired(boolean $expired) Return the first ChildFosUser filtered by the expired column
 * @method     ChildFosUser findOneByExpiresAt(string $expires_at) Return the first ChildFosUser filtered by the expires_at column
 * @method     ChildFosUser findOneByConfirmationToken(string $confirmation_token) Return the first ChildFosUser filtered by the confirmation_token column
 * @method     ChildFosUser findOneByPasswordRequestedAt(string $password_requested_at) Return the first ChildFosUser filtered by the password_requested_at column
 * @method     ChildFosUser findOneByCredentialsExpired(boolean $credentials_expired) Return the first ChildFosUser filtered by the credentials_expired column
 * @method     ChildFosUser findOneByCredentialsExpireAt(string $credentials_expire_at) Return the first ChildFosUser filtered by the credentials_expire_at column
 * @method     ChildFosUser findOneByCode(int $code) Return the first ChildFosUser filtered by the code column
 * @method     ChildFosUser findOneByAlgorithm(string $algorithm) Return the first ChildFosUser filtered by the algorithm column
 * @method     ChildFosUser findOneByCreatedAt(string $created_at) Return the first ChildFosUser filtered by the created_at column
 * @method     ChildFosUser findOneByPhone(string $phone) Return the first ChildFosUser filtered by the phone column
 * @method     ChildFosUser findOneByFullName(string $full_name) Return the first ChildFosUser filtered by the full_name column *

 * @method     ChildFosUser requirePk($key, ConnectionInterface $con = null) Return the ChildFosUser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFosUser requireOne(ConnectionInterface $con = null) Return the first ChildFosUser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFosUser requireOneById(int $id) Return the first ChildFosUser filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFosUser requireOneByUsername(string $username) Return the first ChildFosUser filtered by the username column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFosUser requireOneByUsernameCanonical(string $username_canonical) Return the first ChildFosUser filtered by the username_canonical column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFosUser requireOneByEmail(string $email) Return the first ChildFosUser filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFosUser requireOneByEmailCanonical(string $email_canonical) Return the first ChildFosUser filtered by the email_canonical column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFosUser requireOneByEnabled(boolean $enabled) Return the first ChildFosUser filtered by the enabled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFosUser requireOneBySalt(string $salt) Return the first ChildFosUser filtered by the salt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFosUser requireOneByPassword(string $password) Return the first ChildFosUser filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFosUser requireOneByLastLogin(string $last_login) Return the first ChildFosUser filtered by the last_login column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFosUser requireOneByLocked(boolean $locked) Return the first ChildFosUser filtered by the locked column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFosUser requireOneByExpired(boolean $expired) Return the first ChildFosUser filtered by the expired column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFosUser requireOneByExpiresAt(string $expires_at) Return the first ChildFosUser filtered by the expires_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFosUser requireOneByConfirmationToken(string $confirmation_token) Return the first ChildFosUser filtered by the confirmation_token column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFosUser requireOneByPasswordRequestedAt(string $password_requested_at) Return the first ChildFosUser filtered by the password_requested_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFosUser requireOneByCredentialsExpired(boolean $credentials_expired) Return the first ChildFosUser filtered by the credentials_expired column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFosUser requireOneByCredentialsExpireAt(string $credentials_expire_at) Return the first ChildFosUser filtered by the credentials_expire_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFosUser requireOneByCode(int $code) Return the first ChildFosUser filtered by the code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFosUser requireOneByAlgorithm(string $algorithm) Return the first ChildFosUser filtered by the algorithm column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFosUser requireOneByCreatedAt(string $created_at) Return the first ChildFosUser filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFosUser requireOneByPhone(string $phone) Return the first ChildFosUser filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFosUser requireOneByFullName(string $full_name) Return the first ChildFosUser filtered by the full_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFosUser[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFosUser objects based on current ModelCriteria
 * @method     ChildFosUser[]|ObjectCollection findById(int $id) Return ChildFosUser objects filtered by the id column
 * @method     ChildFosUser[]|ObjectCollection findByUsername(string $username) Return ChildFosUser objects filtered by the username column
 * @method     ChildFosUser[]|ObjectCollection findByUsernameCanonical(string $username_canonical) Return ChildFosUser objects filtered by the username_canonical column
 * @method     ChildFosUser[]|ObjectCollection findByEmail(string $email) Return ChildFosUser objects filtered by the email column
 * @method     ChildFosUser[]|ObjectCollection findByEmailCanonical(string $email_canonical) Return ChildFosUser objects filtered by the email_canonical column
 * @method     ChildFosUser[]|ObjectCollection findByEnabled(boolean $enabled) Return ChildFosUser objects filtered by the enabled column
 * @method     ChildFosUser[]|ObjectCollection findBySalt(string $salt) Return ChildFosUser objects filtered by the salt column
 * @method     ChildFosUser[]|ObjectCollection findByPassword(string $password) Return ChildFosUser objects filtered by the password column
 * @method     ChildFosUser[]|ObjectCollection findByLastLogin(string $last_login) Return ChildFosUser objects filtered by the last_login column
 * @method     ChildFosUser[]|ObjectCollection findByLocked(boolean $locked) Return ChildFosUser objects filtered by the locked column
 * @method     ChildFosUser[]|ObjectCollection findByExpired(boolean $expired) Return ChildFosUser objects filtered by the expired column
 * @method     ChildFosUser[]|ObjectCollection findByExpiresAt(string $expires_at) Return ChildFosUser objects filtered by the expires_at column
 * @method     ChildFosUser[]|ObjectCollection findByConfirmationToken(string $confirmation_token) Return ChildFosUser objects filtered by the confirmation_token column
 * @method     ChildFosUser[]|ObjectCollection findByPasswordRequestedAt(string $password_requested_at) Return ChildFosUser objects filtered by the password_requested_at column
 * @method     ChildFosUser[]|ObjectCollection findByCredentialsExpired(boolean $credentials_expired) Return ChildFosUser objects filtered by the credentials_expired column
 * @method     ChildFosUser[]|ObjectCollection findByCredentialsExpireAt(string $credentials_expire_at) Return ChildFosUser objects filtered by the credentials_expire_at column
 * @method     ChildFosUser[]|ObjectCollection findByCode(int $code) Return ChildFosUser objects filtered by the code column
 * @method     ChildFosUser[]|ObjectCollection findByAlgorithm(string $algorithm) Return ChildFosUser objects filtered by the algorithm column
 * @method     ChildFosUser[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildFosUser objects filtered by the created_at column
 * @method     ChildFosUser[]|ObjectCollection findByPhone(string $phone) Return ChildFosUser objects filtered by the phone column
 * @method     ChildFosUser[]|ObjectCollection findByFullName(string $full_name) Return ChildFosUser objects filtered by the full_name column
 * @method     ChildFosUser[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FosUserQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Model\Base\FosUserQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\Model\\FosUser', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFosUserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFosUserQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFosUserQuery) {
            return $criteria;
        }
        $query = new ChildFosUserQuery();
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
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildFosUser|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FosUserTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FosUserTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFosUser A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, credentials_expired, credentials_expire_at, code, algorithm, created_at, phone, full_name FROM fos_user WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildFosUser $obj */
            $obj = new ChildFosUser();
            $obj->hydrate($row);
            FosUserTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFosUser|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(12, 56, 832), $con);
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
     * @return $this|ChildFosUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FosUserTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFosUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FosUserTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFosUserQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(FosUserTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(FosUserTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FosUserTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the username column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername('fooValue');   // WHERE username = 'fooValue'
     * $query->filterByUsername('%fooValue%', Criteria::LIKE); // WHERE username LIKE '%fooValue%'
     * </code>
     *
     * @param     string $username The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFosUserQuery The current query, for fluid interface
     */
    public function filterByUsername($username = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FosUserTableMap::COL_USERNAME, $username, $comparison);
    }

    /**
     * Filter the query on the username_canonical column
     *
     * Example usage:
     * <code>
     * $query->filterByUsernameCanonical('fooValue');   // WHERE username_canonical = 'fooValue'
     * $query->filterByUsernameCanonical('%fooValue%', Criteria::LIKE); // WHERE username_canonical LIKE '%fooValue%'
     * </code>
     *
     * @param     string $usernameCanonical The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFosUserQuery The current query, for fluid interface
     */
    public function filterByUsernameCanonical($usernameCanonical = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($usernameCanonical)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FosUserTableMap::COL_USERNAME_CANONICAL, $usernameCanonical, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFosUserQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FosUserTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the email_canonical column
     *
     * Example usage:
     * <code>
     * $query->filterByEmailCanonical('fooValue');   // WHERE email_canonical = 'fooValue'
     * $query->filterByEmailCanonical('%fooValue%', Criteria::LIKE); // WHERE email_canonical LIKE '%fooValue%'
     * </code>
     *
     * @param     string $emailCanonical The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFosUserQuery The current query, for fluid interface
     */
    public function filterByEmailCanonical($emailCanonical = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($emailCanonical)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FosUserTableMap::COL_EMAIL_CANONICAL, $emailCanonical, $comparison);
    }

    /**
     * Filter the query on the enabled column
     *
     * Example usage:
     * <code>
     * $query->filterByEnabled(true); // WHERE enabled = true
     * $query->filterByEnabled('yes'); // WHERE enabled = true
     * </code>
     *
     * @param     boolean|string $enabled The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFosUserQuery The current query, for fluid interface
     */
    public function filterByEnabled($enabled = null, $comparison = null)
    {
        if (is_string($enabled)) {
            $enabled = in_array(strtolower($enabled), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(FosUserTableMap::COL_ENABLED, $enabled, $comparison);
    }

    /**
     * Filter the query on the salt column
     *
     * Example usage:
     * <code>
     * $query->filterBySalt('fooValue');   // WHERE salt = 'fooValue'
     * $query->filterBySalt('%fooValue%', Criteria::LIKE); // WHERE salt LIKE '%fooValue%'
     * </code>
     *
     * @param     string $salt The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFosUserQuery The current query, for fluid interface
     */
    public function filterBySalt($salt = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($salt)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FosUserTableMap::COL_SALT, $salt, $comparison);
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%', Criteria::LIKE); // WHERE password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFosUserQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FosUserTableMap::COL_PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query on the last_login column
     *
     * Example usage:
     * <code>
     * $query->filterByLastLogin('2011-03-14'); // WHERE last_login = '2011-03-14'
     * $query->filterByLastLogin('now'); // WHERE last_login = '2011-03-14'
     * $query->filterByLastLogin(array('max' => 'yesterday')); // WHERE last_login > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastLogin The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFosUserQuery The current query, for fluid interface
     */
    public function filterByLastLogin($lastLogin = null, $comparison = null)
    {
        if (is_array($lastLogin)) {
            $useMinMax = false;
            if (isset($lastLogin['min'])) {
                $this->addUsingAlias(FosUserTableMap::COL_LAST_LOGIN, $lastLogin['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastLogin['max'])) {
                $this->addUsingAlias(FosUserTableMap::COL_LAST_LOGIN, $lastLogin['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FosUserTableMap::COL_LAST_LOGIN, $lastLogin, $comparison);
    }

    /**
     * Filter the query on the locked column
     *
     * Example usage:
     * <code>
     * $query->filterByLocked(true); // WHERE locked = true
     * $query->filterByLocked('yes'); // WHERE locked = true
     * </code>
     *
     * @param     boolean|string $locked The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFosUserQuery The current query, for fluid interface
     */
    public function filterByLocked($locked = null, $comparison = null)
    {
        if (is_string($locked)) {
            $locked = in_array(strtolower($locked), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(FosUserTableMap::COL_LOCKED, $locked, $comparison);
    }

    /**
     * Filter the query on the expired column
     *
     * Example usage:
     * <code>
     * $query->filterByExpired(true); // WHERE expired = true
     * $query->filterByExpired('yes'); // WHERE expired = true
     * </code>
     *
     * @param     boolean|string $expired The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFosUserQuery The current query, for fluid interface
     */
    public function filterByExpired($expired = null, $comparison = null)
    {
        if (is_string($expired)) {
            $expired = in_array(strtolower($expired), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(FosUserTableMap::COL_EXPIRED, $expired, $comparison);
    }

    /**
     * Filter the query on the expires_at column
     *
     * Example usage:
     * <code>
     * $query->filterByExpiresAt('2011-03-14'); // WHERE expires_at = '2011-03-14'
     * $query->filterByExpiresAt('now'); // WHERE expires_at = '2011-03-14'
     * $query->filterByExpiresAt(array('max' => 'yesterday')); // WHERE expires_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $expiresAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFosUserQuery The current query, for fluid interface
     */
    public function filterByExpiresAt($expiresAt = null, $comparison = null)
    {
        if (is_array($expiresAt)) {
            $useMinMax = false;
            if (isset($expiresAt['min'])) {
                $this->addUsingAlias(FosUserTableMap::COL_EXPIRES_AT, $expiresAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expiresAt['max'])) {
                $this->addUsingAlias(FosUserTableMap::COL_EXPIRES_AT, $expiresAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FosUserTableMap::COL_EXPIRES_AT, $expiresAt, $comparison);
    }

    /**
     * Filter the query on the confirmation_token column
     *
     * Example usage:
     * <code>
     * $query->filterByConfirmationToken('fooValue');   // WHERE confirmation_token = 'fooValue'
     * $query->filterByConfirmationToken('%fooValue%', Criteria::LIKE); // WHERE confirmation_token LIKE '%fooValue%'
     * </code>
     *
     * @param     string $confirmationToken The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFosUserQuery The current query, for fluid interface
     */
    public function filterByConfirmationToken($confirmationToken = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($confirmationToken)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FosUserTableMap::COL_CONFIRMATION_TOKEN, $confirmationToken, $comparison);
    }

    /**
     * Filter the query on the password_requested_at column
     *
     * Example usage:
     * <code>
     * $query->filterByPasswordRequestedAt('2011-03-14'); // WHERE password_requested_at = '2011-03-14'
     * $query->filterByPasswordRequestedAt('now'); // WHERE password_requested_at = '2011-03-14'
     * $query->filterByPasswordRequestedAt(array('max' => 'yesterday')); // WHERE password_requested_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $passwordRequestedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFosUserQuery The current query, for fluid interface
     */
    public function filterByPasswordRequestedAt($passwordRequestedAt = null, $comparison = null)
    {
        if (is_array($passwordRequestedAt)) {
            $useMinMax = false;
            if (isset($passwordRequestedAt['min'])) {
                $this->addUsingAlias(FosUserTableMap::COL_PASSWORD_REQUESTED_AT, $passwordRequestedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($passwordRequestedAt['max'])) {
                $this->addUsingAlias(FosUserTableMap::COL_PASSWORD_REQUESTED_AT, $passwordRequestedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FosUserTableMap::COL_PASSWORD_REQUESTED_AT, $passwordRequestedAt, $comparison);
    }

    /**
     * Filter the query on the credentials_expired column
     *
     * Example usage:
     * <code>
     * $query->filterByCredentialsExpired(true); // WHERE credentials_expired = true
     * $query->filterByCredentialsExpired('yes'); // WHERE credentials_expired = true
     * </code>
     *
     * @param     boolean|string $credentialsExpired The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFosUserQuery The current query, for fluid interface
     */
    public function filterByCredentialsExpired($credentialsExpired = null, $comparison = null)
    {
        if (is_string($credentialsExpired)) {
            $credentialsExpired = in_array(strtolower($credentialsExpired), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(FosUserTableMap::COL_CREDENTIALS_EXPIRED, $credentialsExpired, $comparison);
    }

    /**
     * Filter the query on the credentials_expire_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCredentialsExpireAt('2011-03-14'); // WHERE credentials_expire_at = '2011-03-14'
     * $query->filterByCredentialsExpireAt('now'); // WHERE credentials_expire_at = '2011-03-14'
     * $query->filterByCredentialsExpireAt(array('max' => 'yesterday')); // WHERE credentials_expire_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $credentialsExpireAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFosUserQuery The current query, for fluid interface
     */
    public function filterByCredentialsExpireAt($credentialsExpireAt = null, $comparison = null)
    {
        if (is_array($credentialsExpireAt)) {
            $useMinMax = false;
            if (isset($credentialsExpireAt['min'])) {
                $this->addUsingAlias(FosUserTableMap::COL_CREDENTIALS_EXPIRE_AT, $credentialsExpireAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($credentialsExpireAt['max'])) {
                $this->addUsingAlias(FosUserTableMap::COL_CREDENTIALS_EXPIRE_AT, $credentialsExpireAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FosUserTableMap::COL_CREDENTIALS_EXPIRE_AT, $credentialsExpireAt, $comparison);
    }

    /**
     * Filter the query on the code column
     *
     * Example usage:
     * <code>
     * $query->filterByCode(1234); // WHERE code = 1234
     * $query->filterByCode(array(12, 34)); // WHERE code IN (12, 34)
     * $query->filterByCode(array('min' => 12)); // WHERE code > 12
     * </code>
     *
     * @param     mixed $code The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFosUserQuery The current query, for fluid interface
     */
    public function filterByCode($code = null, $comparison = null)
    {
        if (is_array($code)) {
            $useMinMax = false;
            if (isset($code['min'])) {
                $this->addUsingAlias(FosUserTableMap::COL_CODE, $code['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($code['max'])) {
                $this->addUsingAlias(FosUserTableMap::COL_CODE, $code['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FosUserTableMap::COL_CODE, $code, $comparison);
    }

    /**
     * Filter the query on the algorithm column
     *
     * Example usage:
     * <code>
     * $query->filterByAlgorithm('fooValue');   // WHERE algorithm = 'fooValue'
     * $query->filterByAlgorithm('%fooValue%', Criteria::LIKE); // WHERE algorithm LIKE '%fooValue%'
     * </code>
     *
     * @param     string $algorithm The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFosUserQuery The current query, for fluid interface
     */
    public function filterByAlgorithm($algorithm = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($algorithm)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FosUserTableMap::COL_ALGORITHM, $algorithm, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFosUserQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(FosUserTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(FosUserTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FosUserTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%', Criteria::LIKE); // WHERE phone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phone The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFosUserQuery The current query, for fluid interface
     */
    public function filterByPhone($phone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FosUserTableMap::COL_PHONE, $phone, $comparison);
    }

    /**
     * Filter the query on the full_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFullName('fooValue');   // WHERE full_name = 'fooValue'
     * $query->filterByFullName('%fooValue%', Criteria::LIKE); // WHERE full_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fullName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFosUserQuery The current query, for fluid interface
     */
    public function filterByFullName($fullName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fullName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FosUserTableMap::COL_FULL_NAME, $fullName, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFosUser $fosUser Object to remove from the list of results
     *
     * @return $this|ChildFosUserQuery The current query, for fluid interface
     */
    public function prune($fosUser = null)
    {
        if ($fosUser) {
            $this->addUsingAlias(FosUserTableMap::COL_ID, $fosUser->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the fos_user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FosUserTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FosUserTableMap::clearInstancePool();
            FosUserTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FosUserTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FosUserTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FosUserTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FosUserTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FosUserQuery
