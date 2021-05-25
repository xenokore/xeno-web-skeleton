<?php

namespace App\Console\Command;

use Psr\Container\ContainerInterface;

use Symfony\Component\Console\Command\Command;

use Symfony\Component\Console\Input\InputInterface as Input;
use Symfony\Component\Console\Output\OutputInterface as Output;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CreateUnitTestCommand extends Command
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
        $this->setName("test:create")
            ->setDescription("Create a new unit test")
            ->addArgument('name', InputArgument::REQUIRED, 'Test name (without the Test affix)');
    }

    protected function execute(Input $input, Output $output)
    {
        $tests_dir = $this->container->get('app_config')['tests_dir'];

        $test_name = \ucfirst($input->getArgument('name')) . 'Test';

        $output->writeln("[>] Test name: <comment>{$test_name}</comment>");

        $file_path = $tests_dir . '/' . $test_name . '.php';

        if(\file_exists($file_path)){
            $output->writeln("[-] <error>{$file_path}</error> ALREADY EXISTS");
            return Command::FAILURE;
        }

        $contents = <<<EOT
<?php

namespace App\Tests;

use Xenokore\App\App;
use PHPUnit\Framework\TestCase;

use Psr\Container\ContainerInterface;

class $test_name extends TestCase
{
    /** @var ContainerInterface */
    protected \$container;

    /**
     * This method is called before the first test of this test class is run.
     */
    public static function setUpBeforeClass(): void
    {
    }

    /**
     * This method is called after the last test of this test class is run.
     */
    public static function tearDownAfterClass(): void
    {
    }

    /**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
        \$this->container = App::getGlobalContainer();
    }

    /**
     * This method is called after each test.
     */
    protected function tearDown(): void
    {
    }

    /**
     * Example test method.
     * Each test must have at least 1 assert.
     * Method name must be prefixed with "test"
     */
    public function testExample()
    {
        \$this->assertEquals(true, true);
    }
}
EOT;

        if(!\file_put_contents($file_path, $contents)){
            $output->writeln("[-] <error>{$file_path}</error> CREATION FAILED");
            return Command::FAILURE;
        }

        $output->writeln("[+] <info>{$file_path}</info> CREATED!");
        $output->writeln("[>] Done!");

        return Command::SUCCESS;
    }
}