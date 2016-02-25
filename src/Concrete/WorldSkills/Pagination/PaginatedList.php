<?php

namespace Concrete\Package\Worldskills\WorldSkills\Pagination;

class PaginatedList implements \IteratorAggregate
{
    /**
     * @var array
     */
    private $items;

    /**
     * @var int
     */
    private $totalCount;

    /**
     * @var int
     */
    private $currentPage;

    /**
     * @var int
     */
    private $itemsPerPage;

    /**
     * @var int
     */
    private $totalPages;

    /**
     * @var int
     */
    private $adjacents = 5;

    /**
     * @var array
     */
    private $filters = array();

    public function __construct($data, $itemsKey, $itemsPerPage, $currentPage)
    {
        $this->items = $data[$itemsKey];
        $this->totalCount = $data['total_count'];

        $this->currentPage = $currentPage;
        $this->itemsPerPage = $itemsPerPage;

		$this->totalPages = ceil($this->totalCount / $this->itemsPerPage);
    }

	public function getPagination()
	{
	    $pagination = array();

		for ($i = 2; $i < $this->totalPages; $i++){

			if ($i <= ($this->currentPage + $this->adjacents)){

    			if ($i >= ($this->currentPage - $this->adjacents)){

    				$pagination[] = $i;
    			}
			}
		}
		
		return $pagination;
	}

	public function getTotalCount()
	{
	    return $this->totalCount;
	}
	
	public function getCurrentPage()
	{
	    return $this->currentPage;
	}

	public function hasPreviousPage()
	{
	    return $this->currentPage > 1;
	}

	public function getPreviousPage()
	{
	    return $this->currentPage - 1;
	}

	public function hasPreviousAdjacents()
	{
	    return $this->currentPage > ($this->adjacents + 2);
	}

	public function hasNextPage()
	{
	    return $this->currentPage < $this->totalPages;
	}

	public function getNextPage()
	{
	    return $this->currentPage + 1;
	}

	public function hasNextAdjacents()
	{
	    return $this->currentPage < ($this->totalPages - $this->adjacents - 1);
	}

	public function getTotalPages()
	{
	    return $this->totalPages;
	}

	public function getItems()
	{
	    return $this->items;
	}

    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }

    public function addFilter($key, $value)
    {
        $this->filters[$key] = $value;
    }
    
    public function get($key, $default = '')
    {
        if (isset($this->filters[$key])) {
            return $this->filters[$key];
        }
        return $default;
    }
    
    public function getQuery($page = null, $sort = null, $limit = null)
    {
        $data = $this->filters;

        // add page to filters
        if ($page === null)
        {
            $page = $this->getCurrentPage();
        }
        $data['page'] = $page;

        // add sort to filters
        if ($sort !== null)
        {
            $data['sort'] = $sort;
        }

        // add limit to filters
        if ($limit !== null)
        {
            $data['limit'] = $limit;
        }

        return http_build_query($data);
    }
}
