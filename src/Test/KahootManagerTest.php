<?php declare(strict_types=1);
use App\Database\Managers\UserManager;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use App\Database\Managers\KahootManager;

include_once "src/Utils/Config.php";
final class KahootManagerTest extends TestCase
{
    private KahootManager $manager;
    private UserManager $um;
    private string $kahoot_id;

    public function setUp(): void
    {
        $this->manager = new KahootManager();
        $this->um = new UserManager();
        $this->um->create('mince123', 'Happy', 'motdepasse');
        session_start();
        $_SESSION['user'] = [
            'id' => 'mince123',
            'username' => 'Happy'
        ];
        $this->kahoot_id = uniqid();
        $_POST['theme'] = 'Theme';
        $this->manager->create($this->kahoot_id, 1, 1, 'Titre');
    }

    public function testObject(): void {
        $return = $this->manager->getOne($this->kahoot_id);
        $this->clearDataBase();
        $this->assertIsObject($return, 'La valeur de retour n\'est pas un objet !');
    }

    public function testGetFromUserReturnArray(): void {
        $return = $this->manager->getFromUser('mince123');
        $this->clearDataBase();
        $this->assertIsArray($return, 'La valeur de retour n\'est pas un tableau !');
    }

    private function clearDataBase(): void {
        $this->manager->delete($this->kahoot_id);
        $this->um->delete('mince123');
        session_destroy();
    }
}