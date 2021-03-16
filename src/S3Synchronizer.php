<?php

namespace Nati\OffsiteBackupBundle;

use Aws\S3\S3Client;
use Aws\S3\Transfer;
use Psr\Log\LoggerInterface;

final class S3Synchronizer
{
    private string          $awsKey;

    private string          $awsSecret;

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger, string $awsKey, string $awsSecret)
    {
        $this->logger    = $logger;
        $this->awsKey    = $awsKey;
        $this->awsSecret = $awsSecret;
    }

    public function sync(string $path, string $bucket)
    {
        $this->logger->info('Start syncing path with bucket', ['path' => $path, 'bucket' => $bucket]);

        try {
            (new Transfer($this->s3client(), $path, 's3://' . $bucket))->transfer();
        } catch (\Exception $e) {
            $this->logger->error('Error while syncing path with bucket', ['e' => $e]);

            return;
        }

        $this->logger->info('End syncing path with bucket', ['path' => $path, 'bucket' => $bucket]);
    }

    private function s3client(): S3Client
    {
        return new S3Client($this->s3configuration());
    }

    private function s3configuration(): array
    {
        return [
            'region'      => 'eu-west-1',
            'version'     => 'latest',
            'credentials' => ['key' => $this->awsKey, 'secret' => $this->awsSecret]
        ];
    }
}
