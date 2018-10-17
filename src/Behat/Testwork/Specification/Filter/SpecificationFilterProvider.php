<?php
namespace Behat\Testwork\Specification\Filter;

use Behat\Gherkin\Filter\FeatureFilterInterface;

interface SpecificationFilterProvider {
    /**
     * @return string
     */
    public function getName();

    /**
     * @return mixed[]
     */
    public function getCommandOptions();

    /**
     * @param array|string $filterData
     * @return FeatureFilterInterface
     */
    public function build($filterData);
}