<?php

// src/Command/CreateUserCommand.php
namespace App\Command;

use App\Repository\ProductRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

// the name of the command is what users type after "php bin/console"
#[AsCommand(name: 'products:search-cheapest')]
class ProductSearchCommand extends Command
{
    protected static $defaultName = 'products:search-cheapest';

    private $repo;

    public function __construct(ProductRepository $productRepo){
        $this->repo = $productRepo;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setHelp('This command allows you to search for the 5 cheapest pharmacies');
        $this->addArgument('Product', InputArgument::REQUIRED, 'Product Id.');
    }    

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $result = $this->repo->getCheapestPharmacies($input->getArgument('Product'));
        foreach($result as $pharmacies){
            $output->writeln($pharmacies->getPharmacy()->getName() . " - ".$pharmacies->getPharmacy()->getAddress());
        }
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;

        // or return this to indicate incorrect command usage; e.g. invalid options
        // or missing arguments (it's equivalent to returning int(2))
        // return Command::INVALID
    }
}