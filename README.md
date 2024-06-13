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
  <a href="https://github.com/KahootGenerator/KahootGenerator">
    <img src="https://github.com/KahootGenerator/KahootGenerator/blob/c331d3fea2e6bf6712f101044865664956dcf2ff/public/img/logo.webp" alt="Logo" width="80" height="80">
  </a>

  <h3 align="center">Kahoot Generator</h3>

  <p align="center">
     An advanced Kahoot generator powered by ChatGPT
    <br />
    <a href="https://github.com/KahootGenerator/KahootGenerator/DOCUMENTATION.md"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://youtube.com">View Demo</a>
    ·
    <a href="https://github.com/KahootGenerator/KahootGenerator/issues/new?labels=bug&template=bug-report---.md">Report Bug</a>
    ·
    <a href="https://github.com/KahootGenerator/KahootGenerator/issues/new?labels=enhancement&template=feature-request---.md">Request Feature</a>
  </p>
</div>

## About the Project

<div align="center">
  <img src="https://i.imgur.com/WSmLqED.png">
</div>

### Many people spend a lot of time creating Kahoot quizzes. Our solution is to make creating Kahoot quizzes fast, easy, and innovative with our app.

*Our application has several features that help people create a Kahoot quiz as quickly as possible, such as :*
* **AI Generation by multiple factors** :
  * Specify a theme
  * Specify a questions count
  * Specify a difficulty
  * Specify a language
* **Quiz :**
  * Edit questions title and answers
  * Add / Remove questions and their associated answers
  * Download your customized quiz to import it directly on Kahoot website
* **Account Features :**
  * You can register/login to access old generated quizzes
> [!NOTE]  
> Google and Github auth will be added in future updates.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

### Project Stack :

This project is developped in PHP [MVC Pattern](https://github.com/IMTR0J4N/MVC_Template)

* ![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
* ![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Getting Started

***There's a few steps to setup the project and getting ready to use the app***

### Prerequisites


* PHP **8.2** OR **Greater**
> [!IMPORTANT]
> PDO Driver needs to be installed and enabled in your `php.ini`.
* Composer **LTS Version**
* MySQL **8.x**
* Git **LTS Version**

### Setup

**First : You have to get a subscription plan to the [Official OpenAI ChatGPT API](https://platform.openai.com/settings/organization/billing/overview) and get your API Key**

**Once you get your API Key, follow these steps :**

* Clone the repository on your local machine or on a VPS / Web Host machine :
```sh
git clone https://github.com/KahootGenerator/KahootGenerator
```
* CD into the project directory :
```sh
cd KahootGenerator
```
* Setup ENV file with your API Key :
```sh
git mv public/.example.env public/.env
notepad public/.env
```
> [!IMPORTANT]
> You have to put your API Key next to "API_TOKEN="
* Install Composer dependencies :
```sh
composer install
```

> [!NOTE]  
> The Project is released with a PHP Database Creator. You simply need to run the project to automatically create the Database with all data needed

### Run

**Simply run this command to launch the app :**
```sh
composer serve
```

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement".
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b your-feature`)
3. Commit your Changes (`git commit -m 'Add some feature'`)
4. Push to the Branch (`git push origin your-feature`)
5. Open a Pull Request

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE` for more information.

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- CONTACT -->
## Contact

* Joshua Jorge Beau - [Linkedin](https://www.linkedin.com/in/joshua-jorge-beau-6678a62aa/) - jjorgebeau.pro@gmail.com
* Elevan Darnand - [Linkedin](https://www.linkedin.com/in/elevan-darnand/) - elevan.contact@gmail.com
* Ethan Paleyron - [Linkedin](https://www.linkedin.com/in/ethan-paleyron-4456092b2/) - paleyron.ethan.05@gmail.com
* Lilian Ortega - [Linkedin](https://www.linkedin.com/in/lilian-ortega-1536a22ba/) - pro.lilian.ortega@gmail.com

Project Link: [https://github.com/KahootGenerator/KahootGenerator](https://github.com/KahootGenerator/KahootGenerator)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- ACKNOWLEDGMENTS -->
## Acknowledgments

Use this space to list resources you find helpful and would like to give credit to. I've included a few of my favorites to kick things off!

* [Img Shields](https://shields.io)
* [Font Awesome](https://fontawesome.com)
* [OpenAI](https://openai.com/api)
* [Colormind.IO](http://colormind.io/)
* [Haikei App](https://app.haikei.app/)

<p align="right">(<a href="#readme-top">back to top</a>)</p>
