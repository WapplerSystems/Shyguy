class InsertSoftHyphenHandler {
  constructor() {
    this.btnInsertShy = document.querySelector("a[href=\"#insertSoftHyphen\"]");

    this.init();
  }

  /**
   * @return {InsertSoftHyphenHandler}
   */
  init() {
    if (this.btnInsertShy) {
      this.btnInsertShy.addEventListener("mousedown", this.handleInsertShyClick.bind(this));
    }

    this.replaceDomGlyphes();

    return this;
  }

  /**
   * Handle insert soft-hyphen button click
   * https://ckeditor.com/docs/ckeditor5/latest/examples/how-tos.html#how-to-get-the-editor-instance-object-from-the-dom-element
   */
  handleInsertShyClick(event) {
    event.preventDefault();

    let activeElement = document.activeElement;
    const domEditableElement = document.querySelector(".ck-editor__editable_inline");
    const editorInstance = domEditableElement.ckeditorInstance;

    if (editorInstance.editing.view.document.isFocused === true) {
      editorInstance.execute("insertText", { text: "­" });
      editorInstance.editing.view.focus();
    } else if (activeElement.tagName.toLowerCase() === "input" || activeElement.tagName.toLowerCase() === "textarea") {
      let activeElementRange = this.getCaretPosition(activeElement);

      activeElement.value = this.replaceRange(activeElement.value, activeElementRange["start"], activeElementRange["end"], "↵");
      activeElement.dispatchEvent(new Event("change", { "bubbles": true }));
      activeElement.dispatchEvent(new Event("keyup", { "bubbles": true }));
    }
  }

  /**
   * Replace Existing ↵ with &shy; glyph in input fields and text areas
   */
  replaceDomGlyphes() {
    const elements = document.querySelectorAll("input, .form-wizards-element textarea[id^=\"formengine-textarea-\"]");
    elements.forEach(function(element) {
      element.value = element.value.replace(/(\&shy;|\­)/gi, "↵");
    });
  }

  /**
   * Get caret position
   */
  getCaretPosition(ctrl) {
    return {
      "start": ctrl.selectionStart ?? 0,
      "end": ctrl.selectionEnd ?? 0
    };
  }

  /**
   * @return {InsertSoftHyphenHandler}
   */
  replaceRange(s, start, end, substitute) {
    return s.substring(0, start) + substitute + s.substring(end);
  }
}

export default new InsertSoftHyphenHandler();
