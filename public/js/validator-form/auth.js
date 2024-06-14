const username = document.querySelector("input[type=text]");
const password = document.querySelector("input[type=password]");

username.addEventListener("input", () => {
  const alphaNumDash = /^[A-Za-z0-9À-Ÿ-_|]+$/;
  if (username.value.length <= 50 && alphaNumDash.test(username.value)) {
    username.className = "field-valid";
  } else {
    username.className = "field";
  }
});

password.addEventListener("input", () => {
  if (password.value.length >= 8 && password.value.length <= 255) {
    password.className = "field-valid";
  } else {
    password.className = "field";
  }
});
