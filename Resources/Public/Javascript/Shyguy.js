require(["jquery","ckeditor"], function($) {
    $(document).ready(function() {

        // Insert ↵ glyph to active element by clicking
        if($('a[href="#insertSoftHyphen"]').length){
            $('a[href="#insertSoftHyphen"]').on('mousedown', function(e){
                e.preventDefault();

                let activeElement = document.activeElement;
                let $activeElement = $(activeElement);
                let activeCKEDITOR;

                // Get the active CKEditor
                for (let ckInstance in CKEDITOR.instances){
                    if($activeElement.closest('.form-wizards-element #' + $(CKEDITOR.instances[ckInstance].container).attr('id')).length){
                        activeCKEDITOR = CKEDITOR.instances[ckInstance].dataProcessor.editor;
                    }
                }

                // CKEditor source mode works native, so get the other(s) or use natvie behavior instead
                if(activeCKEDITOR && activeCKEDITOR.mode !== "source" && activeCKEDITOR.focusManager.hasFocus === true){
                    activeCKEDITOR.insertText('↵');
                }else{
                    let activeElementRange = getCaretPosition(activeElement);

                    $activeElement.val(replaceRange($activeElement.val(), activeElementRange['start'], activeElementRange['end'], '↵'));
                    $activeElement.change();
                    $activeElement.keyup();
                }
            });
        }

        replaceDomGlyphes();

        CKEDITOR.on( 'instanceReady', function( evt ) {

            evt.editor.setData(evt.editor.getData().replace(/(\&shy;|\­)/gi, "↵"));

        });

    });

    // Replace Existing ↵ with &shy; glyph in plain text, input fields and text areas
    function replaceDomGlyphes(){

        $('body :not(script,textarea), body textarea[id^="formengine-textarea-"]').contents().filter(function() {
            return this.nodeType === 3;
        }).replaceWith(function() {
            return this.nodeValue.replace(/(\&shy;|\­)/gi, "↵");
        });

        $('input, .form-wizards-element textarea[id^="formengine-textarea-"]').each(function(){
            $(this).val($(this).val().replace(/(\&shy;|\­)/gi, "↵"));
        });
    }

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