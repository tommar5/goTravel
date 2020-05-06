<?php

namespace App\Command\travelpayouts;

use App\Entity\Airline\Airline;
use App\Repository\Airline\AirlineRepository;
use App\Service\travelpayouts\Response;
use App\Service\rapidapi\AirlineDataResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class DataOfAirlinesCommand extends Command
{
    protected static $defaultName = 'app:data-of-airlines';

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
//        $io = new SymfonyStyle($input, $output);
//        $arg1 = $input->getArgument('arg1');
//
//        if ($arg1) {
//            $io->note(sprintf('You passed an argument: %s', $arg1));
//        }
//
//        if ($input->getOption('option1')) {
//            // ...
//        }
//
//        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        $em = $this->entityManager;

//        $data = $this->response->getAirlinesDataResponse();
//
//        $dataArray = $this->serializer->decode($data, 'json');
//
//        foreach ($dataArray as $item) {
//                /** @var AirlineRepository $repo */
//                $repo = $em->getRepository(Airline::class);
//
//                $airline = $repo->findOneBy(['iata' => $item['code'], 'name' => $item['name']]);
//
//                if (!$airline) {
//                    $airline = new Airline();
//
//                    $airline->setName($item['name']);
//                    $airline->setIata($item['code']);
//
//                    $repo->save($airline);
//                }
//
//        }
        $repo = $em->getRepository(Airline::class);
        $airlines = $repo->findAll();

        foreach ($airlines as $airline) {
            $airlineJson = $this->airlinesData->getAirlineData($airline->getIata());

            dump($airlineJson);
            die();

            $airlineData = $this->serializer->decode($airlineJson, 'json');

            dump($airlineData);
            die();
        }

        return 0;
    }
}
