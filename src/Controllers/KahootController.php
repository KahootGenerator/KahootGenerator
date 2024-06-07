<?php

namespace App\Controllers;

use App\Validator;
use App\Database\Managers\KahootManager;
use App\Core\Controller;

final class AccountController extends Controller
{
    protected Validator $validator;
    // protected KahootManager $kahootManager;
    public function __construct()
    {
        $this->validator = new Validator();
        // $this->kahootManager = new KahootManager();
    }
    public function generate(): void
    {
    }
    public function updateKahoot(int $id): void
    {
    }
    public function deleteKahoot(int $id): void
    {
    }
}