<div class="sticky-top position-sticky text-end pe-none">
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
            max-width: 100vw;
            /* Maximum width is viewport width */
            max-height: 100vh;
            /* Maximum height is viewport height */
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

        #floating-window .resizer {
            position: absolute;
            background: transparent;
        }

        #floating-window .resizer-r,
        #floating-window .resizer-l {
            cursor: ew-resize;
            width: 5px;
            height: 100%;
            top: 0;
        }

        #floating-window .resizer-t,
        #floating-window .resizer-b {
            cursor: ns-resize;
            height: 5px;
            width: 100%;
            left: 0;
        }

        #floating-window .resizer-r {
            right: -3px;
        }

        #floating-window .resizer-l {
            left: -3px;
        }

        #floating-window .resizer-t {
            top: -3px;
        }

        #floating-window .resizer-b {
            bottom: -3px;
        }

        #floating-window .resizer-tr,
        #floating-window .resizer-tl,
        #floating-window .resizer-br,
        #floating-window .resizer-bl {
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

    <button
        class="btn btn-primary m-5 pe-auto"
        id="open-floating-window"
    >Load Resource</button>
</div>
<div id="floating-window">
    <div id="floating-header">
        Floating Window - Project Ledger viewer
        <button
            class="btn-close"
            id="close-button"
        ></button>
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
