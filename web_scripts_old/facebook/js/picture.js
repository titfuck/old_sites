function pictureCheckAgree() {
  if (document.frm.pic.value) {
    if (document.frm.agree.checked) {
      document.frm.submit();
    } else {
        var str = 'You must certify that that image is not copyrighted before you upload.';
        var exp = 'Please click the checkbox to certify.';
        show_editor_error(str, exp);
        window.location.hash = "errors_hash";
    }
  }
}
