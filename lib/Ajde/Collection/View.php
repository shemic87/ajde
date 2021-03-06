<?php

class Ajde_Collection_View extends Ajde_Object_Standard
{
    private $_tableName;

    private $_rowCount;

    public function __construct($tableName, $listOptions = [])
    {
        $this->_tableName = $tableName;

        $defaultOptions = [
            'page'              => 1,
            'pageSize'          => 100,
            'filter'            => [],
            'search'            => null,
            'orderBy'           => null,
            'orderDir'          => Ajde_Query::ORDER_ASC,
            'viewType'          => 'list',
            'filterVisible'     => false,
            'disableFilter'     => false,
            'mainFilter'        => '',
            'mainFilterGrouper' => '',
            'columns'           => [],
        ];
        $options = array_merge($defaultOptions, $listOptions);
        $this->setOptions($options);
    }

    public function setOptions($options)
    {
        foreach ($options as $key => $value) {
            $this->set($key, $value);
        }
    }

    public function getPage()
    {
        return parent::getPage();
    }

    public function getPageSize()
    {
        return parent::getPageSize();
    }

    public function getSearch()
    {
        return parent::getSearch();
    }

    public function getOrderBy()
    {
        return parent::getOrderBy();
    }

    public function getOrderDir()
    {
        return parent::getOrderDir();
    }

    public function getFilter()
    {
        return parent::getFilter();
    }

    public function getViewType()
    {
        return parent::getViewType();
    }

    public function getFilterVisible()
    {
        return parent::getFilterVisible();
    }

    public function getDisableFilter()
    {
        return parent::getDisableFilter();
    }

    public function getMainFilter()
    {
        return parent::getMainFilter();
    }

    public function getMainFilterGrouper()
    {
        return parent::getMainFilterGrouper();
    }

    public function getFilterForField($fieldName)
    {
        $filters = $this->getFilter();
        if (!array_key_exists($fieldName, $filters)) {
            return;
        }

        return $filters[$fieldName];
    }

    public function getRowCount(Ajde_Collection $collection = null)
    {
        if (isset($collection)) {
            return $collection->count(true);
        }
        if (!isset($this->_rowCount)) {
            $sql = 'SELECT COUNT(*) AS count FROM '.$this->_tableName;
            $connection = Ajde_Db::getInstance()->getConnection();
            $statement = $connection->prepare($sql);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->_rowCount = $result['count'];
        }

        return $this->_rowCount;
    }

    public function setColumns($columns)
    {
        $this->set('columns', $columns);
    }

    public function getColumns()
    {
        return $this->get('columns');
    }

    public function getPageCount(Ajde_Collection $collection = null)
    {
        return ceil($this->getRowCount($collection) / $this->getPageSize());
    }

    public function getRowStart()
    {
        return ($this->getPage() - 1) * $this->getPageSize();
    }
}
