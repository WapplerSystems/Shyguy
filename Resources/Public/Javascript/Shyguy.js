require(["jquery"], function($) {
    $(document).ready(function() {

        // Insert ↵ glyph to active element by clicking (does not work for ckeditor yet)
        if($('a[href="#insertSoftHyphen"]').length){
            $('a[href="#insertSoftHyphen"]').on('mousedown', function(e){
                e.preventDefault();

                var activeElement = document.activeElement;
                var $activeElement = $(activeElement);
                var activeElementRange = getCaretPosition(activeElement);

                $activeElement.val(replaceRange($activeElement.val(), activeElementRange['start'], activeElementRange['end'], '↵'));
                $activeElement.change();
                $activeElement.keyup();

            });
        }
        // Replace Existing ↵ with &shy; glyph in plain text, input fields and text areas
        $('body :not(script)').contents().filter(function() {
            return this.nodeType === 3;
        }).replaceWith(function() {
            return this.nodeValue.replace(/(\­)/gi, "↵");
        });
        $('input, textarea').each(function(){
           $(this).val($(this).val().replace(/(\­)/gi, "↵"));
        });

    });
});

function getCaretPosition(ctrl) {
    // IE < 9 Support
    if (document.selection) {
        ctrl.focus();
        var range = document.selection.createRange();
        var rangelen = range.text.length;
        range.moveStart('character', -ctrl.value.length);
        var start = range.text.length - rangelen;
        return {
            'start': start,
            'end': start + rangelen
        };
    } // IE >=9 and other browsers
    else if (ctrl.selectionStart || ctrl.selectionStart == '0') {
        return {
            'start': ctrl.selectionStart,
            'end': ctrl.selectionEnd
        };
    } else {
        return {
            'start': 0,
            'end': 0
        };
    }
}

function replaceRange(s, start, end, substitute) {
    return s.substring(0, start) + substitute + s.substring(end);
}