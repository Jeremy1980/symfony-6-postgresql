<?php
namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

// 1. Import the ORM EntityManager Interface
use Doctrine\ORM\EntityManagerInterface;

#[AsCommand(name: 'app:collect-posts',description: 'Pobieraj posty i zapisuj je w bazie wraz z imieniem i nazwiskiem autora.',)]
class CollectPostsCommand extends Command
{
    // 2. Expose the EntityManager in the class level
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        // 3. Update the value of the private entityManager variable through injection
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $em = $this->entityManager;

        // 4. Access repositories
        $repoP = $em->getRepository('App\Entity\Post');
        $repoU = $em->getRepository('App\Entity\User');

        $content = file_get_contents('https://jsonplaceholder.typicode.com/posts');
        $posts = json_decode($content, true);

        $content = file_get_contents('https://jsonplaceholder.typicode.com/users');
        $users = json_decode($content, true);

        $added = array();

        if (empty($posts) || empty($users))
        {
            return Command::FAILURE;
        }

        $ids = $repoU->getAll();
        $aliases = array();

        // 5. Use regular methods. Find or create user.
        foreach($users as $key=>$data)
        {
            $matchedKey = array_search(strtolower($data['email']), $ids);
            if (is_numeric($matchedKey))
            {
                $aliases[$data['id']] = $matchedKey;
            } else {
                $data['roles'] = array('role'=>'ROLE_AUTHOR');

                $u = $repoU->insert($data);
                $em->flush();

                $aliases[$data['id']] = $u->getId();
            }
        }

        // 6. Only actually existed user, deserved to add content.
        foreach($posts as $data)
        {
            $id = $data['userId'];
            if (isset($aliases[$data['userId']]))
            {
                $id = $aliases[$data['userId']];
                $data['userId'] = $id;
            }
            $repoU->find($id) && $repoP->insert($data);
        }
        $em->flush();

        return Command::SUCCESS;
    }
}
?>