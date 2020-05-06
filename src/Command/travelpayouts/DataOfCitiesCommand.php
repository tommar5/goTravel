<?php

namespace App\Command\travelpayouts;

use App\Entity\Location\City;
use App\Entity\Location\Country;
use App\Repository\Location\CityRepository;
use App\Service\travelpayouts\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class DataOfCitiesCommand extends Command
{
    protected static $defaultName = 'app:data-of-cities';

    /**
     * @var string
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

        $data = $this->response->getCitiesDataResponse();

        $dataArray = $this->serializer->decode($data, 'json');

        foreach ($dataArray as $item) {
            /** @var CityRepository $repo */
            $repo = $em->getRepository(City::class);

            $city = $repo->findBy(['code' => $item['code'], 'name' => $item['name']]);

            if (!$city) {
                $city = $repo->createNew();

                $city->setCode($item['code']);
                $city->setName($item['name']);
                $city->setLatitude($item['coordinates']['lat']);
                $city->setLongitude($item['coordinates']['lon']);
                $city->setTimeZone($item['time_zone']);

                if ($this->checkCountry($item['country_code']))
                    $city->setCountry($this->checkCountry($item['country_code']));

                $repo->save($city);
            }
        }

        return 0;
    }

    private function checkCountry($countryCode)
    {
        return $this->entityManager->getRepository(Country::class)->findOneBy(['code' => $countryCode]);
    }
}
