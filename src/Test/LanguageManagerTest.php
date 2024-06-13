<?php declare(strict_types=1);
use App\Database\Managers\LanguageManager;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

include_once "src/Utils/Config.php";
final class LanguageManagerTest extends TestCase
{
    private LanguageManager $manager;

    public function setUp(): void
    {
        $this->manager = new LanguageManager();
    }

    public static function returnedLibelleProvider(): array {
        return [
            [1, 'Facile'],
            [2, 'Anglais']
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