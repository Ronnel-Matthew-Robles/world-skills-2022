//Here is your CODE!

var render = () => {
  var selection = window.getSelection().toString();
  if (selection) {
    var range = window.getSelection().getRangeAt(0);
    var newNode = document.createElement("span");
    newNode.classList.add("highlight");
    newNode.appendChild(range.extractContents());
    range.insertNode(newNode);
  }
};
