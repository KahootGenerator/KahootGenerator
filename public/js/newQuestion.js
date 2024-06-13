const showNewQuestion = document.querySelector("#createNewQuestion");
const questionContainer = document.querySelector(".question-container");
const idKahoot = questionContainer.dataset.id_kahoot;

showNewQuestion.addEventListener("click", () => {
  const numQuestion = questionContainer.children.length + 1;
  const uniqid = Date.now();
  // Create the main question block div
  let questionBlock = document.createElement(`div`);
  questionBlock.className = `question-block`;
  questionBlock.dataset.uniqid = uniqid;

  // Create the article element for question info
  let article = document.createElement(`article`);
  article.className = `question-block-info`;

  // Create and append the h2 element for question title
  let h2 = document.createElement(`h2`);
  h2.className = `question-block-title`;
  h2.textContent = `Question ${numQuestion}`;
  article.appendChild(h2);

  // Create and append the div element with id
  let questionDiv = document.createElement(`div`);
  questionDiv.id = `${uniqid}-question`;

  // Create and append the div for question block actions
  let actionsDiv = document.createElement(`div`);
  actionsDiv.className = `question-block-actions`;

  // Create and append the details element
  let details = document.createElement(`details`);
  details.className = `select`;
  details.setAttribute(`data-selected`, `30s`);

  // Create and append the summary element
  let summary = document.createElement(`summary`);

  // Function to create input radio elements
  function createRadio(name, id, title, checked) {
    let input = document.createElement(`input`);
    input.type = `radio`;
    input.name = name;
    input.id = id;
    input.title = title;
    if (checked) input.checked = true;
    return input;
  }

  // Append radio inputs to the summary element
  summary.appendChild(createRadio(`${uniqid}-time`, `${uniqid}-time-1`, `5s`));
  summary.appendChild(createRadio(`${uniqid}-time`, `${uniqid}-time-2`, `10s`));
  summary.appendChild(createRadio(`${uniqid}-time`, `${uniqid}-time-3`, `20s`));
  summary.appendChild(
    createRadio(`${uniqid}-time`, `${uniqid}-time-4`, `30s`, true)
  );
  summary.appendChild(createRadio(`${uniqid}-time`, `${uniqid}-time-5`, `60s`));
  summary.appendChild(createRadio(`${uniqid}-time`, `${uniqid}-time-6`, `90s`));
  summary.appendChild(
    createRadio(`${uniqid}-time`, `${uniqid}-time-7`, `120s`)
  );
  summary.appendChild(
    createRadio(`${uniqid}-time`, `${uniqid}-time-8`, `240s`)
  );

  // Append the summary to details
  details.appendChild(summary);

  // Create and append the ul element
  let ul = document.createElement(`ul`);

  // Function to create li elements with labels
  function createLi(forId, text, style) {
    let li = document.createElement(`li`);
    let label = document.createElement(`label`);
    label.setAttribute(`for`, forId);
    label.textContent = text;
    if (style) label.style.color = style;
    li.appendChild(label);
    return li;
  }

  // Append li elements to the ul
  ul.appendChild(createLi(`${uniqid}-time-1`, `5s`));
  ul.appendChild(createLi(`${uniqid}-time-2`, `10s`));
  ul.appendChild(createLi(`${uniqid}-time-3`, `20s`));
  ul.appendChild(createLi(`${uniqid}-time-4`, `30s`, `rgb(18, 152, 241)`));
  ul.appendChild(createLi(`${uniqid}-time-5`, `60s`));
  ul.appendChild(createLi(`${uniqid}-time-6`, `90s`));
  ul.appendChild(createLi(`${uniqid}-time-7`, `120s`));
  ul.appendChild(createLi(`${uniqid}-time-8`, `240s`));

  // Append the ul to details
  details.appendChild(ul);

  // Append the details to actions div
  actionsDiv.appendChild(details);

  // Create and append the delete link
  let deleteLink = document.createElement(`a`);
  deleteLink.href = `/kahoot/${idKahoot}/deleteQuestion/${uniqid}`;
  deleteLink.className = `button-red`;
  deleteLink.title = `Supprimer`;

  let deleteImg = document.createElement(`img`);
  deleteImg.src = `/img/utils/trash.svg`;
  deleteImg.alt = `Supprimer`;

  deleteLink.appendChild(deleteImg);
  actionsDiv.appendChild(deleteLink);

  // Append the actions div to question div
  questionDiv.appendChild(actionsDiv);

  // Append the question div to article
  article.appendChild(questionDiv);

  // Append the article to the main question block
  questionBlock.appendChild(article);

  // Create and append the question div
  let questionTextDiv = document.createElement(`div`);
  questionTextDiv.className = `question`;

  let questionTitle = document.createElement(`p`);
  questionTitle.className = `question-title`;
  questionTitle.id = `${uniqid}-title`;
  questionTitle.contentEditable = `plaintext-only`;

  questionTextDiv.appendChild(questionTitle);

  // Create and append the responses wrapper div
  let responsesWrapper = document.createElement(`div`);
  responsesWrapper.className = `responses-wrapper`;

  // Function to create response divs
  function createResponse(responseId, responseText, checked) {
    let responseDiv = document.createElement(`div`);
    responseDiv.className = `response`;

    let checkboxDiv = document.createElement(`div`);
    checkboxDiv.className = `response--checkbox`;

    let input = document.createElement(`input`);
    input.type = `checkbox`;
    input.name = `${responseId}-answer`;
    input.id = `answer${responseId}`;
    if (checked) input.checked = true;

    let label = document.createElement(`label`);
    label.setAttribute(`for`, `answer${responseId}`);

    let img = document.createElement(`img`);
    img.src = `/img/utils/check.svg`;
    img.alt = `Checked`;

    label.appendChild(img);
    checkboxDiv.appendChild(input);
    checkboxDiv.appendChild(label);
    responseDiv.appendChild(checkboxDiv);

    let responseTextP = document.createElement(`p`);
    responseTextP.className = `response--text`;
    responseTextP.contentEditable = `plaintext-only`;
    responseTextP.id = `${responseId}-answer`;
    responseTextP.textContent = responseText;

    responseDiv.appendChild(responseTextP);

    let button = document.createElement(`button`);
    button.className = `response--cross`;

    let crossImg = document.createElement(`img`);
    crossImg.src = `/img/utils/cross.svg`;
    crossImg.alt = `Cross`;

    button.appendChild(crossImg);
    responseDiv.appendChild(button);

    return responseDiv;
  }

  // Append response divs to responses wrapper
  responsesWrapper.appendChild(createResponse(uniqid));
  responsesWrapper.appendChild(createResponse(uniqid));
  responsesWrapper.appendChild(createResponse(uniqid));
  responsesWrapper.appendChild(createResponse(uniqid));

  // Append the responses wrapper to question div
  questionTextDiv.appendChild(responsesWrapper);

  // Append the question div to the main question block
  questionBlock.appendChild(questionTextDiv);

  // Append the entire question block to the body (or any other container)
  questionContainer.appendChild(questionBlock);
});

// delete question
const deleteQuestion = document.querySelector(
  ".question-block[data-='uniqid']"
);
deleteQuestion.addEventListener("click", () => {
  console.log(deleteQuestion);
});
