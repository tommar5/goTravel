<?php

namespace App\Command\travelpayouts\flights;

use App\Service\rapidapi\AirlineDataResponse;
use App\Service\travelpayouts\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class FlightPricesCommand extends Command
{
    protected static $defaultName = 'app:flight-prices';

    /**
     * @var Response
     */
    private $response;

    /**
     * @var AirlineDataResponse
     */
    private $airlinesData;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var Serializer
     */
    private $serializer;

    public function __construct(
        Response $travelpayoutsResponse,
        AirlineDataResponse $airlineDataResponse,
        EntityManagerInterface $entityManager
    )
    {
        $this->response = $travelpayoutsResponse;
        $this->airlinesData = $airlineDataResponse;
        $this->entityManager = $entityManager;

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $this->serializer = new Serializer($normalizers, $encoders);

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $data = $this->response->getFlightPriceResponse();

        $dataArray = $this->serializer->decode($data, 'json');

        dump($dataArray);
        die();

        return 0;
    }
}
