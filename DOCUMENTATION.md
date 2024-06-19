<a name="readme-top"></a>

<div align="center">
  <a href="https://github.com/KahootGenerator/KahootGenerator/graphs/contributors" target="_blank">
    <img src="https://img.shields.io/github/contributors/KahootGenerator/KahootGenerator?style=for-the-badge">
  </a>
  <a href="https://github.com/KahootGenerator/KahootGenerator/network/members" target="_blank">
    <img src="https://img.shields.io/github/forks/KahootGenerator/KahootGenerator?style=for-the-badge">
  </a>
  <a href="https://github.com/KahootGenerator/KahootGenerator/stargazers" target="_blank">
    <img src="https://img.shields.io/github/stars/KahootGenerator/KahootGenerator?style=for-the-badge">
  </a>
  <a href="https://github.com/KahootGenerator/KahootGenerator/issues" target="_blank">
    <img src="https://img.shields.io/github/issues/KahootGenerator/KahootGenerator?style=for-the-badge">
  </a>
  <a href="https://github.com/KahootGenerator/KahootGenerator/blob/master/LICENSE.txt" target="_blank">
    <img src="https://img.shields.io/github/license/KahootGenerator/KahootGenerator?style=for-the-badge">
  </a>
</div>


<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/othneildrew/Best-README-Template">
    <img src="https://github.com/KahootGenerator/KahootGenerator/blob/c331d3fea2e6bf6712f101044865664956dcf2ff/public/img/logo.webp" alt="Logo" width="80" height="80">
  </a>

  <h3 align="center">Kahoot Generator</h3>

  <p align="center">
     An advanced Kahoot generator powered by ChatGPT
    <br />
    <a href="https://github.com/KahootGenerator/KahootGenerator/blob/main/README.md"><strong>Explore the README</strong></a>
    <br />
    <br />
    <a href="https://youtube.com">View Demo</a>
    ·
    <a href="https://github.com/KahootGenerator/KahootGenerator/issues/new?labels=bug&template=bug-report---.md">Report Bug</a>
    ·
    <a href="https://github.com/KahootGenerator/KahootGenerator/issues/new?labels=enhancement&template=feature-request---.md">Request Feature</a>
  </p>
</div>

# Routes

## Routes Mapping

- ### Routes d'authentification

| Chemin   | Méthode HTTP | Contrôleur     | Action         | Paramètres                                  | Description                                      |
|----------|---------------|----------------|----------------|---------------------------------------------|--------------------------------------------------|
| `/account` | `GET`         | ViewController | showAccount  | Aucun                                       | Affiche la page de gestion du compte               |
| `/account/login` | `GET`        | ViewController | showLogin          | Aucun       | Affiche la page de connexion à un compte             |
| `/account/login/attempt` | `POST`        | AccountController | login          | `username` (string), `password` (string)       | Traite les données du form pour valider la connexion ou non             |
| `/account/register` | `GET`        | ViewController | showRegister          | Aucun       | Affiche la page d'enregistrement à un compte             |
| `/account/register/attempt` | `POST`        | AccountController | register          | `username` (string), `password` (string)       | Traite les données du form pour valider l'enregistrement ou non             |
| `/account/logout`| `GET`        | AccountController | logout         | Aucun                                       | Déconnecte l'utilisateur en cours de session     |

- ### Routes des Kahoots

| Chemin             | Méthode HTTP | Contrôleur       | Action   | Paramètres                             | Description                                |
|--------------------|--------------|------------------|----------|----------------------------------------|--------------------------------------------|
| `/` | `GET`        | ViewController | showIndex   | Aucun                                  | Affiche la page d'accueil            |
| `/kahoot`        | `GET`       | ViewController | showAllKahoot    | Aucun     | Affiche la liste de tout les Kahoot généré par l'utilisateur         |
| `/kahoot/{id}`   | `GET`        | ViewController | showOneKahoot     | `id` (string)                             | Affiche les détails d'un Kahoot           |
| `/kahoot/{id}/update`   | `POST`        | KahootController | updateKahoot     | `id` (string)                             | Traite les données du form pour valider les modifications ou non          |
| `/kahoot/{id}/delete`   | `GET`        | KahootController | deleteKahoot     | `id` (string)                             | Supprime un kahoot           |
| `/kahoot/{id}/deleteQuestion/{questionId}`   | `GET`        | KahootController | deleteQuestion     | `id` (string), `questionId` (string)                       | Supprime une question d'un kahoot           |
| `/kahoot/{id}/download`   | `GET`        | KahootController | downloadKahoot     | `id` (string)                             | Génère un fichier .xlsx importable sur le site de kahoot et le rend disponible au téléchargement           |
| `/kahoot/generate`   | `GET`        | ViewController | showGenerate     | Aucun                             | Affiche le formulaire de génération de Kahoot        |
| `/kahoot/generate/attempt`   | `POST`        | KahootController | generate     | `theme` (string), `questionCount` (int), `difficulty` (int), `includeTrueOrFalse` (boolean), `langage` (int)                            | Affiche le formulaire de génération de Kahoot        |

---

## Create a Route

### If you want to add a route. Go in `public/index.php` and follow this template :

```PHP
$Router = new Router($_SERVER['REQUEST_URI']);

// GET Route :
$Router->get('/getTest/:id', 'ControllerName@MethodName')

// POST Route :
$Router->post('/getTest', 'ControllerName@MethodName')
```

> [!IMPORTANT]
> The URL GET Params should always be preceeded by ":" 
> AND the Controller / Methods separator should always be "@"
<p align="right">(<a href="#readme-top">back to top</a>)</p>
