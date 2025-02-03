let isFloatingWindowInitialized = false;

interface FloatingWindowElements {
    $window: JQuery<Element>;
    $header: JQuery<Element>;
    $closeButton: JQuery<Element>;
}
export function InitializeFloatingWindow(elements: FloatingWindowElements) {
    if (!isFloatingWindowInitialized) {
        isFloatingWindowInitialized = true;
    }

    const { $window, $header, $closeButton } = elements;

    if (!$window || !$header || !$closeButton) {
        console.error("Required elements for floating window are missing.");
        return;
    }

    let isDragging: boolean = false;
    let isResizing: boolean = false;
    let startX: number, startY: number, startWidth: number, startHeight: number, resizeType: string;

    // Open floating window and load resource

    // Close window
    $closeButton.on("click", function () {
        $window.hide();
    });

    // Dragging
    $header.on("mousedown", function (e) {
        isDragging = true;
        if ($window && $window.length > 0) {
            startX = e.clientX - ($window.offset()?.left || 0);
            startY = e.clientY - ($window.offset()?.top || 0);
        }
    });

    // Resizing
    $(".resizer").on("mousedown", function (e) {
        isResizing = true;
        startX = e.clientX;
        startY = e.clientY;
        if ($window && $window.length > 0) {
            startWidth = $window.width() || 0;
            startHeight = $window.height() || 0;
        }
        resizeType = $(this).attr("class")?.split(" ")[1] || '';
        e.preventDefault();
    });

    $(document).on("mousemove", function (e) {
        if (isDragging) {
            const viewportWidth: number = $(window).width() || 0;
            const viewportHeight: number = $(window).height() || 0;
            const windowWidth: number = $window.outerWidth() || 0;
            const windowHeight: number = $window.outerHeight() || 0;

            // Calculate new position
            let newLeft: number = e.clientX - startX;
            let newTop: number = e.clientY - startY;

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
            const viewportWidth: number = $(window).width() || 0;
            const viewportHeight: number = $(window).height() || 0;
            const windowPosition = $window.offset() || { left: 0, top: 0 };

            let newWidth: number = startWidth;
            let newHeight: number = startHeight;
            let newX: number = windowPosition.left;
            let newY: number = windowPosition.top;

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
                newWidth = windowPosition.left + ($window.outerWidth() || 0) - newX;
            }
            if (newY < 0) {
                newY = 0;
                newHeight = windowPosition.top + ($window.outerHeight() || 0) - newY;
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
