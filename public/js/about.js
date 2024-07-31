$(function () {
  var editor;

  $("form[name='about']").submit(function (e) {
    e.preventDefault();
    this.classList.add("was-validated");

    if (this.checkValidity()) {
      $.ajax({
        method: "POST",
        url: "../api/about/update.php",
        data: {
          content: editor.getData(),
        },
      }).done(function () {
        setTimeout(() => location.reload(), 888);
      });
    }
  });

  ClassicEditor.create(document.querySelector("#content"), {
    toolbar: {
      items: [
        "undo",
        "redo",
        "|",
        "heading",
        "|",
        "bold",
        "italic",
        "|",
        "link",
        "blockQuote",
        "|",
        "bulletedList",
        "numberedList",
        "outdent",
        "indent",
      ],
      shouldNotGroupWhenFull: true,
    },
  }).then((e) => (editor = e));
});
