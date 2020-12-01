<?php

namespace App\DataFixtures;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Project;
use App\Entity\Task;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        for($i=1; $i<3; $i++)
        {
            $user = new User();
            $user->setEmail("mail". $i."@test.com");
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'password123'));
            $manager->persist($user);

            for($j=1; $j<3; $j++)
            {
                $project = new Project();
                $project->setCreationDate(new \DateTime());
                $project->setDeadline(new \DateTime());
                $project->setDescription("Je suis la description du projet n°:".$j);
                $project->setName("Project".$j);
                $project->setUser($user);
                $project->setStatus(0);
                $manager->persist($project);

                for($k=1; $k<4; $k++)
                {
                    $task = new Task();
                    $task->setName("task n°".$k);
                    $task->setDescription("Je suis la description de la tache n°".$k);
                    $task->setCreationDate(new \DateTime());
                    $task->setProject($project);
                    $task->setDeadline(new \DateTime());
                    $task->setStatus(0);
                    $manager->persist($task);
                }
            }
        }

        $manager->flush();
    }
}
