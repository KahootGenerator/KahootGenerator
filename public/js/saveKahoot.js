const save = document.getElementById("save");

save.addEventListener("click", () => {

    //get all questions
    let questions = document.getElementsByClassName("question-block");
    //htmlcollection to array
    questions = [...questions];

    //get kahoot id 
    const kahoot_id = document.getElementById("kahoot-id").dataset.kahootId;

    //all question and response
    const form = new FormData()

    for (let index = 0; index < questions.length; index++) {
        const question = questions[index];

        const question_id = question.id

        //get title
        const title = document.getElementById("title-" + question_id).innerText

        //get answer text and checked
        const texts = document.getElementsByClassName("text-" + question_id);
        const checkboxs = document.getElementsByClassName("checkbox-" + question_id);

        const answers = []
        for (let i = 0; i < texts.length; i++) {
            //get content and checked, push to answers array
            answers.push([texts[i].textContent, checkboxs[i].checked])
        }

        //get summary element
        const time_element = document.getElementById("time-" + question_id);
        let id_time
        for (let i = 0; i < time_element.children.length; i++) {

            //if checkbox is checked, push id time
            if (time_element.children[i].checked) {
                id_time = time_element.children[i].dataset.idTime
                break
            }
        }

        //pass value to json 
        form.append(index, JSON.stringify({
            title: title,
            answers: answers,
            id_time: id_time,
        }))
    };

    const url = "/kahoot/" + kahoot_id + "/update"
    console.log(form.getAll("data"));
    fetch(url, { method: "POST", body: form }).then((response) => {
        //get the response
        return response.text()
    }).then((data) => {
        //log the data
        console.log(data);
    })
})
