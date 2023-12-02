/**
 * Form Editors
 */

"use strict";

(function () {
    // Snow Theme
    // // --------------------------------------------------------------------
    // const snowEditor = new Quill('#snow-editor', {
    //   bounds: '#snow-editor',
    //   modules: {
    //     formula: true,
    //     toolbar: '#snow-toolbar'
    //   },
    //   theme: 'snow'
    // });

    // // Bubble Theme
    // // --------------------------------------------------------------------
    // const bubbleEditor = new Quill('#bubble-editor', {
    //   modules: {
    //     toolbar: '#bubble-toolbar'
    //   },
    //   theme: 'bubble'
    // });

    // Full Toolbar
    // --------------------------------------------------------------------
    const fullToolbar = [
        [
            {
                font: [],
            },
            {
                size: [],
            },
        ],
        ["bold", "italic", "underline", "strike"],
        [
            {
                color: [],
            },
            {
                background: [],
            },
        ],
        [
            {
                script: "super",
            },
            {
                script: "sub",
            },
        ],
        [
            {
                header: "1",
            },
            {
                header: "2",
            },
            "blockquote",
            "code-block",
        ],
        [
            {
                list: "ordered",
            },
            {
                list: "bullet",
            },
            {
                indent: "-1",
            },
            {
                indent: "+1",
            },
        ],
        [
            "direction",
            {
                align: [],
            },
        ],
        ["link", "image", "video", "formula"],
        ["clean"],
    ];
    const fullEditor = new Quill("#full-editor", {
        bounds: "#full-editor",
        placeholder: "Type Something...",
        modules: {
            formula: true,
            toolbar: {
                container: fullToolbar,
                handlers: {
                    image: imageHandler
                }
            }
        },
        theme: "snow",
    });
    fullEditor.on("text-change", function (delta, oldDelta, source) {
        document.querySelector("input[name='content']").value =
            fullEditor.root.innerHTML;
    });

    function imageHandler2() {
        var range = this.quill.getSelection();
        var value = prompt("please copy paste the image url here.");
        if (value) {
            this.quill.insertEmbed(
                range.index,
                "image",
                value,
                Quill.sources.USER
            );
        }
    }

    function imageHandler() {
        const tooltip = this.quill.theme.tooltip;
        const originalSave = tooltip.save;
        const originalHide = tooltip.hide;
      
        tooltip.save = function () {
          const range = this.quill.getSelection(true);
          const value = this.textbox.value;
          if (value) {
            this.quill.insertEmbed(range.index, 'image', value, 'user');
          }
        };
        // Called on hide and save.
        tooltip.hide = function () {
          tooltip.save = originalSave;
          tooltip.hide = originalHide;
          tooltip.hide();
        };
        tooltip.edit('image');
        tooltip.textbox.placeholder = 'Embed URL';
      }
})();
