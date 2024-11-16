<div>
    <style>
        #floating-window {
            position: absolute;
            top: 100px;
            left: 100px;
            width: 300px;
            height: 200px;
            display: none;
            background-color: white;
            border: 1px solid #ccc;
            z-index: 1000;
            max-width: 100vw;  /* Maximum width is viewport width */
            max-height: 100vh; /* Maximum height is viewport height */
        }

        #floating-header {
            cursor: move;
            background-color: #f1f1f1;
            padding: 10px;
            border-bottom: 1px solid #ccc;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #floating-content {
            width: 100%;
            height: calc(100% - 50px);
            overflow: hidden;
        }

        #floating-content iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .resizer {
            position: absolute;
            background: transparent;
        }

        .resizer-r,
        .resizer-l {
            cursor: ew-resize;
            width: 5px;
            height: 100%;
            top: 0;
        }

        .resizer-t,
        .resizer-b {
            cursor: ns-resize;
            height: 5px;
            width: 100%;
            left: 0;
        }

        .resizer-r {
            right: -3px;
        }

        .resizer-l {
            left: -3px;
        }

        .resizer-t {
            top: -3px;
        }

        .resizer-b {
            bottom: -3px;
        }

        .resizer-tr,
        .resizer-tl,
        .resizer-br,
        .resizer-bl {
            width: 10px;
            height: 10px;
        }

        .resizer-tr {
            top: -5px;
            right: -5px;
            cursor: ne-resize;
        }

        .resizer-tl {
            top: -5px;
            left: -5px;
            cursor: nw-resize;
        }

        .resizer-br {
            bottom: -5px;
            right: -5px;
            cursor: se-resize;
        }

        .resizer-bl {
            bottom: -5px;
            left: -5px;
            cursor: sw-resize;
        }
    </style>

    <button id="open-floating-window" class="btn btn-primary">Load Resource</button>
    <div id="floating-window">
        <div id="floating-header">
            Floating Window - Project Ledger viewer
            <button id="close-button" class="btn-close"></button>
        </div>
        <div id="floating-content">
            <p>Loading...</p>
        </div>
        <div class="resizer resizer-r"></div>
        <div class="resizer resizer-l"></div>
        <div class="resizer resizer-t"></div>
        <div class="resizer resizer-b"></div>
        <div class="resizer resizer-tr"></div>
        <div class="resizer resizer-tl"></div>
        <div class="resizer resizer-br"></div>
        <div class="resizer resizer-bl"></div>
    </div>

    <script>
        $(document).ready(function() {
            const $window = $('#floating-window');
            const $header = $('#floating-header');
            const $content = $('#floating-content');
            const $openButton = $('#open-floating-window');
            const $input = $('#projectLedgerLink');
            const $closeButton = $('#close-button');

            let isDragging = false;
            let isResizing = false;
            let startX, startY, startWidth, startHeight, resizeType;

            // Open floating window and load resource
            $openButton.on('click', function() {
                const url = $input.val().trim();
                if (!url) {
                    alert('Please enter a valid URL!');
                    return;
                }
                $content.html('<p>Loading...</p>');
                $content.html(`<iframe src="${url}"></iframe>`);
                $window.show();
            });

            // Close window
            $closeButton.on('click', function() {
                $window.hide();
            });

            // Dragging
            $header.on('mousedown', function(e) {
                isDragging = true;
                startX = e.clientX - $window.offset().left;
                startY = e.clientY - $window.offset().top;
            });

            // Resizing
            $('.resizer').on('mousedown', function(e) {
                isResizing = true;
                startX = e.clientX;
                startY = e.clientY;
                startWidth = $window.width();
                startHeight = $window.height();
                resizeType = $(this).attr('class').split(' ')[1];
                e.preventDefault();
            });

            $(document).on('mousemove', function(e) {
                if (isDragging) {
                    $window.css({
                        left: e.clientX - startX,
                        top: e.clientY - startY
                    });
                }
                if (isResizing) {
                    let newWidth = startWidth;
                    let newHeight = startHeight;
                    let newX = $window.offset().left;
                    let newY = $window.offset().top;

                    switch (resizeType) {
                        case 'resizer-r':
                            newWidth = startWidth + (e.clientX - startX);
                            break;
                        case 'resizer-l':
                            newWidth = startWidth - (e.clientX - startX);
                            newX = e.clientX;
                            break;
                        case 'resizer-t':
                            newHeight = startHeight - (e.clientY - startY);
                            newY = e.clientY;
                            break;
                        case 'resizer-b':
                            newHeight = startHeight + (e.clientY - startY);
                            break;
                        case 'resizer-tr':
                            newWidth = startWidth + (e.clientX - startX);
                            newHeight = startHeight - (e.clientY - startY);
                            newY = e.clientY;
                            break;
                        case 'resizer-tl':
                            newWidth = startWidth - (e.clientX - startX);
                            newHeight = startHeight - (e.clientY - startY);
                            newX = e.clientX;
                            newY = e.clientY;
                            break;
                        case 'resizer-br':
                            newWidth = startWidth + (e.clientX - startX);
                            newHeight = startHeight + (e.clientY - startY);
                            break;
                        case 'resizer-bl':
                            newWidth = startWidth - (e.clientX - startX);
                            newHeight = startHeight + (e.clientY - startY);
                            newX = e.clientX;
                            break;
                    }



                    // Ensure minimum size and update position only when necessary
                    if (newWidth > 100 && newHeight > 100) {
                        $window.css({
                            width: newWidth,
                            height: newHeight
                        });

                        // Only update position for left and top resizing
                        if (['resizer-l', 'resizer-tl', 'resizer-bl'].includes(resizeType)) {
                            $window.css('left', newX);
                        }
                        if (['resizer-t', 'resizer-tl', 'resizer-tr'].includes(resizeType)) {
                            $window.css('top', newY);
                        }
                    }
                }
            });

            $(document).on('mouseup', function() {
                isDragging = false;
                isResizing = false;
            });
        });
    </script>
</div>
