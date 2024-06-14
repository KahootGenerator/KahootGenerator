const ButtonsDelete = document.querySelectorAll(".buttonsDelete");
const questionContainer = document.querySelectorAll(".question-container");
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

          const questions = document.querySelectorAll(".question-block");
          if (questions.length === 0) {
            const h2 = document.createElement("h2");
            h2.textContent = "Vous n'avez aucune question de créée.";
            questionContainer.appendChild(h2);
          }
        }
      });
  });
});
