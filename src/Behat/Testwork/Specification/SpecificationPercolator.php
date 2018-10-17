<?php
namespace Behat\Testwork\Specification;

use Behat\Testwork\Specification\Filter\SpecificationFilterProvider;

final class SpecificationPercolator {
    /**
     * @var SpecificationFilterProvider[]
     */
    private $specificationFilters = array();

    public function registerSpecificationFilterProvider($filter) {
        if ($filter instanceof SpecificationFilterProvider) {
            $this->specificationFilters[$filter->getName()] = $filter;
        }
    }

    public function getFilter($filterName, $filterData) {
        if (array_key_exists($filterName, $this->specificationFilters)) {
            return $this->specificationFilters[$filterName]->build($filterData);
        } else {
            //FIXME: Throw exception
        }
    }

    /**
     * @return SpecificationFilterProvider[]
     */
    public function getFilters() {
        return $this->specificationFilters;
    }
}