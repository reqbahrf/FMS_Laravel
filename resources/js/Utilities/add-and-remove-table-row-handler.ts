function addNewRowHandler(
    ButtonSelector: string,
    ContainerSelectorsOrElement: string | JQuery<Element>
) {
    $(ButtonSelector)
        .off('click')
        .on('click', function () {
            let container: JQuery<Element>;
            if (typeof ContainerSelectorsOrElement === 'string') {
                container = $(this).closest(ContainerSelectorsOrElement);
            } else {
                container = ContainerSelectorsOrElement;
            }

            const table = container.find('table');
            const lastRow = table.find('tbody tr:last-child');
            const newRow = lastRow.clone();
            newRow.find('input, textarea').val('');
            newRow.find('select')?.prop('selectedIndex', 0);
            table.find('tbody').append(newRow);

            toggleDeleteRowButton(container, 'tbody tr');
        });
}

function removeRowHandler(
    ButtonSelector: string,
    ContainerSelectorsOrElement: string | JQuery<Element>
) {
    $(document)
        .off('click', ButtonSelector)
        .on('click', ButtonSelector, function () {
            let container: JQuery<Element>;
            if (typeof ContainerSelectorsOrElement === 'string') {
                container = $(this).closest(ContainerSelectorsOrElement);
            } else {
                container = ContainerSelectorsOrElement;
            }

            const tbody = container.find('tbody');
            const rows = tbody.find('tr');

            // Only remove if more than one row exists
            if (rows.length > 1) {
                tbody.find('tr:last-child').remove();
                toggleDeleteRowButton(container, 'tbody tr');
            } else {
                console.warn('Cannot remove the last remaining row in');
            }
        });
}

const toggleDeleteRowButton = (
    container: JQuery<Element>,
    elementSelector: string
) => {
    const element = container.find(elementSelector);
    const deleteRowButton = container.find('[data-remove-row-btn]');

    // Ensure the button exists before trying to disable it
    if (deleteRowButton.length > 0) {
        element.length === 1
            ? deleteRowButton.prop('disabled', true)
            : deleteRowButton.prop('disabled', false);
    }
};

export { addNewRowHandler, removeRowHandler };
