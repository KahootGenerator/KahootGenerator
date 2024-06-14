<?php declare(strict_types=1);
use App\Database\Managers\UserManager;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

include_once "src/Utils/Config.php";
final class UserManagerTest extends TestCase
{
    private UserManager $manager;

    public function setUp(): void
    {
        $this->manager = new UserManager();
        $this->manager->create('mince123', 'Happy', 'motdepasse');
    }

    public function testObject(): void {
        $return = $this->manager->find('Happy');
        $this->clearDataBase();
        $this->assertIsObject($return, 'La valeur de retour n\'est pas un objet !');
    }

    private function clearDataBase(): void {
        $this->manager->delete('mince123');
    }
}