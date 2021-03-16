# Offsite backup bundle for symfony

Sync a path to a S3 repository using S3 php SDK. 

Motivations :
* no use of third-party commands (like s3cmd)
* use symfony config/vault to manager S3 credentials

Install the package with:

```console 
composer require nati/offsite-backup-bundle
```

## Usage

This bundle provides a single command to add to a crontab :

```console 
php bin/console offsite-backup --env=prod /path/to/sync s3bucket
```
