const ButtonsDelete = document.querySelectorAll(".buttonsDelete");
ButtonsDelete.forEach((ButtonDelete) => {
  ButtonDelete.addEventListener("click", (e) => {
    e.preventDefault(); // dont submit the form
    const idKahoot = ButtonDelete.dataset.idkahoot;
    const idQuestion = ButtonDelete.dataset.idquestion;
    let url = `/kahoot/${idKahoot}/deleteQuestion/${idQuestion}`;
    fetch(url, { method: "get" })
      .then((response) => {
        return response;
      })
      .then((data) => {
        if (data.ok) {
          // if there are data
          // get the question block
          const question = document.getElementById(idQuestion);
          question.remove(); // delete element
        }
      });
  });
});
