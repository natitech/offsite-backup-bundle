<?php

namespace Nati\OffsiteBackupBundle\Command;

use Nati\OffsiteBackupBundle\S3Synchronizer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class SyncToS3Command extends Command
{
    protected static       $defaultName = 'offsite-backup';

    private S3Synchronizer $synchronizer;

    protected function configure()
    {
        $this->setDescription('Sync path with S3 bucket')
             ->addArgument('path', InputArgument::REQUIRED, 'Path to sync')
             ->addArgument('bucket', InputArgument::REQUIRED, 'Bucket to write to');
    }

    public function __construct(S3Synchronizer $synchronizer)
    {
        parent::__construct();

        $this->synchronizer = $synchronizer;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->synchronizer->sync($input->getArgument('path'), $input->getArgument('bucket'));

        return 0;
    }
}
