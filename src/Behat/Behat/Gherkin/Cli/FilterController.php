<?php

/*
 * This file is part of the Behat.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Behat\Behat\Gherkin\Cli;

use Behat\Gherkin\Filter\NameFilter;
use Behat\Gherkin\Filter\RoleFilter;
use Behat\Gherkin\Filter\TagFilter;
use Behat\Gherkin\Gherkin;
use Behat\Testwork\Cli\Controller;
use Behat\Testwork\Specification\SpecificationPercolator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Configures default Gherkin filters.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
final class FilterController implements Controller
{
    /**
     * @var Gherkin
     */
    private $gherkin;

    /**
     * @var SpecificationPercolator
     */
    private $percolator;

    /**
     * Initializes controller.
     *
     * @param Gherkin $gherkin
     */
    public function __construct(Gherkin $gherkin, SpecificationPercolator $percolator)
    {
        $this->gherkin = $gherkin;
        $this->percolator = $percolator;
    }

    /**
     * Configures command to be executable by the controller.
     *
     * @param Command $command
     */
    public function configure(Command $command)
    {
        foreach ($this->percolator->getFilters() as $filter) {
            $options = array_merge(array('--filter-' . $filter::getName(), null) , $filter->getCommandOptions());
            if (count($options) !== 2) {
                call_user_func_array(array($command, 'addOption'), $options);
            }
        }
    }

    /**
     * Executes controller.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return null|integer
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $filters = array();
        foreach ($input->getOptions() as $option => $data) {
            if (strpos($option, 'filter-') === 0 && ($data != null || is_array($data) && count($data) > 0)) {
                if ($data === null || is_array($data) && count($data) > 0)
                    $filterName = substr($option, 7);
                $filters[] = $this->percolator->getFilter($filterName, $data);
            }
        }

        if (count($filters)) {
            $this->gherkin->setFilters($filters);
        }
    }

    private function optionDataIsEmpty($data) {
        if ($data === null) {
            return true;
        } else if (is_array($data) && count($data) === 0) {
            return true;
        } else {
            return false;
        }
    }
}
