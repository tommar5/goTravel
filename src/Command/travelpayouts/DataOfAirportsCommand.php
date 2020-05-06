<?php

namespace App\Command\travelpayouts;

use App\Entity\Location\Airport;
use App\Entity\Location\City;
use App\Entity\Location\Country;
use App\Repository\Location\AirportRepository;
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

class DataOfAirportsCommand extends Command
{
    protected static $defaultName = 'app:data-of-airports';

    /**
     * @var Response
     */
    private $response;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var Serializer
     */
    private $serializer;

    public function __construct(Response $travelpayoutsResponse, EntityManagerInterface $entityManager)
    {
        $this->response = $travelpayoutsResponse;
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

        $data = $this->response->getAirportsDataResponse();

        $dataArray = $this->serializer->decode($data, 'json');

        foreach ($dataArray as $item) {
            /** @var AirportRepository $repo */
            $repo = $em->getRepository(Airport::class);

            $airport = $repo->findBy(['code' => $item['code'], 'name' => $item['name']]);

            if (!$airport) {
                $airport = $repo->createNew();

                $airport->setCode($item['code']);
                $airport->setName($item['name']);
                $airport->setLatitude($item['coordinates']['lat']);
                $airport->setLongitude($item['coordinates']['lon']);
                $airport->setTimeZone($item['time_zone']);
                $airport->setFlightable($item['flightable']);

                if ($this->checkCity($item['city_code']))
                    $airport->setCity($this->checkCity($item['city_code']));

                if ($this->checkCountry($item['country_code']))
                    $airport->setCountry($this->checkCountry($item['country_code']));

                $repo->save($airport);
            }
        }

        return 0;
    }

    private function checkCountry($countryCode)
    {
        return $this->entityManager->getRepository(Country::class)->findOneBy(['code' => $countryCode]);
    }

    private function checkCity($cityCode)
    {
        return $this->entityManager->getRepository(City::class)->findOneBy(['code' => $cityCode]);
    }
}
