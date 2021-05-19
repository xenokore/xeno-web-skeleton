<?php

namespace App\Console\Command;

use Psr\Container\ContainerInterface;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface as Input;
use Symfony\Component\Console\Output\OutputInterface as Output;

class ClearCacheCommand extends Command
{
    /**
     * The container.
     *
     * @var ContainerInterface
    */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setName("cache:clear")
            ->setDescription("Clear the cache directory");
    }

    protected function execute(Input $input, Output $output)
    {
        $cache_dir = $this->container->get('app_config')['cache_dir'];

        $output->writeln('[>] Clearing cache directory: ' . $cache_dir);

        $iterator = new \RecursiveDirectoryIterator($cache_dir, \RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new \RecursiveIteratorIterator($iterator, \RecursiveIteratorIterator::CHILD_FIRST);

        $dir_count  = 0;
        $file_count = 0;
        $dir_count_deleted  = 0;
        $file_count_deleted = 0;

        /** @var \SplFileInfo $file */
        foreach($files as $file) {
            $path = $file->getRealPath();

            if(\realpath($cache_dir . '/.gitignore') == $path){
                continue;
            }

            if ($file->isDir()){
                $dir_count++;
                if(\rmdir($path)){
                    $dir_count_deleted++;
                    $output->writeln("[+] DIR: <info>{$path}</info> DELETED");
                } else {
                    $output->writeln("[-] DIR: <error>{$path}</error> FAILED");
                }
            } else {
                $file_count++;
                if(\unlink($path)){
                    $file_count_deleted++;
                    $output->writeln("[+] FILE: <info>{$path}</info> DELETED");
                } else {
                    $output->writeln("[-] FILE: <error>{$path}</error> FAILED");
                }
            }
        }

        $output->writeln("[>] Done!");
        $output->writeln("[>] Files deleted: {$file_count_deleted}/{$file_count}");
        $output->writeln("[>] Directories removed: {$dir_count_deleted}/{$dir_count}");

        return Command::SUCCESS;
    }
}
