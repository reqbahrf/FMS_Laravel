let isFloatingWindowInitialized = false;
export function InitializeFloatingWindow(elements) {
    if (!isFloatingWindowInitialized) {
        isFloatingWindowInitialized = true;
    }

    const { $window, $header, $closeButton } = elements;

    let isDragging = false;
    let isResizing = false;
    let startX, startY, startWidth, startHeight, resizeType;

    // Open floating window and load resource

    // Close window
    $closeButton.on("click", function () {
        $window.hide();
    });

    // Dragging
    $header.on("mousedown", function (e) {
        isDragging = true;
        startX = e.clientX - $window.offset().left;
        startY = e.clientY - $window.offset().top;
    });

    // Resizing
    $(".resizer").on("mousedown", function (e) {
        isResizing = true;
        startX = e.clientX;
        startY = e.clientY;
        startWidth = $window.width();
        startHeight = $window.height();
        resizeType = $(this).attr("class").split(" ")[1];
        e.preventDefault();
    });

    $(document).on("mousemove", function (e) {
        if (isDragging) {
            const viewportWidth = $(window).width();
            const viewportHeight = $(window).height();
            const windowWidth = $window.outerWidth();
            const windowHeight = $window.outerHeight();

            // Calculate new position
            let newLeft = e.clientX - startX;
            let newTop = e.clientY - startY;

            // Constrain to viewport boundaries
            newLeft = Math.max(
                0,
                Math.min(newLeft, viewportWidth - windowWidth)
            );
            newTop = Math.max(
                0,
                Math.min(newTop, viewportHeight - windowHeight)
            );

            $window.css({
                left: newLeft,
                top: newTop,
            });
        }
        if (isResizing) {
            const viewportWidth = $(window).width();
            const viewportHeight = $(window).height();
            const windowPosition = $window.offset();

            let newWidth = startWidth;
            let newHeight = startHeight;
            let newX = windowPosition.left;
            let newY = windowPosition.top;

            switch (resizeType) {
                case "resizer-r":
                    newWidth = startWidth + (e.clientX - startX);
                    break;
                case "resizer-l":
                    newWidth = startWidth - (e.clientX - startX);
                    newX = e.clientX;
                    break;
                case "resizer-t":
                    newHeight = startHeight - (e.clientY - startY);
                    newY = e.clientY;
                    break;
                case "resizer-b":
                    newHeight = startHeight + (e.clientY - startY);
                    break;
                case "resizer-tr":
                    newWidth = startWidth + (e.clientX - startX);
                    newHeight = startHeight - (e.clientY - startY);
                    newY = e.clientY;
                    break;
                case "resizer-tl":
                    newWidth = startWidth - (e.clientX - startX);
                    newHeight = startHeight - (e.clientY - startY);
                    newX = e.clientX;
                    newY = e.clientY;
                    break;
                case "resizer-br":
                    newWidth = startWidth + (e.clientX - startX);
                    newHeight = startHeight + (e.clientY - startY);
                    break;
                case "resizer-bl":
                    newWidth = startWidth - (e.clientX - startX);
                    newHeight = startHeight + (e.clientY - startY);
                    newX = e.clientX;
                    break;
            }
            if (newX < 0) {
                newX = 0;
                newWidth = windowPosition.left + $window.outerWidth() - newX;
            }
            if (newY < 0) {
                newY = 0;
                newHeight = windowPosition.top + $window.outerHeight() - newY;
            }
            if (newX + newWidth > viewportWidth) {
                newWidth = viewportWidth - newX;
            }
            if (newY + newHeight > viewportHeight) {
                newHeight = viewportHeight - newY;
            }

            // Ensure minimum size and update position only when necessary
            if (newWidth > 100 && newHeight > 100) {
                $window.css({
                    width: newWidth,
                    height: newHeight,
                });

                // Only update position for left and top resizing
                if (
                    ["resizer-l", "resizer-tl", "resizer-bl"].includes(
                        resizeType
                    )
                ) {
                    $window.css("left", newX);
                }
                if (
                    ["resizer-t", "resizer-tl", "resizer-tr"].includes(
                        resizeType
                    )
                ) {
                    $window.css("top", newY);
                }
            }
        }
    });

    $(document).on("mouseup", function () {
        isDragging = false;
        isResizing = false;
    });
}
