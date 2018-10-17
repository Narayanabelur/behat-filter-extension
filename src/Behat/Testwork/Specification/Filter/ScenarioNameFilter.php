<?php
namespace Behat\Testwork\Specification\Filter;

use Symfony\Component\Console\Input\InputOption;

class ScenarioNameFilter implements SpecificationFilterProvider {
    public function getName() {
        return 'scenario-name';
    }

    /**
     * @return mixed[]
     */
    public function getCommandOptions() {
        return array(InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
            "Only executeCall the feature elements which match part" . PHP_EOL .
            "of the given name or regex.");
    }

    public function build($filterData) {
        return new \Behat\Gherkin\Filter\NameFilter($filterData);
    }
}