<?php
namespace Behat\Testwork\Specification\Filter;

use Symfony\Component\Console\Input\InputOption;

class RoleFilter implements SpecificationFilterProvider {
    public function getName() {
        return 'role';
    }

    public function getCommandOptions() {
        return array(InputOption::VALUE_REQUIRED,
            "Only executeCall the features with actor role matching" . PHP_EOL .
            "a wildcard.");
    }

    public function build($filterData) {
        return new \Behat\Gherkin\Filter\RoleFilter($filterData);
    }
}