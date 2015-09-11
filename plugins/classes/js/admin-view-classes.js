window.onload = function() {
  rename_no_class_category();
  var links = document.querySelectorAll('.row-actions .inline .editinline');
  Array.prototype.forEach.call(links, function(link) {
    link.onclick = function() {
      rename_no_class_category();
    }
  });
}

function rename_no_class_category() {
  document.querySelector("#class_category-0 > label").childNodes[1].textContent = " More (uncategorized)";
}