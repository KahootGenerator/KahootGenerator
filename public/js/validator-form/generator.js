const theme = document.querySelector("#theme");
const quantity = document.querySelector("#quantity");

theme.addEventListener("input", () => {
  if (theme.value.length >= 2 && theme.value.length <= 100) {
    theme.className = "field-valid";
  } else {
    theme.className = "field";
  }
});

quantity.addEventListener("input", () => {
  if (quantity.value === 21) {
    quantity.value = 20;
  } else if (quantity.value === -1) {
    quantity.value = 0;
  }
});
