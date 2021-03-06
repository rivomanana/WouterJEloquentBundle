<?php

namespace WouterJ\EloquentBundle\Command;

use Illuminate\Database\Migrations\MigrationRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Wouter J <wouter@wouterj.nl>
 */
class MigrateInstallCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('eloquent:migrate:install')
            ->setDescription('Creates the migration repository.')
            ->addOption('database', null, InputOption::VALUE_REQUIRED, 'The database connection to use')
        ;
    }

    protected function execute(InputInterface $i, OutputInterface $o)
    {
        $repository = $this->getRepository();
        $repository->setSource($i->getOption('database'));
        $repository->createRepository();

        $o->writeln('<comment>Migration table created successfully.</>');
    }

    /** @return MigrationRepositoryInterface */
    private function getRepository()
    {
        return $this->getContainer()->get('wouterj_eloquent.migrations.repository');
    }
}
