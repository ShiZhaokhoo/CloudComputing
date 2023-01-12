<?php
    require 'vendor/autoload.php';

    use Aws\S3\S3Client;
    use Aws\S3\Exception\S3Exception;

    $bucketName = 'mycloudemployee';

    // Use the us-east-1 region and latest version of each client.
    $sharedConfig = [
        'region'  => 'us-east-1',
        'version' => 'latest'
    ];

    // Create an SDK class used to share configuration across clients.
    $sdk = new Aws\Sdk($sharedConfig);
    
    // Create an Amazon S3 client using the shared configuration data.
    $s3 = $sdk->createS3();
?>