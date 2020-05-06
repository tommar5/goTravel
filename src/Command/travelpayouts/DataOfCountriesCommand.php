<?php

namespace App\Command\travelpayouts;

use App\Entity\Location\Country;
use App\Repository\Location\CountryRepository;
use App\Service\travelpayouts\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DataOfCountriesCommand extends Command
{
    protected static $defaultName = 'app:data-of-countries';

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
            ->setDescription('Receive JSON data from travelpayouts API of countries.')
//            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
//            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
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

        $data = $this->response->getCountriesDataResponse();

        $dataArray = $this->serializer->decode($data, 'json');

        foreach ($dataArray as $item) {
            /** @var CountryRepository $repo */
            $repo = $em->getRepository(Country::class);

            $country = $repo->findBy(['code' => $item['code'], 'name' => $item['name']]);

            if (!$country) {
                $country = $repo->createNew();
                $country->setName($item['name']);
                $country->setCode($item['code']);
                $repo->save($country);
            }
        }

        return 0;
    }
}
