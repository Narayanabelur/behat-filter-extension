<?php
namespace Behat\Testwork\Specification\Filter;

use Symfony\Component\Console\Input\InputOption;

class TagFilter implements SpecificationFilterProvider {
    public function getName() {
        return 'tags';
    }

    public function getCommandOptions() {
        return array(InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
            "Only executeCall the features or scenarios with tags" . PHP_EOL .
            "matching tag filter expression.");
    }

    public function build($filterData) {
        return new \Behat\Gherkin\Filter\TagFilter($filterData);
    }
}