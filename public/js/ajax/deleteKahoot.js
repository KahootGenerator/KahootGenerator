const ButtonsDelete = document.querySelectorAll(".buttonsDelete");

ButtonsDelete.forEach((ButtonDelete) => {
  ButtonDelete.addEventListener("click", (e) => {
    e.preventDefault(); // dont submit the form
    const kahootContainer = document.querySelector(".main-container-lightblue");
    const idKahoot = ButtonDelete.dataset.idkahoot;
    let url = `/kahoot/${idKahoot}/delete/`;
    fetch(url, { method: "get" })
      .then((response) => {
        return response;
      })
      .then((data) => {
        if (data.ok) {
          // if there are data
          // get the kahoot block
          const kahoot = document.querySelector(
            `.kahoot-card[data-idkahoot="${idKahoot}"]`
          );
          kahoot.remove(); // delete element

          const kahoots = document.querySelectorAll(".kahoot-card");
          if (kahoots.length === 0) {
            // if there is only one kahoot
            kahootContainer.innerHTML = "";
            const h1 = document.createElement("h1");
            const p = document.createElement("p");
            const a = document.createElement("a");
            h1.textContent = "Tous vos Kahoot !";
            p.textContent = "Vous n'avez généré aucun Kahoot !";
            a.textContent = "Générez votre premier Kahoot";
            a.href = "/kahoot/generate/";
            a.className = "button-orange button-l";
            kahootContainer.appendChild(h1);
            kahootContainer.appendChild(p);
            kahootContainer.appendChild(a);

            kahootContainer.className = "main-container align-container";
          }
        }
      });
  });
});
