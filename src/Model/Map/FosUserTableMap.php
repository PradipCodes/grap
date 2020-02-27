<?php

namespace App\Model\Map;

use App\Model\FosUser;
use App\Model\FosUserQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'fos_user' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class FosUserTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Model.Map.FosUserTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'fos_user';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\App\\Model\\FosUser';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'src.Model.FosUser';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 21;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 21;

    /**
     * the column name for the id field
     */
    const COL_ID = 'fos_user.id';

    /**
     * the column name for the username field
     */
    const COL_USERNAME = 'fos_user.username';

    /**
     * the column name for the username_canonical field
     */
    const COL_USERNAME_CANONICAL = 'fos_user.username_canonical';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'fos_user.email';

    /**
     * the column name for the email_canonical field
     */
    const COL_EMAIL_CANONICAL = 'fos_user.email_canonical';

    /**
     * the column name for the enabled field
     */
    const COL_ENABLED = 'fos_user.enabled';

    /**
     * the column name for the salt field
     */
    const COL_SALT = 'fos_user.salt';

    /**
     * the column name for the password field
     */
    const COL_PASSWORD = 'fos_user.password';

    /**
     * the column name for the last_login field
     */
    const COL_LAST_LOGIN = 'fos_user.last_login';

    /**
     * the column name for the locked field
     */
    const COL_LOCKED = 'fos_user.locked';

    /**
     * the column name for the expired field
     */
    const COL_EXPIRED = 'fos_user.expired';

    /**
     * the column name for the expires_at field
     */
    const COL_EXPIRES_AT = 'fos_user.expires_at';

    /**
     * the column name for the confirmation_token field
     */
    const COL_CONFIRMATION_TOKEN = 'fos_user.confirmation_token';

    /**
     * the column name for the password_requested_at field
     */
    const COL_PASSWORD_REQUESTED_AT = 'fos_user.password_requested_at';

    /**
     * the column name for the credentials_expired field
     */
    const COL_CREDENTIALS_EXPIRED = 'fos_user.credentials_expired';

    /**
     * the column name for the credentials_expire_at field
     */
    const COL_CREDENTIALS_EXPIRE_AT = 'fos_user.credentials_expire_at';

    /**
     * the column name for the code field
     */
    const COL_CODE = 'fos_user.code';

    /**
     * the column name for the algorithm field
     */
    const COL_ALGORITHM = 'fos_user.algorithm';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'fos_user.created_at';

    /**
     * the column name for the phone field
     */
    const COL_PHONE = 'fos_user.phone';

    /**
     * the column name for the full_name field
     */
    const COL_FULL_NAME = 'fos_user.full_name';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Username', 'UsernameCanonical', 'Email', 'EmailCanonical', 'Enabled', 'Salt', 'Password', 'LastLogin', 'Locked', 'Expired', 'ExpiresAt', 'ConfirmationToken', 'PasswordRequestedAt', 'CredentialsExpired', 'CredentialsExpireAt', 'Code', 'Algorithm', 'CreatedAt', 'Phone', 'FullName', ),
        self::TYPE_CAMELNAME     => array('id', 'username', 'usernameCanonical', 'email', 'emailCanonical', 'enabled', 'salt', 'password', 'lastLogin', 'locked', 'expired', 'expiresAt', 'confirmationToken', 'passwordRequestedAt', 'credentialsExpired', 'credentialsExpireAt', 'code', 'algorithm', 'createdAt', 'phone', 'fullName', ),
        self::TYPE_COLNAME       => array(FosUserTableMap::COL_ID, FosUserTableMap::COL_USERNAME, FosUserTableMap::COL_USERNAME_CANONICAL, FosUserTableMap::COL_EMAIL, FosUserTableMap::COL_EMAIL_CANONICAL, FosUserTableMap::COL_ENABLED, FosUserTableMap::COL_SALT, FosUserTableMap::COL_PASSWORD, FosUserTableMap::COL_LAST_LOGIN, FosUserTableMap::COL_LOCKED, FosUserTableMap::COL_EXPIRED, FosUserTableMap::COL_EXPIRES_AT, FosUserTableMap::COL_CONFIRMATION_TOKEN, FosUserTableMap::COL_PASSWORD_REQUESTED_AT, FosUserTableMap::COL_CREDENTIALS_EXPIRED, FosUserTableMap::COL_CREDENTIALS_EXPIRE_AT, FosUserTableMap::COL_CODE, FosUserTableMap::COL_ALGORITHM, FosUserTableMap::COL_CREATED_AT, FosUserTableMap::COL_PHONE, FosUserTableMap::COL_FULL_NAME, ),
        self::TYPE_FIELDNAME     => array('id', 'username', 'username_canonical', 'email', 'email_canonical', 'enabled', 'salt', 'password', 'last_login', 'locked', 'expired', 'expires_at', 'confirmation_token', 'password_requested_at', 'credentials_expired', 'credentials_expire_at', 'code', 'algorithm', 'created_at', 'phone', 'full_name', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Username' => 1, 'UsernameCanonical' => 2, 'Email' => 3, 'EmailCanonical' => 4, 'Enabled' => 5, 'Salt' => 6, 'Password' => 7, 'LastLogin' => 8, 'Locked' => 9, 'Expired' => 10, 'ExpiresAt' => 11, 'ConfirmationToken' => 12, 'PasswordRequestedAt' => 13, 'CredentialsExpired' => 14, 'CredentialsExpireAt' => 15, 'Code' => 16, 'Algorithm' => 17, 'CreatedAt' => 18, 'Phone' => 19, 'FullName' => 20, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'username' => 1, 'usernameCanonical' => 2, 'email' => 3, 'emailCanonical' => 4, 'enabled' => 5, 'salt' => 6, 'password' => 7, 'lastLogin' => 8, 'locked' => 9, 'expired' => 10, 'expiresAt' => 11, 'confirmationToken' => 12, 'passwordRequestedAt' => 13, 'credentialsExpired' => 14, 'credentialsExpireAt' => 15, 'code' => 16, 'algorithm' => 17, 'createdAt' => 18, 'phone' => 19, 'fullName' => 20, ),
        self::TYPE_COLNAME       => array(FosUserTableMap::COL_ID => 0, FosUserTableMap::COL_USERNAME => 1, FosUserTableMap::COL_USERNAME_CANONICAL => 2, FosUserTableMap::COL_EMAIL => 3, FosUserTableMap::COL_EMAIL_CANONICAL => 4, FosUserTableMap::COL_ENABLED => 5, FosUserTableMap::COL_SALT => 6, FosUserTableMap::COL_PASSWORD => 7, FosUserTableMap::COL_LAST_LOGIN => 8, FosUserTableMap::COL_LOCKED => 9, FosUserTableMap::COL_EXPIRED => 10, FosUserTableMap::COL_EXPIRES_AT => 11, FosUserTableMap::COL_CONFIRMATION_TOKEN => 12, FosUserTableMap::COL_PASSWORD_REQUESTED_AT => 13, FosUserTableMap::COL_CREDENTIALS_EXPIRED => 14, FosUserTableMap::COL_CREDENTIALS_EXPIRE_AT => 15, FosUserTableMap::COL_CODE => 16, FosUserTableMap::COL_ALGORITHM => 17, FosUserTableMap::COL_CREATED_AT => 18, FosUserTableMap::COL_PHONE => 19, FosUserTableMap::COL_FULL_NAME => 20, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'username' => 1, 'username_canonical' => 2, 'email' => 3, 'email_canonical' => 4, 'enabled' => 5, 'salt' => 6, 'password' => 7, 'last_login' => 8, 'locked' => 9, 'expired' => 10, 'expires_at' => 11, 'confirmation_token' => 12, 'password_requested_at' => 13, 'credentials_expired' => 14, 'credentials_expire_at' => 15, 'code' => 16, 'algorithm' => 17, 'created_at' => 18, 'phone' => 19, 'full_name' => 20, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('fos_user');
        $this->setPhpName('FosUser');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Model\\FosUser');
        $this->setPackage('src.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('username', 'Username', 'VARCHAR', false, 255, null);
        $this->addColumn('username_canonical', 'UsernameCanonical', 'VARCHAR', false, 255, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, 255, null);
        $this->addColumn('email_canonical', 'EmailCanonical', 'VARCHAR', false, 255, null);
        $this->addColumn('enabled', 'Enabled', 'BOOLEAN', false, 1, false);
        $this->addColumn('salt', 'Salt', 'VARCHAR', true, 255, null);
        $this->addColumn('password', 'Password', 'VARCHAR', true, 255, null);
        $this->addColumn('last_login', 'LastLogin', 'TIMESTAMP', false, null, null);
        $this->addColumn('locked', 'Locked', 'BOOLEAN', false, 1, false);
        $this->addColumn('expired', 'Expired', 'BOOLEAN', false, 1, false);
        $this->addColumn('expires_at', 'ExpiresAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('confirmation_token', 'ConfirmationToken', 'VARCHAR', false, 255, null);
        $this->addColumn('password_requested_at', 'PasswordRequestedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('credentials_expired', 'CredentialsExpired', 'BOOLEAN', false, 1, false);
        $this->addColumn('credentials_expire_at', 'CredentialsExpireAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('code', 'Code', 'INTEGER', true, 4, null);
        $this->addColumn('algorithm', 'Algorithm', 'VARCHAR', true, 40, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', true, null, null);
        $this->addColumn('phone', 'Phone', 'VARCHAR', true, 40, null);
        $this->addColumn('full_name', 'FullName', 'VARCHAR', true, 250, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? FosUserTableMap::CLASS_DEFAULT : FosUserTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (FosUser object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = FosUserTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = FosUserTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + FosUserTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = FosUserTableMap::OM_CLASS;
            /** @var FosUser $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            FosUserTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = FosUserTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = FosUserTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var FosUser $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                FosUserTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(FosUserTableMap::COL_ID);
            $criteria->addSelectColumn(FosUserTableMap::COL_USERNAME);
            $criteria->addSelectColumn(FosUserTableMap::COL_USERNAME_CANONICAL);
            $criteria->addSelectColumn(FosUserTableMap::COL_EMAIL);
            $criteria->addSelectColumn(FosUserTableMap::COL_EMAIL_CANONICAL);
            $criteria->addSelectColumn(FosUserTableMap::COL_ENABLED);
            $criteria->addSelectColumn(FosUserTableMap::COL_SALT);
            $criteria->addSelectColumn(FosUserTableMap::COL_PASSWORD);
            $criteria->addSelectColumn(FosUserTableMap::COL_LAST_LOGIN);
            $criteria->addSelectColumn(FosUserTableMap::COL_LOCKED);
            $criteria->addSelectColumn(FosUserTableMap::COL_EXPIRED);
            $criteria->addSelectColumn(FosUserTableMap::COL_EXPIRES_AT);
            $criteria->addSelectColumn(FosUserTableMap::COL_CONFIRMATION_TOKEN);
            $criteria->addSelectColumn(FosUserTableMap::COL_PASSWORD_REQUESTED_AT);
            $criteria->addSelectColumn(FosUserTableMap::COL_CREDENTIALS_EXPIRED);
            $criteria->addSelectColumn(FosUserTableMap::COL_CREDENTIALS_EXPIRE_AT);
            $criteria->addSelectColumn(FosUserTableMap::COL_CODE);
            $criteria->addSelectColumn(FosUserTableMap::COL_ALGORITHM);
            $criteria->addSelectColumn(FosUserTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(FosUserTableMap::COL_PHONE);
            $criteria->addSelectColumn(FosUserTableMap::COL_FULL_NAME);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.username');
            $criteria->addSelectColumn($alias . '.username_canonical');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.email_canonical');
            $criteria->addSelectColumn($alias . '.enabled');
            $criteria->addSelectColumn($alias . '.salt');
            $criteria->addSelectColumn($alias . '.password');
            $criteria->addSelectColumn($alias . '.last_login');
            $criteria->addSelectColumn($alias . '.locked');
            $criteria->addSelectColumn($alias . '.expired');
            $criteria->addSelectColumn($alias . '.expires_at');
            $criteria->addSelectColumn($alias . '.confirmation_token');
            $criteria->addSelectColumn($alias . '.password_requested_at');
            $criteria->addSelectColumn($alias . '.credentials_expired');
            $criteria->addSelectColumn($alias . '.credentials_expire_at');
            $criteria->addSelectColumn($alias . '.code');
            $criteria->addSelectColumn($alias . '.algorithm');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.phone');
            $criteria->addSelectColumn($alias . '.full_name');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(FosUserTableMap::DATABASE_NAME)->getTable(FosUserTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(FosUserTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(FosUserTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new FosUserTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a FosUser or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or FosUser object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FosUserTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Model\FosUser) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(FosUserTableMap::DATABASE_NAME);
            $criteria->add(FosUserTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = FosUserQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            FosUserTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                FosUserTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the fos_user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return FosUserQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a FosUser or Criteria object.
     *
     * @param mixed               $criteria Criteria or FosUser object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FosUserTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from FosUser object
        }

        if ($criteria->containsKey(FosUserTableMap::COL_ID) && $criteria->keyContainsValue(FosUserTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.FosUserTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = FosUserQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // FosUserTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
FosUserTableMap::buildTableMap();
