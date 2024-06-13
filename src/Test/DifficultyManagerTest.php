<?php declare(strict_types=1);
use App\Database\Managers\DifficultyManager;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

include_once "src/Utils/Config.php";
final class DifficultyManagerTest extends TestCase
{
    private DifficultyManager $manager;

    public function setUp(): void
    {
        $this->manager = new DifficultyManager();
    }

    public static function returnedLibelleProvider(): array {
        return [
            [1, 'Facile'],
            [2, 'Moyen'],
            [3, 'Difficile'],
            [4, 'Croissant'],
            [5, 'Décroissant'],
            [6, 'Aléatoire']
        ];
    }

    #[DataProvider('returnedLibelleProvider')]
    public function testObject(int $id, string $libelle): void {
        $return = $this->manager->find($id);
        $this->assertIsObject($return, 'La valeur de retour n\'est pas un objet !');
    }

    #[DataProvider('returnedLibelleProvider')]
    public function testReturnedLibelle(int $id, string $libelle): void {
        $return = $this->manager->find($id);
        $this->assertEquals($libelle, $return, 'Le libelle retourné n\'est pas le bon !');
    }
}