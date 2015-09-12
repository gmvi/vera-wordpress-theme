window.onload = function() {
  rename_no_class_category();
  var links = document.querySelectorAll('.row-actions .inline .editinline');
  Array.prototype.forEach.call(links, function(link) {
    link.onclick = function() {
      rename_no_class_category();
    }
  });
  var class_category_fields = document.querySelectorAll('.taxonomy-class_category');
  Array.prototype.forEach.call(class_category_fields, function(e) {
    var content = e.textContent;
    if (content == '—') {
      content = 'Uncategorized';
    }
    e.textContent = content;
  });
}

function rename_no_class_category() {
  document.querySelector("#class_category-0 > label").childNodes[1].textContent = " More (uncategorized)";
}