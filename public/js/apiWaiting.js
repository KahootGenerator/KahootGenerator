const form = document.getElementById("formGen");
const waitingContainer = document.getElementById("waitingContainer");
const generationText = document.getElementById("generationText");
let dotCount = 0;

form.addEventListener("submit", () => {
  form.style.display = "none";
  waitingContainer.style.display = "flex";

  setInterval(() => {
    dotCount++;
    generationText.textContent += ".";

    if (dotCount > 3) {
      dotCount = 0;

      new Promise((res) => setTimeout(res, 1000));
      generationText.innerText =
        "Votre kahoot en en cours de génération. Merci de patienter";
    }
  }, 300);
});
