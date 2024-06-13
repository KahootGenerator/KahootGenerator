<?php declare(strict_types=1);
use App\Database\Managers\UserManager;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use App\Database\Managers\KahootManager;
use App\Database\Managers\QuestionManager;
use App\Database\Managers\AnswerManager;

include_once "src/Utils/Config.php";
final class AnswerManagerTest extends TestCase
{
    private AnswerManager $manager;
    private KahootManager $km;
    private QuestionManager $qm;
    private UserManager $um;
    private string $kahoot_id;
    private string $question_id;
    private string $answer_id;

    public function setUp(): void
    {
        $this->manager = new AnswerManager();
        $this->km = new KahootManager();
        $this->qm = new QuestionManager();
        $this->um = new UserManager();
        $this->um->create('mince123', 'Happy', 'motdepasse');
        session_start();
        $_SESSION['user'] = [
            'id' => 'mince123',
            'username' => 'Happy'
        ];
        $this->kahoot_id = uniqid();
        $_POST['theme'] = 'Theme';
        $this->km->create($this->kahoot_id, 1, 1, 'Titre');
        $this->question_id = uniqid();
        $this->qm->create($this->question_id, $this->kahoot_id, 'Ceci est un test');
        $this->answer_id = uniqid();
        $this->manager->create($this->answer_id, $this->question_id, 'Ceci est une réponse au test', true);
    }

    public function testObject(): void {
        $return = $this->manager->getAnswersFormQuestion($this->question_id);
        $this->clearDataBase();
        $this->assertIsObject($return[0], 'La valeur de retour n\'est pas un objet !');
    }

    public function testGetFromUserReturnArray(): void {
        $return = $this->manager->getAnswersFormQuestion($this->question_id);
        $this->clearDataBase();
        $this->assertIsArray($return, 'La valeur de retour n\'est pas un tableau !');
    }

    private function clearDataBase(): void {
        $this->km->delete($this->kahoot_id);
        $this->um->delete('mince123');
        session_destroy();
    }
}