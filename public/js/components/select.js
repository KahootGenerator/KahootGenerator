const selects = document.querySelectorAll(".select");
selects.forEach((select) => {
  let selectObject = { name: select.children[0].children[0].name, labels: [] };
  const lis = select.children[1].children;
  for (let li = 0; li < lis.length; li++) {
    selectObject.labels.push(lis[li].children[0]);
  }
  selectObject.labels.forEach((label) => {
    label.addEventListener("click", () => {
      selectObject.labels.forEach((e) => {
        e.style.color = "#000";
      });
      label.style.color = "#1298f1";
    });
  });
});
