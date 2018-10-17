<?php
namespace Behat\Testwork\Specification\Filter;

class NarrativeFilter implements SpecificationFilterProvider {
    public function getName() {
        return 'narrative';
    }

    public function getCommandOptions() {
        return array();
    }

    public function build($filterData) {
        return new \Behat\Gherkin\Filter\NarrativeFilter($filterData);
    }
}