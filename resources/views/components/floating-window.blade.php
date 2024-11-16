<div>
    <style>
        #floating-window {
            position: absolute;
            top: 100px; /* Initial top position */
            left: 100px; /* Initial left position */
            width: 300px;
            height: 200px;
            display: none; /* Initially hidden */
            background-color: white;
            border: 1px solid #ccc;
            z-index: 1000;
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
            height: calc(100% - 50px); /* Adjust according to the header height */
            overflow: hidden;
        }

        #floating-content iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        #floating-resizer {
            width: 10px;
            height: 10px;
            background: #ccc;
            position: absolute;
            right: 0;
            bottom: 0;
            cursor: se-resize;
        }
    </style>
    
    <button id="open-floating-window">Load Resource</button>
    <div id="floating-window">
        <div id="floating-header">
            Floating Window - Resource Viewer
            <button id="close-button" class="btn-close"></button>
        </div>
        <div id="floating-content">
            <p>Loading...</p>
        </div>
        <div id="floating-resizer"></div>
    </div>
 
     <script>
        $(document).ready(function () {
            const $window = $('#floating-window');
            const $header = $('#floating-header');
            const $content = $('#floating-content');
            const $resizer = $('#floating-resizer');
            const $openButton = $('#open-floating-window');
            const $input = $('#projectLedgerLink');
            const $closeButton = $('#close-button');

            let isDragging = false;
            let isResizing = false;
            let startX, startY, startWidth, startHeight;
            // Open floating window and load resource
            $openButton.on('click', function () {
                const url = $input.val().trim();
                if (!url) {
                    alert('Please enter a valid URL!');
                    return;
                }
                $content.html('<p>Loading...</p>'); // Reset content
                if (url.endsWith('.pdf')) {
                    // Embed PDF file
                    $content.html(`<iframe src="${url}"></iframe>`);
                } else {
                    // General link fallback (opens in iframe)
                    $content.html(`<iframe src="${url}"></iframe>`);
                }

                $window.show();
            });
            $closeButton.on('click', function () {
                $window.hide();
            });
            // Drag functionality
            $header.on('mousedown', function (e) {
                isDragging = true;
                startX = e.clientX - $window.offset().left;
                startY = e.clientY - $window.offset().top;
                $(document).on('mousemove', doDrag);
                $(document).on('mouseup', stopDrag);
                e.preventDefault(); // Prevent text selection
            });
    
            function doDrag(e) {
                if (isDragging) {
                    let newLeft = e.clientX - startX;
                    let newTop = e.clientY - startY;
    
                    // Boundary checks
                    const maxLeft = $(window).width() - $window.outerWidth();
                    const maxTop = $(window).height() - $window.outerHeight();
    
                    $window.css({
                        left: `${Math.min(Math.max(newLeft, 0), maxLeft)}px`,
                        top: `${Math.min(Math.max(newTop, 0), maxTop)}px`,
                    });
                }
            }
    
            function stopDrag() {
                isDragging = false;
                $(document).off('mousemove', doDrag);
                $(document).off('mouseup', stopDrag);
            }
    
            // Resize functionality
            $resizer.on('mousedown', function (e) {
                isResizing = true;
                startX = e.clientX;
                startY = e.clientY;
                startWidth = $window.width();
                startHeight = $window.height();
                $(document).on('mousemove', doResize);
                $(document).on('mouseup', stopResize);
                e.stopPropagation();
            });
    
            function doResize(e) {
                if (isResizing) {
                    $window.css({
                        width: `${startWidth + e.clientX - startX}px`,
                        height: `${startHeight + e.clientY - startY}px`,
                    });
                }
            }
    
            function stopResize() {
                isResizing = false;
                $(document).off('mousemove', doResize);
                $(document).off('mouseup', stopResize);
            }
        });
    </script>
</div>