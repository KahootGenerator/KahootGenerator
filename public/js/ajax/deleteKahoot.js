const ButtonsDelete = document.querySelectorAll(".buttonsDelete");
ButtonsDelete.forEach((ButtonDelete) => {
  ButtonDelete.addEventListener("click", (e) => {
    e.preventDefault(); // dont submit the form
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
        }
      });
  });
});
