<?php

namespace App\Command;

// the name of the command is what users type after "php bin/console"
use App\Entity\People;
use App\Entity\Planet;
use App\Entity\Species;
use App\Entity\Starship;
use App\Entity\Vehicle;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(name: 'app:init')]
class InitAppCommand extends Command
{

    protected array $speciesUrls = [];
    protected array $peopleUrls = [];
    public function __construct(
        private readonly ManagerRegistry $doctrine,
        private readonly HttpClientInterface $client,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setHelp('This command allows you to generate data with "The Star Wars API" (https://swapi.dev/)');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $em = $this->doctrine->getManager();
        $baseUrl = 'https://swapi.dev/api/';

        // use API for generate planets
        $planetsUrl = $baseUrl . 'planets';
        $responsePlanets = $this->client->request('GET', $planetsUrl);
        $planets = $responsePlanets->toArray()['results'];

        if ($responsePlanets->getStatusCode() == 200) {
            foreach ($planets as $result) {
                $planet = new Planet();
                $planet->setName($result['name']);
                $planet->setGravity(intval($result['gravity']));
                $planet->setDiameter(intval($result['diameter']));
                $planet->setPopulation($result['population']);
                $planet->setClimate($result['climate']);

                $em->persist($planet);
            }
        }

        // use API for generate vehicles
        $vehiclesUrl = $baseUrl . 'vehicles';
        $responseVehicles = $this->client->request('GET', $vehiclesUrl);
        $vehicles = $responseVehicles->toArray()['results'];

        if ($responseVehicles->getStatusCode() == 200) {
            foreach ($vehicles as $result) {
                $vehicle = new Vehicle();
                $vehicle->setName($result['name']);
                $vehicle->setCapacity(intval($result['cargo_capacity']));
                $vehicle->setModel($result['model']);

                $em->persist($vehicle);
            }
        }

        // use API for generate starships
        $starshipsUrl = $baseUrl . 'starships';
        $responseStarships = $this->client->request('GET', $starshipsUrl);
        $starships = $responseStarships->toArray()['results'];

        if ($responseStarships->getStatusCode() == 200) {
            foreach ($starships as $result) {
                $starship = new Starship();
                $starship->setName($result['name']);
                $starship->setCapacity($result['cargo_capacity']);
                $starship->setHyperdriveRating($result['hyperdrive_rating']);

                $em->persist($starship);
            }
        }

        // use API for generate species
        $speciesUrl = $baseUrl . 'species';
        $responseSpecies = $this->client->request('GET', $speciesUrl);
        $species = $responseSpecies->toArray()['results'];

        if ($responseStarships->getStatusCode() == 200) {
            foreach ($species as $result) {
                $this->insertSpecies($result);
            }
        }

        //use API for generate peoples
        $peoplesUrl = $baseUrl . 'people';
        $responsePeoples = $this->client->request('GET', $peoplesUrl);
        $peoples = $responsePeoples->toArray()['results'];

        if ($responsePeoples->getStatusCode() == 200) {
            foreach ($peoples as $result) {
                $this->insertPeople($result);
            }
        }

        // insert all missing peoples
        foreach (array_unique($this->peopleUrls) as $url) {
            $responsePeople = $this->client->request('GET', $url);
            if ($responsePeople->getStatusCode() == 200) {
                $this->insertPeople($responsePeople->toArray());
            }
        }

        // insert all missing species
        foreach (array_unique($this->speciesUrls) as $url) {
            $responseSpecies = $this->client->request('GET', $url);
            if ($responseSpecies->getStatusCode() == 200) {
                $this->insertSpecies($responseSpecies->toArray());
            }
        }

        $em->flush();

        return Command::SUCCESS;
    }

    protected function insertSpecies(mixed $result): void {
        $em = $this->doctrine->getManager();

        $species = new Species();
        $species->setName($result['name']);
        $species->setLanguage($result['language']);
        $species->setSkinColor($result['skin_colors']);
        $species->setLifespan($result['average_lifespan']);
        $this->peopleUrls = array_merge($this->peopleUrls, $result['people']);

        $em->persist($species);
    }

    protected function insertPeople(mixed $result): void
    {
        $em = $this->doctrine->getManager();

        $people = new People();
        $people->setName($result['name']);
        $people->setGender($result['gender']);
        $this->speciesUrls[] = array_merge($this->speciesUrls, $result['species']);

        $em->persist($people);
    }
}
